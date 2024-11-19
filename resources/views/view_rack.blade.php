@extends('layouts.app')
@section('title', 'View Rack')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 uppercase">
                <a class="btn btn-ghost text-xl">
                    <i class="fas fa-align-justify fa-lg"></i>
                    View Rack
                </a>
            </div>
        </div>
        <div class="p-[20px] border-base-400 border-2 border-t-0 rounded-b-box">
            <div class="mb-3">
                <label for="name" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Name</kbd></label>
                <label name="name" class="col-sm-2 col-form-label">{{ $rack->name }}</label>
            </div>
            <div class="py-6">
                <canvas class="mx-auto" id="myCanvas" width="830" height="530"></canvas>
            </div>
        </div>
    </div>
    <script>
        var c = document.getElementById("myCanvas");
        var ctx = c.getContext("2d");
        ctx.fillStyle = "#FFFACD";
        ctx.fillRect(10, 10, 830, 530);
        ctx.beginPath();
        ctx.lineWidth = 4;
        rows = {{ $rack->rows }};
        columns = {{ $rack->columns }};
        h = 500 / rows;
        w = 800 / columns;
        var rects = [];
        var rect_remains = [];

        function collides(rects, x, y) {
            var isCollision = false;
            for (var i = 0, len = rects.length; i < len; i++) {
                var left = rects[i].x,
                    right = rects[i].x + rects[i].w;
                var top = rects[i].y,
                    bottom = rects[i].y + rects[i].h;
                if (right >= x &&
                    left <= x &&
                    bottom >= y &&
                    top <= y) {
                    isCollision = rects[i];
                }
            }
            return isCollision;
        }
        @foreach ($rack->blocks as $block)
            //ctx.rect(20 + (j * w), 20 + (i * h), w, h);
            rects.push({
                id: {{ $block->id }},
                code: "{{ $block->code }}",
                x: 20 + ({{ $block->column_position - 1 }}) * w,
                y: 20 + ({{ $rack->rows - $block->row_position }}) * h,
                w: w,
                h: h,
            });
            @if ($block->remain_height != 100)
                rect_remains.push({
                    x: 20 + ({{ $block->column_position - 1 }}) * w,
                    y: 20 + ({{ $rack->rows - $block->row_position }}) * h + h * {{ $block->remain_height / 100 }},
                    w: w,
                    h: h * (1 - {{ $block->remain_height / 100 }}),
                });
            @endif
        @endforeach
        for (var i = 0, len = rects.length; i < len; i++) {
            ctx.rect(rects[i].x, rects[i].y, w, h);
            ctx.fillStyle = "black";
            ctx.fillText(rects[i].code, rects[i].x + 10, rects[i].y + 15);
        }
        for (var i = 0, len = rect_remains.length; i < len; i++) {
            ctx.fillStyle = "red";
            ctx.fillRect(rect_remains[i].x, rect_remains[i].y, rect_remains[i].w, rect_remains[i].h);
        }
        ctx.stroke();
        c.addEventListener('click', function(e) {
            //console.log('click: ' + e.offsetX + '/' + e.offsetY);
            var rect = collides(rects, e.offsetX, e.offsetY);
            if (rect) {
                console.log('collision: ' + rect.code);
                window.location.href = "/view_block/" + rect.id;
            } else {
                //console.log('no collision');
            }
        }, false);
    </script>
@endsection

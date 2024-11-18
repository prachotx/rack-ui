@extends('layouts.app')
@section('title', 'Select Rack')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 uppercase">
                <a class="btn btn-ghost text-xl">
                    <i class="fa-solid fa-align-justify fa-lg"></i>
                    Select Rack
                </a>
            </div>
        </div>
        <div class="p-[20px] border-base-400 border-2 border-t-0 rounded-b-box">
            <div class="mb-3 grid grid-cols-8 items-center">
                <label for="packing" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Packing</kbd></label>
                <label name="packing" class="col-sm-3 col-form-label"><a
                        href="/view_packing/{{ $packing_detail->packing->id }}">{{ $packing_detail->packing->code }}</a></label>
                <label for="date" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Date</kbd></label>
                <label name="date" class="col-sm-3 col-form-label">{{ $packing_detail->packing->pack_date }}</label>
            </div>
            <div class="mb-3 grid grid-cols-8 items-center">
                <label for="remark" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Remark</kbd></label>
                <label name="remark" class="col-sm-3 col-form-label">{{ $packing_detail->packing->remark }}</label>
                <label for="status" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Status</kbd></label>
                <label name="status" class="col-sm-3 col-form-label">
                    @if ($packing_detail->packing->status == 'approve')
                        <div class="badge badge-success gap-2 text-base-100 w-16 font-semibold">
                            {{ $packing_detail->packing->status }}
                        </div>
                    @elseif ($packing_detail->packing->status == 'confirm')
                        <div class="badge badge-info gap-2 text-base-100 w-16 font-semibold">
                            {{ $packing_detail->packing->status }}
                        </div>
                    @else
                        <div class="badge badge-warning gap-2 text-base-100 w-16 font-semibold">
                            {{ $packing_detail->packing->status }}
                        </div>
                    @endif
                </label>
            </div>
            <div class="mb-3 grid grid-cols-8 items-center">
                <label for="product_code" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Product
                        Code</kbd></label>
                <label name="product_code" class="col-sm-3 col-form-label">{{ $packing_detail->product->code }}</label>
                <label for="ref_no" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Ref No</kbd></label>
                <label name="ref_no" class="col-sm-3 col-form-label">{{ $packing_detail->ref_no }}</label>
            </div>
            <div class="mb-3">
                <label for="rack_id" class="font-bold">Rack Name</label>
                <div class="mt-3">
                    {!! Form::select('rack_id', $racks, 0, [
                        'class' => 'select select-bordered w-full',
                        'onchange' => 'draw_rack(this.value)',
                    ]) !!}
                </div>
            </div>
            <div class="py-6">
                <canvas class="mx-auto" id="myCanvas" width="840" height="540"></canvas>
            </div>
        </div>
    </div>

    <script>
        var rects = [];
        var rect_remains = [];
        var c = document.getElementById("myCanvas");
        var ctx = c.getContext("2d");
        var racks = {};
        @foreach ($rack_data as $rack)
            var rack = {};
            rack["rows"] = {{ $rack->rows }}
            rack["columns"] = {{ $rack->columns }}
            rack["blocks"] = [];
            @foreach ($rack->blocks as $block)
                var block = {};
                block["id"] = {{ $block->id }};
                block["code"] = "{{ $block->code }}";
                block["column_position"] = {{ $block->column_position }};
                block["row_position"] = {{ $block->row_position }};
                block["remain_height"] = {{ $block->remain_height }};
                rack["blocks"].push(block);
            @endforeach
            racks[{{ $rack->id }}] = rack;
        @endforeach

        function toggleModal(show) {
            const modal = document.getElementById('newProcessModel');
            if (show) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }

        c.addEventListener('click', function(e) {
            const rect = collides(rects, e.offsetX, e.offsetY);
            if (rect) {
                console.log('collision: ' + rect.code);
                document.querySelector('input[name="block_id"]').value = rect.id;
                document.querySelector('input[name="remain_height"]').value = rect.remain_height;
                toggleModal(true);
            } else {
                console.log('no collision');
            }
        }, false);

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

        function draw_rack(i) {
            // get ajax first
            rects = [];
            rect_remains = [];
            ctx.clearRect(0, 0, 840, 540);
            ctx.fillStyle = "#FFFACD";
            ctx.fillRect(10, 10, 830, 530);
            ctx.beginPath();
            ctx.lineWidth = 4;
            rows = racks[i]["rows"];
            columns = racks[i]["columns"];
            h = 500 / rows;
            w = 800 / columns;
            // draw and fill

            for (j = 0; j < racks[i]["blocks"].length; j++) {
                //ctx.rect(20 + (j * w), 20 + (i * h), w, h);
                rects.push({
                    id: racks[i]["blocks"][j]["id"],
                    code: racks[i]["blocks"][j]["code"],
                    x: 20 + (racks[i]["blocks"][j]["column_position"] - 1) * w,
                    y: 20 + (racks[i]["rows"] - racks[i]["blocks"][j]["row_position"]) * h,
                    w: w,
                    h: h,
                    remain_height: racks[i]["blocks"][j]["remain_height"], // ใส่ค่า remain_height
                });

                if (racks[i]["blocks"][j]["remain_height"] != 100) {
                    rect_remains.push({
                        x: 20 + (racks[i]["blocks"][j]["column_position"] - 1) * w,
                        y: 20 + (racks[i]["rows"] - racks[i]["blocks"][j]["row_position"]) * h + h *
                            (racks[i]["blocks"][j]["remain_height"] / 100),
                        w: w,
                        h: h * (1 - racks[i]["blocks"][j]["remain_height"] / 100),
                    });
                }
            }
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
        }
        draw_rack(1);
    </script>

    <!-- POPUP Process Block -->
    <div id="newProcessModel" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-96">
            <form id="form-new-process" action="/select_block/{{ $packing_detail->id }}" method="post">
                @csrf <!-- {{ csrf_field() }} -->
                <input type="hidden" name="block_id" value="{{ $block->id }}">
                <div class="px-6 py-4 border-b">
                    <h5 class="text-lg font-bold">Process Block</h5>
                </div>
                <div class="px-6 py-4">
                    <div class="mb-4">
                        <label for="product_code" class="block font-semibold">Product Code:</label>
                        <span>{{ $packing_detail->product->code }}</span>
                    </div>
                    <div class="mb-4">
                        <label for="quantity" class="block font-semibold">Quantity:</label>
                        <span>{{ $packing_detail->quantity }}</span>
                    </div>
                    <div class="mb-4">
                        <label for="remain_height" class="block font-semibold">Remain Height (%):</label>
                        <input type="text" name="remain_height" class="w-full border rounded px-3 py-2" value="50">
                        @error('remain_height')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-end px-6 py-4 border-t">
                    <button type="submit" class="btn btn-info text-base-100 mr-2">Save
                        changes</button>
                    <button type="button" class="btn"
                        onclick="toggleModal(false)">Close</button>
                </div>
            </form>
        </div>
    </div>
@endsection

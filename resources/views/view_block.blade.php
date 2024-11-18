@extends('layouts.app')
@section('title', 'View Block')
@section('content')
<div class="shadow rounded-box mx-auto">
    <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
        <div class="flex-1 justify-between">
            <a class="btn btn-ghost text-xl uppercase">
                <i class="fa-solid fa-cube"></i>
                View Block
            </a>
            <a class="btn btn-warning text-base-100" href="/edit_block/{{ $block->id }}"><i
                    class="fa-solid fa-edit"></i></a>
        </div>
    </div>
    <div class="p-[20px] border-base-400 border-2 border-t-0 rounded-b-box">
        <div class="mb-3 grid grid-cols-8 items-center">
            <label for="rack" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Rack</kbd></label>
            <label name="rack" class="col-sm-3 col-form-label"><a
                    href="/view_rack/{{ $block->rack->id }}">{{ $block->rack->name }}</a></label>
            <label for="code" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Code</kbd></label>
            <label name="code" class="col-sm-3 col-form-label">{{ $block->code }}</label>
        </div>
        <div class="mb-3 grid grid-cols-8 items-center">
            <label for="row" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Row</kbd></label>
            <label name="row" class="col-sm-3 col-form-label">{{ $block->row_position }}</label>
            <label for="column" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Column</kbd></label>
            <label name="column" class="col-sm-3 col-form-label">{{ $block->column_position }}</label>
        </div>
        <div class="mb-3 grid grid-cols-8 items-center">
            <label for="depth" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Depth</kbd></label>
            <label name="depth" class="col-sm-3 col-form-label">{{ $block->depth }}</label>
            <label for="long" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Long</kbd></label>
            <label name="long" class="col-sm-3 col-form-label">{{ $block->long }}</label>
        </div>
        <div class="mb-3 grid grid-cols-8 items-center">
            <label for="height" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Height</kbd></label>
            <label name="height" class="col-sm-3 col-form-label">{{ $block->height }}</label>
            <label for="remain_height" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Remain Height</kbd></label>
            <label name="remain_height" class="col-sm-3 col-form-label">{{ $block->remain_height }} %</label>
        </div>
        {{-- <canvas id="myCanvas" width="{{ $block->long + 40 }}" height="{{ $block->depth + 40 }}"></canvas> --}}
    </div>
</div>
    <div class="shadow rounded-box mx-auto mt-[10px]">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 uppercase">
                <a class="btn btn-ghost text-xl">
                    <i class="fa-solid fa-pallet"></i>
                    View Products
                </a>
            </div>
        </div>
        <div class="p-[10px] border-base-400 border-2 border-t-0 rounded-b-box">
            <table class="table rounded shadow table-zebra">
                <thead class="bg-neutral text-neutral-content text-lg">
                    <tr>
                        <th class="rounded-tl" scope="col">Pack Code</th>
                        <th scope="col">Pack Date</th>
                        <th scope="col">Product Code</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Remain Quantity</th>
                        <th class="rounded-tr" scope="col">Operation</th>
                    </tr>
                </thead>
                <tbody class="text-[16px]">
                    @foreach ($block->packing_details as $item)
                    <tr>
                        <td>{{ $item->packing->code }}</td>
                        <td>{{ $item->packing->pack_date }}</td>
                        <td>{{ $item->product->code }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->remain_quantity }}</td>
                        <td>
                            <a class="btn btn-info text-base-100" href="/view_packing/{{ $item->packing->id }}"><i class="fa-solid fa-magnifying-glass"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- <script>
        var c = document.getElementById("myCanvas");
        var ctx = c.getContext("2d");
        ctx.fillStyle = "#FFFACD";
        ctx.fillRect(10, 10, {{ $block->long }} + 20, {{ $block->depth }} + 20);
        ctx.fillStyle = "red";
        ctx.beginPath();
        ctx.lineWidth = 4;
        ctx.rect(20, 20, {{ $block->long }}, {{ $block->depth }});
        var rects = [];
        @foreach ($block->process_pallets as $process_pallet)
            //ctx.rect(20 + (j * w), 20 + (i * h), w, h);
            rects.push({
                id: {{ $process_pallet->id }},
                code: "{{ $process_pallet->pallet_type->name }}",
                x: 20 + {{ $process_pallet->x_block }},
                y: 20 + {{ $process_pallet->y_block }},
                w: {{ $process_pallet->pallet_type->long }},
                h: {{ $process_pallet->pallet_type->depth }},
            });
        @endforeach
        for (var i = 0, len = rects.length; i < len; i++) {
            ctx.fillRect(rects[i].x, rects[i].y, rects[i].w, rects[i].h);
            ctx.rect(rects[i].x, rects[i].y, rects[i].w, rects[i].h);
        }
        ctx.stroke();
    </script> --}}
@endsection

@extends('layouts.app')
@section('title', 'Add Packing Detail')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 uppercase">
                <a class="btn btn-ghost text-xl">
                    <i class="fa-solid fa-boxes-packing"></i>
                    Add Packing Detail
                </a>
            </div>
        </div>
        <div class="p-[20px] border-base-400 border-2 border-t-0 rounded-b-box">
            <div class="mb-3 grid grid-cols-8 items-center">
                <label for="packing" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Packing</kbd></label>
                <label name="packing" class="col-sm-3 col-form-label"><a
                        href="/view_packing/{{ $packing->id }}">{{ $packing->code }}</a></label>
                <label for="date" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Date</kbd></label>
                <label name="date" class="col-sm-3 col-form-label">{{ $packing->pack_date }}</label>
            </div>
            <div class="mb-3 grid grid-cols-8 items-center">
                <label for="remark" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Remark</kbd></label>
                <label name="remark" class="col-sm-3 col-form-label">{{ $packing->remark }}</label>
                <label for="status" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Status</kbd></label>
                <label name="status" class="col-sm-3 col-form-label">
                    @if ($packing->status == 'approve')
                        <div class="badge badge-success gap-2 text-base-100 w-16 font-semibold">
                            {{ $packing->status }}
                        </div>
                    @elseif ($packing->status == 'confirm')
                        <div class="badge badge-info gap-2 text-base-100 w-16 font-semibold">
                            {{ $packing->status }}
                        </div>
                    @else
                        <div class="badge badge-warning gap-2 text-base-100 w-16 font-semibold">
                            {{ $packing->status }}
                        </div>
                    @endif
                </label>
            </div>
            <form method="POST" action="/create_packing_detail/{{ $id }}">
                @csrf
                <div class="mb-3 row">
                    <label for="product_code" class="font-bold">Product Code</label>
                    <div class="mt-2">
                        {!! Form::select('product_id', $products, 0, ['class' => 'select2 select select-bordered w-full']) !!}
                    </div>
                </div>
                @error('product_id')
                    <div class="my-2">
                        <span class="text-error">{{ $message }}</span>
                    </div>
                @enderror

                <div class="mb-3 row">
                    <label for="ref_no" class="font-bold">Ref No.</label>
                    <div class="mt-2">
                        <input type="text" name="ref_no" class="input input-bordered w-full">
                    </div>
                </div>
                @error('ref_no')
                    <div class="my-2">
                        <span class="text-error">{{ $message }}</span>
                    </div>
                @enderror

                <div class="mb-3 row">
                    <label for="quantity" class="font-bold">Quantity</label>
                    <div class="mt-2">
                        <input type="text" name="quantity" class="input input-bordered w-full">
                    </div>
                </div>
                @error('quantity')
                    <div class="my-2">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
                <div class="mt-[20px] text-center">
                    <input type="submit" value="Save" class="btn btn-primary w-[300px]">
                </div>
            </form>
        </div>
    </div>
    <script>
        //todo:slug generate
        $(document).on('click', '.delete_rack_details', function(e) {
            let item = $(this).data('item');

            $('.code').text(item['code']);
            $('.location').text(item['location']['name']);
            $('.depth').text(item['depth']);
            $('.rows').text(item['rows']);
            $('.columns').text(item['columns']);
            document.getElementById("form-delete-rack").action = "/delete_rack/" + item['id'];
        });
        $(document).on('click', '.confirm_rack_details', function(e) {
            let item = $(this).data('item');

            $('.code').text(item['code']);
            $('.location').text(item['location']['name']);
            $('.depth').text(item['depth']);
            $('.rows').text(item['rows']);
            $('.columns').text(item['columns']);
            document.getElementById("form-confirm-rack").action = "/confirm_rack/" + item['id'];
        });

        $(document).on('click', '.disable_rack_details', function(e) {
            let item = $(this).data('item');

            $('.code').text(item['code']);
            $('.location').text(item['location']['name']);
            $('.depth').text(item['depth']);
            $('.rows').text(item['rows']);
            $('.columns').text(item['columns']);
            document.getElementById("form-disable-rack").action = "/disable_rack/" + item['id'];
        });
        $(document).on('click', '.enable_rack_details', function(e) {
            let item = $(this).data('item');

            $('.code').text(item['code']);
            $('.location').text(item['location']['name']);
            $('.depth').text(item['depth']);
            $('.rows').text(item['rows']);
            $('.columns').text(item['columns']);
            document.getElementById("form-enable-rack").action = "/enable_rack/" + item['id'];
        });
    </script>
@endsection

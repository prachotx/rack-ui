@extends('layouts.app')
@section('title', 'Select Packing Detail')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 uppercase">
                <a class="btn btn-ghost text-xl">
                    <i class="fa-solid fa-truck-arrow-right"></i>
                    Select Packing Detail
                </a>
            </div>
            <div class="flex-none">
                @if (Auth::user()->id == $check_out->out_user_id and $check_out->status == 'draft')
                    <a class="btn btn-success text-base-100" href="/add_check_out_detail/{{ $check_out->id }}"><i
                            class="fa-solid fa-plus"></i> Add</a>
                @endif
            </div>
        </div>
        <div class="p-[20px] border-base-400 border-2 border-t-0 rounded-b-box">
            <div class="mb-3 grid grid-cols-8 items-center">
                <label for="check_out" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">CheckOut</kbd></label>
                <label name="check_out" class="col-sm-3 col-form-label">{{ $check_out->code }}</label>
                <label for="date" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Date</kbd></label>
                <label name="date" class="col-sm-3 col-form-label">{{ $check_out->out_date }}</label>
            </div>
            <div class="mb-3 grid grid-cols-8 items-center">
                <label for="remark" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Remark</kbd></label>
                <label name="remark" class="col-sm-3 col-form-label">{{ $check_out->remark }}</label>
                <label for="status" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Status</kbd></label>
                <label name="status" class="col-sm-3 col-form-label">{{ $check_out->status }}</label>
            </div>
            <form method="POST" action="/create_check_out_detail/{{ $check_out->id }}">
                @csrf
                <input type="hidden" name="packing_detail_id" value="{{ $packing_detail->id }}">
                <div class="mb-3">
                    <label for="product" class="font-bold">Product Code</label>
                    <div class="mt-3">
                        <label name="product" class="col-sm-2 col-form-label">{{ $packing_detail->product->code }}</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="ref_no" class="font-bold">Ref No.</label>
                    <div class="mt-3">
                        <label name="ref_no" class="col-sm-2 col-form-label">{{ $packing_detail->ref_no }}</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="rack" class="font-bold">Rack</label>
                    <div class="mt-3">
                        <label name="rack"
                            class="col-sm-2 col-form-label">{{ $packing_detail->block->rack->name }}</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="block" class="font-bold">Block</label>
                    <div class="mt-3">
                        <label name="block" class="col-sm-2 col-form-label">{{ $packing_detail->block->code }}</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="font-bold">Quantity</label>
                    <div class="my-3">
                        <input type="text" name="quantity" class="input input-bordered w-full"
                            value="{{ $packing_detail->remain_quantity }}">
                    </div>
                    <label for="quantity" class="font-bold">Max
                        ({{ $packing_detail->remain_quantity }})</label>
                </div>
                @error('quantity')
                    <div class="my-3">
                        <span class="text-error">{{ $message }}</span>
                    </div>
                @enderror

                <div class="mt-[20px] text-center">
                    <input type="submit" value="Save" class="btn btn-primary w-[300px] text-lg">
                </div>
            </form>
        </div>
    </div>
@endsection

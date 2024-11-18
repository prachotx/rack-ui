@extends('layouts.app')
@section('title', 'Select Packing Detail')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <nav class="navbar navbar-expand-lg">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="#"><i class="fa-solid fa-truck-arrow-right"></i>&nbsp;&nbsp;Select Packing Detail</a>
                                @if (Auth::user()->id == $check_out->out_user_id and $check_out->status == 'draft')
                                    <a class="btn btn-success" href="/add_check_out_detail/{{ $check_out->id }}"><i
                                            class="fa-solid fa-plus"></i> Add</a>
                                @endif
                            </div>
                        </nav>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="check_out" class="col-sm-2 col-form-label fw-bold">CheckOut</label>
                            <label name="check_out" class="col-sm-3 col-form-label">{{ $check_out->code }}</label>
                            <label for="date" class="col-sm-2 col-form-label fw-bold">Date</label>
                            <label name="date" class="col-sm-3 col-form-label">{{ $check_out->out_date }}</label>
                        </div>
                        <div class="mb-3 row">
                            <label for="remark" class="col-sm-2 col-form-label fw-bold">Remark</label>
                            <label name="remark" class="col-sm-3 col-form-label">{{ $check_out->remark }}</label>
                            <label for="status" class="col-sm-2 col-form-label fw-bold">Status</label>
                            <label name="status" class="col-sm-3 col-form-label">{{ $check_out->status }}</label>
                        </div>
                        <form method="POST" action="/create_check_out_detail/{{ $check_out->id }}">
                            @csrf
                            <input type="hidden" name="packing_detail_id" value="{{ $packing_detail->id }}">
                            <div class="mb-3 row">
                                <label for="product" class="col-sm-2 col-form-label fw-bold">Product Code</label>
                                <div class="col-sm-10">
                                    <label name="product" class="col-sm-2 col-form-label">{{ $packing_detail->product->code }}</label>
                                </div>
                            </div>
                                                        
                            <div class="mb-3 row">
                                <label for="ref_no" class="col-sm-2 col-form-label fw-bold">Ref No.</label>
                                <div class="col-sm-10">
                                    <label name="ref_no" class="col-sm-2 col-form-label">{{ $packing_detail->ref_no }}</label>
                                </div>
                            </div>
                                                        
                            <div class="mb-3 row">
                                <label for="rack" class="col-sm-2 col-form-label fw-bold">Rack</label>
                                <div class="col-sm-10">
                                    <label name="rack" class="col-sm-2 col-form-label">{{ $packing_detail->block->rack->name }}</label>
                                </div>
                            </div>
                                                        
                            <div class="mb-3 row">
                                <label for="block" class="col-sm-2 col-form-label fw-bold">Block</label>
                                <div class="col-sm-10">
                                    <label name="block" class="col-sm-2 col-form-label">{{ $packing_detail->block->code }}</label>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="quantity" class="col-sm-2 col-form-label fw-bold">Quantity</label>
                                <div class="col-sm-4">
                                    <input type="text" name="quantity" class="form-control" value="{{ $packing_detail->remain_quantity }}">
                                </div>
                                <label for="quantity" class="col-sm-6 col-form-label fw-bold">Max ({{ $packing_detail->remain_quantity }})</label>
                            </div>
                            @error('quantity')
                            <div class="my-2">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                            @enderror

                            <div class="row justify-content-center">
                                <input type="submit" value="Save" class="btn btn-primary col-sm-2">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection

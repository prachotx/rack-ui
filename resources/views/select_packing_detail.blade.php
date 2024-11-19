@extends('layouts.app')
@section('title', 'Select Packing Detail')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 justify-between">
                <a class="btn btn-ghost text-xl uppercase">
                    <i class="fa-solid fa-truck-arrow-right"></i>
                    Select Packing Detail
                </a>
                <div>
                    @if (Auth::user()->id == $check_out->out_user_id and $check_out->status == 'draft')
                        <a class="btn btn-success text-base-100" href="/add_check_out_detail/{{ $check_out->id }}"><i
                                class="fa-solid fa-plus"></i> Add</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="p-[20px] border-base-400 border-2 border-t-0 rounded-b-box">
            <div class="mb-3 grid grid-cols-8 items-center">
                <label for="check_out" class="col-sm-2 col-form-label fw-bold">CheckOut</label>
                <label name="check_out" class="col-sm-3 col-form-label">{{ $check_out->code }}</label>
                <label for="date" class="col-sm-2 col-form-label fw-bold">Date</label>
                <label name="date" class="col-sm-3 col-form-label">{{ $check_out->out_date }}</label>
            </div>
            <div class="mb-3 grid grid-cols-8 items-center">
                <label for="remark" class="col-sm-2 col-form-label fw-bold">Remark</label>
                <label name="remark" class="col-sm-3 col-form-label">{{ $check_out->remark }}</label>
                <label for="status" class="col-sm-2 col-form-label fw-bold">Status</label>
                <label name="status" class="col-sm-3 col-form-label">
                    @if ($check_out->status == 'approve')
                        <div class="badge badge-success gap-2 text-base-100 w-16">
                            {{ $check_out->status }}
                        </div>
                    @elseif ($check_out->status == 'confirm')
                        <div class="badge badge-info gap-2 text-base-100 w-16">
                            {{ $check_out->status }}
                        </div>
                    @else
                        <div class="badge badge-warning gap-2 text-base-100 w-16">
                            {{ $check_out->status }}
                        </div>
                    @endif
                </label>
            </div>
            <table class="table rounded shadow table-zebra">
                <thead class="bg-neutral text-neutral-content text-lg">
                    <tr>
                        <th class="rounded-tl" scope="col">Product Code</th>
                        <th scope="col">Ref No.</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Rack</th>
                        <th scope="col">Block</th>
                        <th class="rounded-tr" scope="col">Operation</th>
                    </tr>
                </thead>
                <tbody class="text-[16px]">
                    @foreach ($packing_details as $item)
                        <tr>
                            <td>{{ $item->product->code }}</td>
                            <td>{{ $item->ref_no }}</td>
                            <td>{{ $item->remain_quantity }}</td>
                            <td>
                                <a href="/view_rack/{{ $item->block->rack_id }}">
                                    {{ $item->block->rack->name }}
                                </a>
                            </td>
                            <td>
                                <a href="/view_block/{{ $item->block->id }}">
                                    {{ $item->block->code }}
                                </a>
                            </td>
                            <td>
                                <form action="/assign_check_out_quantity/{{ $check_out->id }}" method="post">
                                    @csrf <!-- {{ csrf_field() }} -->
                                    <input type="hidden" name="packing_detail_id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-success text-base-100 btn-sm"><i class="fa-solid fa-plus"></i>
                                        Select</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

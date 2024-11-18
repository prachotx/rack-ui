@extends('layouts.app')
@section('title', 'View Packing')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 justify-between">
                <a class="btn btn-ghost text-xl uppercase">
                    <i class="fa-solid fa-boxes-packing"></i>
                    View Packing
                </a>
                <div>
                    @if (Auth::user()->id == $packing->pack_user_id and $packing->status == 'draft')
                        <div class="justify-content-end">
                            <a class="btn btn-info text-base-100" href="/packing_detail/{{ $packing->id }}"><i
                                    class="fa-solid fa-list"></i> Detail</a>
                            <a class="btn btn-warning text-base-100" href="/edit_packing/{{ $packing->id }}"><i
                                    class="fa-solid fa-edit"></i></i> Edit</a>
                            {{-- เพิ่มการตัวสอบว่า packing มี productsหรือไม่ --}}
                            @php $all_detail=true; @endphp
                            @foreach ($packing->packing_details as $packing_detail)
                                @if ($packing_detail->block_id == null)
                                    @php $all_detail=false; @endphp
                                @endif
                                {{-- เพิ่มการตัวสอบว่า packing มี productsหรือไม่ --}}
                            @endforeach
                            @if ($all_detail == true)
                                <a class="btn btn-success text-base-100 confirm_packing" data-bs-toggle="modal"
                                    data-bs-target="#ConfirmPackingModal" data-item="{{ $packing }}" href="#"><i
                                        class="fa-solid fa-check"></i> Confirm</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="p-[20px] border-base-400 border-2 border-t-0 rounded-b-box">
            <div class="mb-3 grid grid-cols-8 items-center">
                <label for="packing" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Packing</kbd></label>
                <label name="packing" class="col-sm-3 col-form-label">{{ $packing->code }}</label>
                <label for="date" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Data</kbd></label>
                <label name="date" class="col-sm-3 col-form-label">{{ $packing->pack_date }}</label>
            </div>
            <div class="grid grid-cols-8 items-center">
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
            <table class="table rounded shadow table-zebra mt-[20px]">
                <thead class="bg-neutral text-neutral-content text-lg">
                    <tr>
                        <th class="rounded-tl" scope="col">Product Code</th>
                        <th scope="col">Ref No.</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Remain Quantity</th>
                        <th scope="col">Rack</th>
                        <th scope="col">Block</th>
                        <th class="rounded-tr" scope="col">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packing->packing_details as $item)
                        <tr class="text-[16px]">
                            <td>{{ $item->product->code }}</td>
                            <td>{{ $item->ref_no }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->remain_quantity }}</td>
                            <td>
                                @if ($item->block)
                                    <a href="/view_rack/{{ $item->block->rack_id }}">
                                        {{ $item->block->rack->name }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($item->block)
                                    <a href="/view_block/{{ $item->block->id }}">
                                        {{ $item->block->code }}
                                    </a>
                                @else
                                    -
                                @endif
                                @if ($packing->status == 'draft')
                                    <a class="btn btn-sm btn-info text-base-100" href="/select_rack/{{ $item->id }}">
                                        <i class="fa-solid fa-cube"></i>
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if (Auth::user()->id == $item->packing->pack_user_id and $item->packing->status == 'draft')
                                    <a class="btn btn-warning text-base-100"
                                        href="/edit_packing_detail/{{ $item->id }}"><i
                                            class="fa-solid fa-edit"></i></a>
                                    <a class="btn btn-error text-base-100 delete_rack_details" data-bs-toggle="modal"
                                        data-bs-target="#ConfirmPackingModal" data-item="{{ $item }}"
                                        href="#"><i class="fa-solid fa-trash"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ConfirmPackingModal" tabindex="-1" aria-labelledby="ConfirmPackingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form-confirm-packing" action="/confirm_packing/{{ $packing->id }}" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="ConfirmPackingModalLabel">Confirm Packing</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Code: </strong><span class="code">{{ $packing->code }}</span></p>
                        <p><strong>Date: </strong><span class="date">{{ $packing->pack_date }}</span></p>
                        <p><strong>Remark: </strong><span class="remark">{{ $packing->remark }}</span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i> Confirm</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

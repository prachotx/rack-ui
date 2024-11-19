@extends('layouts.app')
@section('title', 'Check Out Detail')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 justify-between">
                <a class="btn btn-ghost text-xl uppercase">
                    <i class="fa-solid fa-truck-arrow-right"></i>
                    Check Out Detail
                </a>
                <div>
                    @if (Auth::user()->id == $check_out->out_user_id and $check_out->status == 'draft')
                        <a class="btn btn-success text-base-100" href="/select_packing_detail/{{ $check_out->id }}"><i
                                class="fa-solid fa-plus"></i> Add</a> &nbsp;
                        <a class="btn btn-success text-base-100 confirm_check_out" data-bs-toggle="modal"
                            data-bs-target="#ConfirmCheckOutModal" data-item="{{ $check_out }}" href="#"><i
                                class="fa-solid fa-check"></i> Confirm</a>
                    @endif
                    @if (Auth::user()->role == 'admin' and $check_out->status == 'confirm')
                        <a class="btn btn-success text-base-100 approve_check_out" data-bs-toggle="modal"
                            data-bs-target="#ApproveCheckOutModal" data-item="{{ $check_out }}" href="#"><i
                                class="fa-solid fa-thumbs-up"></i> Approve</a> &nbsp;
                        <a class="btn btn-error  text-base-100 reject_check_out" data-bs-toggle="modal"
                            data-bs-target="#RejectCheckOutModal" data-item="{{ $check_out }}" href="#"><i
                                class="fa-solid fa-thumbs-down"></i> Reject</a>
                    @endif
                </div>
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
            <table class="table rounded shadow table-zebra mt-[20pxt]">
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
                    @foreach ($check_out->check_out_details as $item)
                        <tr>
                            <td>{{ $item->packing_detail->product->code }}</td>
                            <td>{{ $item->packing_detail->ref_no }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                <a href="/view_rack/{{ $item->packing_detail->block->rack_id }}">
                                    {{ $item->packing_detail->block->rack->name }}
                                </a>
                            </td>
                            <td>
                                <a href="/view_block/{{ $item->packing_detail->block->id }}">
                                    {{ $item->packing_detail->block->code }}
                                </a>
                            </td>
                            <td>
                                @if (Auth::user()->id == $item->check_out->out_user_id and $item->check_out->status == 'draft')
                                    <a class="btn btn-warning text-base-100" href="/edit_check_out_detail/{{ $item->id }}"><i
                                            class="fa-solid fa-edit"></i></a>
                                    <a class="btn btn-error text-base-100 delete_check_out_detail" data-bs-toggle="modal"
                                        data-bs-target="#DeleteCheckOutDetailModal" data-item="{{ $item }}"
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
    <div class="modal fade" id="DeleteCheckOutDetailModal" tabindex="-1" aria-labelledby="DeleteCheckOutDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form-delete-check-out-detail" action="" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="DeleteCheckOutDetailModalLabel">Delete Check Out Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Product Code: </strong><span class="code"></span></p>
                        <p><strong>Ref No: </strong><span class="ref_no"></span></p>
                        <p><strong>Quantity: </strong><span class="quantity"></span></p>
                        <p><strong>Rack: </strong><span class="rack"></span></p>
                        <p><strong>Block: </strong><span class="block"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ConfirmCheckOutModal" tabindex="-1" aria-labelledby="ConfirmCheckOutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form-confirm-check-out" action="" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="ConfirmCheckOutModalLabel">Confirm CheckOut</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Code: </strong><span class="code"></span></p>
                        <p><strong>Date: </strong><span class="date"></span></p>
                        <p><strong>Remark: </strong><span class="remark"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i> Confirm</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ApproveCheckOutModal" tabindex="-1" aria-labelledby="ApproveCheckOutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form-approve-check-out" action="" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="ApproveCheckOutModalLabel">Approve CheckOut</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Code: </strong><span class="code"></span></p>
                        <p><strong>Date: </strong><span class="date"></span></p>
                        <p><strong>Remark: </strong><span class="remark"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-thumbs-up"></i>
                            Approve</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="RejectCheckOutModal" tabindex="-1" aria-labelledby="RejectCheckOutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form-reject-check-out" action="" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="RejectCheckOutModalLabel">Reject CheckOut</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Code: </strong><span class="code"></span></p>
                        <p><strong>Date: </strong><span class="date"></span></p>
                        <p><strong>Remark: </strong><span class="remark"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-thumbs-down"></i>
                            Reject</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        //todo:slug generate
        $(document).on('click', '.delete_check_out_detail', function(e) {
            let item = $(this).data('item');

            $('.code').text(item['packing_detail']['product']['code']);
            $('.ref_no').text(item['packing_detail']['ref_no']);
            $('.quantity').text(item['quantity']);
            $('.rack').text(item['packing_detail']['process_pallet']['block']['rack']['name']);
            $('.block').text(item['packing_detail']['process_pallet']['block']['code']);
            document.getElementById("form-delete-check-out-detail").action = "/delete_check_out_detail/" + item[
                'id'];
        });
        $(document).on('click', '.confirm_check_out', function(e) {
            let item = $(this).data('item');

            $('.code').text(item['code']);
            $('.date').text(item['out_date']);
            $('.remark').text(item['remark']);
            document.getElementById("form-confirm-check-out").action = "/confirm_check_out/" + item['id'];
        });
        $(document).on('click', '.approve_check_out', function(e) {
            let item = $(this).data('item');

            $('.code').text(item['code']);
            $('.date').text(item['out_date']);
            $('.remark').text(item['remark']);
            document.getElementById("form-approve-check-out").action = "/approve_check_out/" + item['id'];
        });
        $(document).on('click', '.reject_check_out', function(e) {
            let item = $(this).data('item');

            $('.code').text(item['code']);
            $('.date').text(item['out_date']);
            $('.remark').text(item['remark']);
            document.getElementById("form-reject-check-out").action = "/reject_check_out/" + item['id'];
        });
    </script>
@endsection

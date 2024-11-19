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
                        <a class="btn btn-success text-base-100" href="/select_packing_detail/{{ $check_out->id }}">
                            <i class="fa-solid fa-plus"></i> Add
                        </a>
                        <a class="btn btn-success text-base-100 confirm_check_out" href="#"
                            data-item="{{ $check_out }}">
                            <i class="fa-solid fa-check"></i> Confirm
                        </a>
                    @endif
                    @if (Auth::user()->role == 'admin' and $check_out->status == 'confirm')
                        <a class="btn btn-success text-base-100 approve_check_out" href="#"
                            data-item="{{ $check_out }}">
                            <i class="fa-solid fa-thumbs-up"></i> Approve
                        </a>
                        <a class="btn btn-error text-base-100 reject_check_out" href="#"
                            data-item="{{ $check_out }}">
                            <i class="fa-solid fa-thumbs-down"></i> Reject
                        </a>
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
                                    <a class="btn btn-warning text-base-100"
                                        href="/edit_check_out_detail/{{ $item->id }}"><i
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

    <!-- Confirm CheckOut Modal -->
    <div id="ConfirmCheckOutModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="form-confirm-check-out" action="" method="post">
                @csrf
                <div class="flex justify-between items-center p-4 border-b">
                    <h5 class="text-lg font-semibold">Confirm CheckOut</h5>
                    <button type="button" class="text-lg" id="closeConfirmCheckOutModal">×</button>
                </div>
                <div class="p-4">
                    <p><strong>Code: </strong><span class="code"></span></p>
                    <p><strong>Date: </strong><span class="date"></span></p>
                    <p><strong>Remark: </strong><span class="remark"></span></p>
                </div>
                <div class="flex justify-end p-4 border-t gap-2">
                    <button type="submit" class="btn btn-success text-base-100">
                        <i class="fa-solid fa-check"></i> Confirm
                    </button>
                    <button type="button" class="btn" id="closeConfirmCheckOutModalBtn">Close</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Approve CheckOut Modal -->
    <div id="ApproveCheckOutModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="form-approve-check-out" action="" method="post">
                @csrf
                <div class="flex justify-between items-center p-4 border-b">
                    <h5 class="text-lg font-semibold">Approve CheckOut</h5>
                    <button type="button" class="text-lg" id="closeApproveCheckOutModal">×</button>
                </div>
                <div class="p-4">
                    <p><strong>Code: </strong><span class="code"></span></p>
                    <p><strong>Date: </strong><span class="date"></span></p>
                    <p><strong>Remark: </strong><span class="remark"></span></p>
                </div>
                <div class="flex justify-end p-4 border-t gap-2">
                    <button type="submit" class="btn btn-success text-base-100">
                        <i class="fa-solid fa-thumbs-up"></i> Approve
                    </button>
                    <button type="button" class="btn" id="closeApproveCheckOutModalBtn">Close</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Reject CheckOut Modal -->
    <div id="RejectCheckOutModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="form-reject-check-out" action="" method="post">
                @csrf
                <div class="flex justify-between items-center p-4 border-b">
                    <h5 class="text-lg font-semibold">Reject CheckOut</h5>
                    <button type="button" class="text-lg" id="closeRejectCheckOutModal">×</button>
                </div>
                <div class="p-4">
                    <p><strong>Code: </strong><span class="code"></span></p>
                    <p><strong>Date: </strong><span class="date"></span></p>
                    <p><strong>Remark: </strong><span class="remark"></span></p>
                </div>
                <div class="flex justify-end p-4 border-t gap-2">
                    <button type="submit" class="btn btn-error text-base-100">
                        <i class="fa-solid fa-thumbs-down"></i> Reject
                    </button>
                    <button type="button" class="btn" id="closeRejectCheckOutModalBtn">Close</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).on('click', '.confirm_check_out', function(e) {
            let item = $(this).data('item');
            $('.code').text(item['code']);
            $('.date').text(item['out_date']);
            $('.remark').text(item['remark']);
            document.getElementById("form-confirm-check-out").action = "/confirm_check_out/" + item['id'];
            $('#ConfirmCheckOutModal').removeClass('hidden');
        });

        $(document).on('click', '.approve_check_out', function(e) {
            let item = $(this).data('item');
            $('.code').text(item['code']);
            $('.date').text(item['out_date']);
            $('.remark').text(item['remark']);
            document.getElementById("form-approve-check-out").action = "/approve_check_out/" + item['id'];
            $('#ApproveCheckOutModal').removeClass('hidden');
        });

        $(document).on('click', '.reject_check_out', function(e) {
            let item = $(this).data('item');
            $('.code').text(item['code']);
            $('.date').text(item['out_date']);
            $('.remark').text(item['remark']);
            document.getElementById("form-reject-check-out").action = "/reject_check_out/" + item['id'];
            $('#RejectCheckOutModal').removeClass('hidden');
        });

        $('#closeConfirmCheckOutModal, #closeConfirmCheckOutModalBtn').on('click', function() {
            $('#ConfirmCheckOutModal').addClass('hidden');
        });

        $('#closeApproveCheckOutModal, #closeApproveCheckOutModalBtn').on('click', function() {
            $('#ApproveCheckOutModal').addClass('hidden');
        });

        $('#closeRejectCheckOutModal, #closeRejectCheckOutModalBtn').on('click', function() {
            $('#RejectCheckOutModal').addClass('hidden');
        });
    </script>
@endsection

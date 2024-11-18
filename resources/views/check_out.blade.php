@extends('layouts.app')
@section('title', 'CheckOut')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 uppercase">
                <a class="btn btn-ghost text-xl">
                    <i class="fa-solid fa-truck-arrow-right"></i>
                    Check Out
                </a>
            </div>
            <div class="flex-none gap-2">
                <form class="flex" role="search">
                    <input type="search" placeholder="Search" aria-label="Search" name="search" value="{{ $search }}"
                        class="input input-bordered w-auto" />
                    <button class="btn ml-2" type="submit">Search</button>
                </form>
                <div class="dropdown dropdown-end">
                    @if (Auth::user()->role == 'admin')
                        <a class="btn btn-success text-base-100" href="/add_check_out"><i
                                class="fa-solid fa-plus"></i>Add</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="p-[10px] border-base-400 border-2 border-t-0 rounded-b-box">
            <table class="table rounded shadow table-zebra">
                <thead class="bg-neutral text-neutral-content text-lg">
                    <tr>
                        <th class="rounded-tl" scope="col">Code</th>
                        <th scope="col">Date</th>
                        <th scope="col">Remark</th>
                        <th scope="col">Status</th>
                        <th class="rounded-tr" scope="col">Operation</th>
                    </tr>
                </thead>
                <tbody class="text-[16px]">
                    @foreach ($check_outs as $item)
                        <tr>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->out_date }}</td>
                            <td>{{ $item->remark }}</td>
                            <td>
                                @if ($item->status == 'approve')
                                    <div class="badge badge-success gap-2 text-base-100 w-16 font-semibold">
                                        {{ $item->status }}
                                    </div>
                                @elseif ($item->status == 'confirm')
                                    <div class="badge badge-info gap-2 text-base-100 w-16 font-semibold">
                                        {{ $item->status }}
                                    </div>
                                @else
                                    <div class="badge badge-warning gap-2 text-base-100 w-16 font-semibold">
                                        {{ $item->status }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info text-base-100" href="/check_out_detail/{{ $item->id }}"><i
                                        class="fa-solid fa-list"></i></a>
                                @if (Auth::user()->id == $item->out_user_id and $item->status == 'draft')
                                    <a class="btn btn-warning text-base-100" href="/edit_check_out/{{ $item->id }}"><i
                                            class="fa-solid fa-edit"></i></a>
                                    <a class="btn btn-error text-base-100 delete_check_out" data-bs-toggle="modal"
                                        data-bs-target="#DeleteCheckOutModal" data-item="{{ $item }}"
                                        href="#"><i class="fa-solid fa-trash"></i></a>
                                    <a class="btn btn-success text-base-100 confirm_check_out" data-bs-toggle="modal"
                                        data-bs-target="#ConfirmCheckOutModal" data-item="{{ $item }}"
                                        href="#"><i class="fa-solid fa-check"></i></a>
                                @endif
                                @if ($item->status == 'confirm' or $item->status == 'approve')
                                    <a class="btn btn-primary text-base-100" target="_blank"
                                        href="/print_check_out/{{ $item->id }}"><i class="fa-solid fa-print"></i></a>
                                @endif
                                @if (Auth::user()->role == 'admin' and $item->status == 'confirm')
                                    <a class="btn btn-success text-base-100 approve_check_out" data-bs-toggle="modal"
                                        data-bs-target="#ApproveCheckOutModal" data-item="{{ $item }}"
                                        href="#"><i class="fa-solid fa-thumbs-up"></i></a>
                                    <a class="btn btn-error text-base-100 reject_check_out" data-bs-toggle="modal"
                                        data-bs-target="#RejectCheckOutModal" data-item="{{ $item }}"
                                        href="#"><i class="fa-solid fa-thumbs-down"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $check_outs->links('vendor.pagination.tailwind') }}
        </div>
    </div>

    <!-- Delete Check Out Modal -->
    <div id="DeleteCheckOutModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="form-delete-check-out" action="" method="post">
                @csrf
                <div class="flex justify-between items-center p-4 border-b">
                    <h5 class="text-lg font-semibold">Delete Check Out</h5>
                    <button type="button" class="btn-close text-lg" id="closeDeleteCheckOutModal">×</button>
                </div>
                <div class="p-4">
                    <p><kbd class="kbd mr-2 mb-2">Code</kbd><span class="code"></span></p>
                    <p><kbd class="kbd mr-2 mb-2">Date</kbd><span class="date"></span></p>
                    <p><kbd class="kbd mr-2">Remark</kbd><span class="remark"></span></p>
                </div>
                <div class="flex justify-end p-4 border-t gap-2">
                    <button type="submit" class="btn btn-error text-base-100">
                        <i class="fa-solid fa-trash"></i> Delete
                    </button>
                    <button type="button" class="btn" id="closeDeleteCheckOutModalBtn">Close</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirm Check Out Modal -->
    <div id="ConfirmCheckOutModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="form-confirm-check-out" action="" method="post">
                @csrf
                <div class="flex justify-between items-center p-4 border-b">
                    <h5 class="text-lg font-semibold">Confirm Check Out</h5>
                    <button type="button" class="btn-close text-lg" id="closeConfirmCheckOutModal">×</button>
                </div>
                <div class="p-4">
                    <p><kbd class="kbd mr-2 mb-2">Code</kbd><span class="code"></span></p>
                    <p><kbd class="kbd mr-2 mb-2">Date</kbd><span class="date"></span></p>
                    <p><kbd class="kbd mr-2">Remark</kbd><span class="remark"></span></p>
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

    <!-- Approve Check Out Modal -->
    <div id="ApproveCheckOutModal"
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="form-approve-check-out" action="" method="post">
                @csrf
                <div class="flex justify-between items-center p-4 border-b">
                    <h5 class="text-lg font-semibold">Approve Check Out</h5>
                    <button type="button" class="btn-close text-lg" id="closeApproveCheckOutModal">×</button>
                </div>
                <div class="p-4">
                    <p><kbd class="kbd mr-2 mb-2">Code</kbd><span class="code"></span></p>
                    <p><kbd class="kbd mr-2 mb-2">Date</kbd><span class="date"></span></p>
                    <p><kbd class="kbd mr-2">Remark</kbd><span class="remark"></span></p>
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

    <!-- Reject Check Out Modal -->
    <div id="RejectCheckOutModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="form-reject-check-out" action="" method="post">
                @csrf
                <div class="flex justify-between items-center p-4 border-b">
                    <h5 class="text-lg font-semibold">Reject Check Out</h5>
                    <button type="button" class="btn-close text-lg" id="closeRejectCheckOutModal">×</button>
                </div>
                <div class="p-4">
                    <p><kbd class="kbd mr-2 mb-2">Code</kbd><span class="code"></span></p>
                    <p><kbd class="kbd mr-2 mb-2">Date</kbd><span class="date"></span></p>
                    <p><kbd class="kbd mr-2">Remark</kbd><span class="remark"></span></p>
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
        //todo:slug generate
        $(document).on('click', '.delete_check_out', function(e) {
            let item = $(this).data('item');
            $('.code').text(item['code']);
            $('.date').text(item['out_date']);
            $('.remark').text(item['remark']);
            document.getElementById("form-delete-check-out").action = "/delete_check_out/" + item['id'];
            $('#DeleteCheckOutModal').removeClass('hidden');
        });

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

        // Close Modals
        $('#closeDeleteCheckOutModal, #closeConfirmCheckOutModal, #closeApproveCheckOutModal, #closeRejectCheckOutModal')
            .on('click', function() {
                $(this).closest('.fixed').addClass('hidden');
            });
    </script>
@endsection

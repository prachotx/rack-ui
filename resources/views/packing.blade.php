@extends('layouts.app')
@section('title', 'Packing')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 uppercase">
                <a class="btn btn-ghost text-xl">
                    <i class="fa-solid fa-boxes-packing"></i>
                    Packing
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
                        <a class="btn btn-success text-base-100" href="/add_packing"><i class="fa-solid fa-plus"></i>
                            Add</a>
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
                    @foreach ($packings as $item)
                        <tr>
                            <td><a class="text-blue-700" href="/view_packing/{{ $item->id }}">{{ $item->code }}</a></td>
                            <td>{{ $item->pack_date }}</td>
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
                                @if ($item->status == 'draft')
                                    <a class="btn btn-info text-base-100" href="/packing_detail/{{ $item->id }}"><i
                                            class="fa-solid fa-list"></i></a>
                                @endif
                                @if (Auth::user()->id == $item->pack_user_id and $item->status == 'draft')
                                    <a class="btn btn-warning text-base-100" href="/edit_packing/{{ $item->id }}"><i
                                            class="fa-solid fa-edit"></i></a>
                                    {{-- เพิ่มการตัวสอบว่า packing มี productsหรือไม่ --}}
                                    @php $all_detail=true; @endphp
                                    @foreach ($item->packing_details as $packing_detail)
                                        @if ($packing_detail->block_id == null)
                                            @php $all_detail=false; @endphp
                                        @endif
                                        {{-- เพิ่มการตัวสอบว่า packing มี productsหรือไม่ --}}
                                    @endforeach
                                    @if ($all_detail == true)
                                        <a class="btn btn-success text-base-100 confirm_packing" data-bs-toggle="modal"
                                            data-bs-target="#ConfirmPackingModal" data-item="{{ $item }}"
                                            href="#"><i class="fa-solid fa-check"></i></a>
                                    @endif
                                    <a class="btn btn-error text-base-100 delete_packing" data-bs-toggle="modal"
                                        data-bs-target="#DeletePackingModal" data-item="{{ $item }}"
                                        href="#"><i class="fa-solid fa-trash"></i></a>
                                @endif
                                @if ($item->status == 'confirm' or $item->status == 'approve')
                                    <a class="btn btn-info text-base-100" href="/view_packing/{{ $item->id }}"><i
                                            class="fa-solid fa-magnifying-glass"></i></a>
                                    <a class="btn btn-primary text-base-100" target="_blank"
                                        href="/print_packing/{{ $item->id }}"><i class="fa-solid fa-print"></i></a>
                                @endif
                                @if (Auth::user()->role == 'admin' and $item->status == 'confirm')
                                    <a class="btn btn-success text-base-100 approve_packing" data-bs-toggle="modal"
                                        data-bs-target="#ApprovePackingModal" data-item="{{ $item }}"
                                        href="#"><i class="fa-solid fa-thumbs-up"></i></a>
                                    <a class="btn btn-error text-base-100 reject_packing" data-bs-toggle="modal"
                                        data-bs-target="#RejectPackingModal" data-item="{{ $item }}"
                                        href="#"><i class="fa-solid fa-thumbs-down"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $packings->links('vendor.pagination.tailwind') }}
        </div>
    </div>

    <!-- Modal -->
    <div id="DeletePackingModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="form-delete-packing" action="" method="post">
                @csrf
                <div class="flex justify-between items-center p-4 border-b">
                    <h5 class="text-lg font-semibold">Delete Packing</h5>
                    <button type="button" class="btn-close" id="closeDeleteModal">×</button>
                </div>
                <div class="p-4">
                    <p><strong>Code: </strong><span class="code"></span></p>
                    <p><strong>Date: </strong><span class="date"></span></p>
                    <p><strong>Remark: </strong><span class="remark"></span></p>
                </div>
                <div class="flex justify-end p-4 border-t gap-2">
                    <button type="submit" class="btn btn-error text-base-100"><i class="fa-solid fa-trash"></i>
                        Delete</button>
                    <button type="button" class="btn" id="closeDeleteModalBtn">Close</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirm Packing Modal -->
    <div id="ConfirmPackingModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="form-confirm-packing" action="" method="post">
                @csrf
                <div class="flex justify-between items-center p-4 border-b">
                    <h5 class="text-lg font-semibold">Confirm Packing</h5>
                    <button type="button" class="btn-close" id="closeConfirmModal">×</button>
                </div>
                <div class="p-4">
                    <p><strong>Code: </strong><span class="code"></span></p>
                    <p><strong>Date: </strong><span class="date"></span></p>
                    <p><strong>Remark: </strong><span class="remark"></span></p>
                </div>
                <div class="flex justify-end p-4 border-t gap-2">
                    <button type="submit" class="btn btn-success text-base-100"><i class="fa-solid fa-check"></i>
                        Confirm</button>
                    <button type="button" class="btn" id="closeConfirmModalBtn">Close</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Approve Packing Modal -->
    <div id="ApprovePackingModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="form-approve-packing" action="" method="post">
                @csrf
                <div class="flex justify-between items-center p-4 border-b">
                    <h5 class="text-lg font-semibold">Approve Packing</h5>
                    <button type="button" class="btn-close" id="closeApproveModal">×</button>
                </div>
                <div class="p-4">
                    <p><strong>Code: </strong><span class="code"></span></p>
                    <p><strong>Date: </strong><span class="date"></span></p>
                    <p><strong>Remark: </strong><span class="remark"></span></p>
                </div>
                <div class="flex justify-end p-4 border-t gap-2">
                    <button type="submit" class="btn btn-success text-base-100"><i class="fa-solid fa-thumbs-up"></i>
                        Approve</button>
                    <button type="button" class="btn" id="closeApproveModalBtn">Close</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Reject Packing Modal -->
    <div id="RejectPackingModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="form-reject-packing" action="" method="post">
                @csrf
                <div class="flex justify-between items-center p-4 border-b">
                    <h5 class="text-lg font-semibold">Reject Packing</h5>
                    <button type="button" class="btn-close" id="closeRejectModal">×</button>
                </div>
                <div class="p-4">
                    <p><strong>Code: </strong><span class="code"></span></p>
                    <p><strong>Date: </strong><span class="date"></span></p>
                    <p><strong>Remark: </strong><span class="remark"></span></p>
                </div>
                <div class="flex justify-end p-4 border-t gap-2">
                    <button type="submit" class="btn btn-error text-base-100"><i class="fa-solid fa-thumbs-down"></i>
                        Reject</button>
                    <button type="button" class="btn" id="closeRejectModalBtn">Close</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        //todo:slug generate
        $(document).on('click', '.delete_packing', function(e) {
            let item = $(this).data('item');
            $('.code').text(item['code']);
            $('.date').text(item['pack_date']);
            $('.remark').text(item['remark']);
            document.getElementById("form-delete-packing").action = "/delete_packing/" + item['id'];
            $('#DeletePackingModal').removeClass('hidden');
        });

        $(document).on('click', '.confirm_packing', function(e) {
            let item = $(this).data('item');
            $('.code').text(item['code']);
            $('.date').text(item['pack_date']);
            $('.remark').text(item['remark']);
            document.getElementById("form-confirm-packing").action = "/confirm_packing/" + item['id'];
            $('#ConfirmPackingModal').removeClass('hidden');
        });

        $(document).on('click', '.approve_packing', function(e) {
            let item = $(this).data('item');
            $('.code').text(item['code']);
            $('.date').text(item['pack_date']);
            $('.remark').text(item['remark']);
            document.getElementById("form-approve-packing").action = "/approve_packing/" + item['id'];
            $('#ApprovePackingModal').removeClass('hidden');
        });

        $(document).on('click', '.reject_packing', function(e) {
            let item = $(this).data('item');
            $('.code').text(item['code']);
            $('.date').text(item['pack_date']);
            $('.remark').text(item['remark']);
            document.getElementById("form-reject-packing").action = "/reject_packing/" + item['id'];
            $('#RejectPackingModal').removeClass('hidden');
        });

        $('#closeDeleteModal, #closeDeleteModalBtn').on('click', function() {
            $('#DeletePackingModal').addClass('hidden');
        });
        $('#closeConfirmModal, #closeConfirmModalBtn').on('click', function() {
            $('#ConfirmPackingModal').addClass('hidden');
        });
        $('#closeApproveModal, #closeApproveModalBtn').on('click', function() {
            $('#ApprovePackingModal').addClass('hidden');
        });
        $('#closeRejectModal, #closeRejectModalBtn').on('click', function() {
            $('#RejectPackingModal').addClass('hidden');
        });
    </script>
@endsection

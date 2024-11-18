@extends('layouts.app')
@section('title', 'Racks')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 uppercase">
                <a class="btn btn-ghost text-xl">
                    <i class="fa-solid fa-align-justify fa-lg"></i>
                    Racks
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
                        <a class="btn btn-success text-base-100" href="/add_rack"><i class="fa-solid fa-plus"></i>
                            Add</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="p-[10px] border-base-400 border-2 border-t-0 rounded-b-box">
            <table class="table rounded shadow table-zebra">
                <thead class="bg-neutral text-neutral-content text-lg">
                    <tr>
                        <th class="rounded-tl" scope="col">Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Depth</th>
                        <th scope="col">Rows</th>
                        <th scope="col">Columns</th>
                        <th scope="col">Status</th>
                        <th class="rounded-tr" scope="col">Operation</th>
                    </tr>
                </thead>
                <tbody class="text-[16px]">
                    @foreach ($racks as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->location->name }}</td>
                            <td>{{ $item->depth }}</td>
                            <td>{{ $item->rows }}</td>
                            <td>{{ $item->columns }}</td>
                            <td>
                                @if ($item->status == 'approve')
                                    <div class="badge badge-success gap-2 text-base-100 w-16">
                                        {{ $item->status }}
                                    </div>
                                @elseif ($item->status == 'confirm')
                                    <div class="badge badge-info gap-2 text-base-100 w-16">
                                        {{ $item->status }}
                                    </div>
                                @else
                                    <div class="badge badge-warning gap-2 text-base-100 w-16">
                                        {{ $item->status }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if (Auth::user()->role == 'admin' and $item->status == 'draft')
                                    <a class="btn btn-warning text-base-100" href="/edit_rack/{{ $item->id }}"><i
                                            class="fa-solid fa-edit"></i></a>
                                    <a class="btn btn-success text-base-100 confirm_rack_details"
                                        data-item="{{ $item }}" href="#"><i
                                            class="fa-solid fa-check"></i></a>
                                    <a class="btn btn-error text-base-100 delete_rack_details"
                                        data-item="{{ $item }}" href="#"><i
                                            class="fa-solid fa-trash"></i></a>
                                @endif
                                @if ($item->status == 'confirm' or $item->status == 'disable')
                                    <a class="btn btn-info text-base-100" href="/view_rack/{{ $item->id }}"><i
                                            class="fa-solid fa-magnifying-glass"></i></a>
                                    @if ($item->status == 'disable')
                                        <a class="btn btn-success text-base-100 enable_rack_details"
                                            data-item="{{ $item }}" href="#"><i
                                                class="fa-regular fa-circle-check"></i></a>
                                    @else
                                        <a class="btn btn-error text-base-100 disable_rack_details"
                                            data-item="{{ $item }}" href="#"><i
                                                class="fa-solid fa-ban"></i></a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $racks->links('vendor.pagination.tailwind') }}
        </div>
    </div>

    <div id="DeleteRackModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="form-delete-rack" action="" method="post">
                @csrf
                <div class="flex justify-between items-center p-4 border-b">
                    <h5 class="text-lg font-semibold">Delete Rack</h5>
                    <button type="button" class="text-gray-500 hover:text-gray-700" id="closeDeleteModal">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
                <div class="p-4">
                    <p><strong>Code: </strong><span class="code"></span></p>
                    <p><strong>Location: </strong><span class="location"></span></p>
                    <p><strong>Depth: </strong><span class="depth"></span></p>
                    <p><strong>Rows: </strong><span class="rows"></span></p>
                    <p><strong>Columns: </strong><span class="columns"></span></p>
                </div>
                <div class="flex justify-end p-4 border-t gap-2">
                    <button type="submit" class="btn btn-error text-base-100">
                        <i class="fa-solid fa-trash"></i> Delete
                    </button>
                    <button type="button" class="btn" id="closeDeleteModalBtn">Close</button>
                </div>
            </form>
        </div>
    </div>

    <div id="ConfirmRackModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="form-confirm-rack" action="" method="post">
                @csrf
                <div class="flex justify-between items-center p-4 border-b">
                    <h5 class="text-lg font-semibold">Confirm Rack</h5>
                    <button type="button" class="text-gray-500 hover:text-gray-700" id="closeConfirmModal">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
                <div class="p-4">
                    <p><strong>Code: </strong><span class="code"></span></p>
                    <p><strong>Location: </strong><span class="location"></span></p>
                    <p><strong>Depth: </strong><span class="depth"></span></p>
                    <p><strong>Rows: </strong><span class="rows"></span></p>
                    <p><strong>Columns: </strong><span class="columns"></span></p>
                </div>
                <div class="flex justify-end p-4 border-t gap-2">
                    <button type="submit" class="btn btn-success text-base-100">
                        <i class="fa-solid fa-check"></i> Confirm
                    </button>
                    <button type="button" class="btn" id="closeConfirmModalBtn">Close</button>
                </div>
            </form>
        </div>
    </div>

    <div id="EnableRackModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="form-enable-rack" action="" method="post">
                @csrf
                <div class="flex justify-between items-center p-4 border-b">
                    <h5 class="text-lg font-semibold">Enable Rack</h5>
                    <button type="button" class="text-gray-500 hover:text-gray-700" id="closeEnableModal">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
                <div class="p-4">
                    <p><strong>Code: </strong><span class="code"></span></p>
                    <p><strong>Location: </strong><span class="location"></span></p>
                    <p><strong>Depth: </strong><span class="depth"></span></p>
                    <p><strong>Rows: </strong><span class="rows"></span></p>
                    <p><strong>Columns: </strong><span class="columns"></span></p>
                </div>
                <div class="flex justify-end p-4 border-t gap-2">
                    <button type="submit" class="btn btn-success text-base-100">
                        <i class="fa-regular fa-circle-check"></i> Enable
                    </button>
                    <button type="button" class="btn" id="closeEnableModalBtn">Close</button>
                </div>
            </form>
        </div>
    </div>

    <div id="DisableRackModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="form-disable-rack" action="" method="post">
                @csrf
                <div class="flex justify-between items-center p-4 border-b">
                    <h5 class="text-lg font-semibold">Disable Rack</h5>
                    <button type="button" class="text-gray-500 hover:text-gray-700" id="closeDisableModal">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
                <div class="p-4">
                    <p><strong>Code: </strong><span class="code"></span></p>
                    <p><strong>Location: </strong><span class="location"></span></p>
                    <p><strong>Depth: </strong><span class="depth"></span></p>
                    <p><strong>Rows: </strong><span class="rows"></span></p>
                    <p><strong>Columns: </strong><span class="columns"></span></p>
                </div>
                <div class="flex justify-end p-4 border-t gap-2">
                    <button type="submit" class="btn btn-error text-base-100">
                        <i class="fa-solid fa-ban"></i> Disable
                    </button>
                    <button type="button" class="btn" id="closeDisableModalBtn">Close</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        // Modal Delete Rack
        $(document).on('click', '.delete_rack_details', function(e) {
            let item = $(this).data('item');
            $('.code').text(item['code']);
            $('.location').text(item['location']['name']);
            $('.depth').text(item['depth']);
            $('.rows').text(item['rows']);
            $('.columns').text(item['columns']);
            document.getElementById("form-delete-rack").action = "/delete_rack/" + item['id'];
            $('#DeleteRackModal').removeClass('hidden');
        });

        // Modal Confirm Rack
        $(document).on('click', '.confirm_rack_details', function(e) {
            let item = $(this).data('item');
            $('.code').text(item['code']);
            $('.location').text(item['location']['name']);
            $('.depth').text(item['depth']);
            $('.rows').text(item['rows']);
            $('.columns').text(item['columns']);
            document.getElementById("form-confirm-rack").action = "/confirm_rack/" + item['id'];
            $('#ConfirmRackModal').removeClass('hidden');
        });

        // Modal Enable Rack
        $(document).on('click', '.enable_rack_details', function(e) {
            let item = $(this).data('item');
            $('.code').text(item['code']);
            $('.location').text(item['location']['name']);
            $('.depth').text(item['depth']);
            $('.rows').text(item['rows']);
            $('.columns').text(item['columns']);
            document.getElementById("form-enable-rack").action = "/enable_rack/" + item['id'];
            $('#EnableRackModal').removeClass('hidden');
        });

        // Modal Disable Rack
        $(document).on('click', '.disable_rack_details', function(e) {
            let item = $(this).data('item');
            $('.code').text(item['code']);
            $('.location').text(item['location']['name']);
            $('.depth').text(item['depth']);
            $('.rows').text(item['rows']);
            $('.columns').text(item['columns']);
            document.getElementById("form-disable-rack").action = "/disable_rack/" + item['id'];
            $('#DisableRackModal').removeClass('hidden');
        });

        // Close modals
        $('#closeDeleteModal, #closeDeleteModalBtn').on('click', function() {
            $('#DeleteRackModal').addClass('hidden');
        });
        $('#closeConfirmModal, #closeConfirmModalBtn').on('click', function() {
            $('#ConfirmRackModal').addClass('hidden');
        });
        $('#closeEnableModal, #closeEnableModalBtn').on('click', function() {
            $('#EnableRackModal').addClass('hidden');
        });
        $('#closeDisableModal, #closeDisableModalBtn').on('click', function() {
            $('#DisableRackModal').addClass('hidden');
        });
    </script>
@endsection

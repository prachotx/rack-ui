@extends('layouts.app')
@section('title', 'Packing Detail')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 justify-between">
                <a class="btn btn-ghost text-xl uppercase">
                    <i class="fa-solid fa-boxes-packing"></i>
                    Packing Detail
                </a>
                @if (Auth::user()->id == $packing->pack_user_id and $packing->status == 'draft')
                    <a class="btn btn-success text-base-100" href="/add_packing_detail/{{ $packing->id }}"><i
                            class="fa-solid fa-plus"></i>Add</a>
                @endif
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
            <div class="grid grid-cols-8 items-center">
                <label for="remark" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Remark</kbd></label>
                <label name="remark" class="col-sm-3 col-form-label">{{ $packing->remark }}</label>
                <label for="status" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Status</kbd></label>
                <label name="status" class="col-sm-3 col-form-label">
                    @if ($packing->status == 'approve')
                        <div class="badge badge-success gap-2 text-base-100 w-16">
                            {{ $packing->status }}
                        </div>
                    @elseif ($packing->status == 'confirm')
                        <div class="badge badge-info gap-2 text-base-100 w-16">
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
                <tbody class="text-[16px]">
                    @foreach ($packing->packing_details as $item)
                        <tr>
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
                                    <a class="btn btn-error text-base-100 delete_packing_detail"
                                        data-item="{{ $item }}" href="#">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div id="DeletePackingDetailModal"
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="form-delete-packing_detail" action="" method="post">
                @csrf
                <div class="flex justify-between items-center p-4 border-b">
                    <h5 class="text-lg font-semibold">Delete Packing Detail</h5>
                    <button type="button" class="btn-close text-lg" id="closeDeletePackingDetailModal">×</button>
                </div>
                <div class="p-4">
                    <p><kbd class="kbd mr-2 mb-2">Product Code</kbd><span class="code"></span></p>
                    <p><kbd class="kbd mr-2 mb-2">Ref No</kbd><span class="ref_no"></span></p>
                    <p><kbd class="kbd mr-2">Quantity</kbd><span class="quantity"></span></p>
                </div>
                <div class="flex justify-end p-4 border-t gap-2">
                    <button type="submit" class="btn btn-error text-base-100">
                        <i class="fa-solid fa-trash"></i> Delete
                    </button>
                    <button type="button" class="btn" id="closeDeletePackingDetailModalBtn">Close</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        //todo:slug generate
        $(document).on('click', '.delete_packing_detail', function(e) {
            let item = $(this).data('item');
            $('.code').text(item['product']['code']);
            $('.ref_no').text(item['ref_no']);
            $('.quantity').text(item['quantity']);
            document.getElementById("form-delete-packing_detail").action = "/delete_packing_detail/" + item['id'];
            $('#DeletePackingDetailModal').removeClass('hidden');
        });

        // Close Modal
        $('#closeDeletePackingDetailModal, #closeDeletePackingDetailModalBtn').on('click', function() {
            $('#DeletePackingDetailModal').addClass('hidden');
        });
    </script>
@endsection

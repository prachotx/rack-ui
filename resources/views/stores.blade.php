@extends('layouts.app')
@section('title', 'Stores')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 uppercase">
                <a class="btn btn-ghost text-xl">
                    <i class="fa-solid fa-store"></i>
                    Stores
                </a>
            </div>
            <div class="flex-none gap-2">
                <form class="flex" role="search">
                    <input type="search" placeholder="Search" aria-label="Search" name="search" value="{{ $search }}"
                        class="input input-bordered w-auto" />
                    <button class="btn ml-2" type="submit">Search</button>
                </form>
                <div class="dropdown dropdown-end">

                </div>
            </div>
        </div>
        <div class="p-[10px] border-base-400 border-2 border-t-0 rounded-b-box">
            <table class="table rounded shadow table-zebra">
                <thead class="bg-neutral text-neutral-content text-lg">
                    <tr>
                        <th class="rounded-tl" scope="col">Product Code</th>
                        <th scope="col">Ref No.</th>
                        <th scope="col">Remain Quantity</th>
                        <th scope="col">Rack</th>
                        <th class="rounded-tr" scope="col">Block</th>
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $packing_details->links('vendor.pagination.tailwind') }}
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="DeletePackingDetailModal" tabindex="-1" aria-labelledby="DeletePackingDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form-delete-packing_detail" action="" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="DeletePackingDetailModalLabel">Delete Packing Detail</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Product Code: </strong><span class="code"></span></p>
                        <p><strong>Ref No: </strong><span class="ref_no"></span></p>
                        <p><strong>Quantity: </strong><span class="quantity"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
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
        });
    </script>
@endsection

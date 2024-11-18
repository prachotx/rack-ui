@extends('layouts.app')
@section('title', 'Edit Packing Detail')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 uppercase">
                <a class="btn btn-ghost text-xl">
                    <i class="fa-solid fa-boxes-packing"></i>
                    Edit Packing Detail
                </a>
            </div>
        </div>
        <div class="p-[20px] border-base-400 border-2 border-t-0 rounded-b-box">
            <div class="mb-3 grid grid-cols-8 items-center">
                <label for="packing" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Packing</kbd></label>
                <label name="packing" class="col-sm-3 col-form-label"><a
                        href="/view_packing/{{ $packing_detail->packing->id }}">{{ $packing_detail->packing->code }}</a></label>
                <label for="date" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Date</kbd></label>
                <label name="date" class="col-sm-3 col-form-label">{{ $packing_detail->packing->pack_date }}</label>
            </div>
            <div class="mb-3 grid grid-cols-8 items-center">
                <label for="remark" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Remark</kbd></label>
                <label name="remark" class="col-sm-3 col-form-label">{{ $packing_detail->packing->remark }}</label>
                <label for="status" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Status</kbd></label>
                <label name="status" class="col-sm-3 col-form-label">
                    @if ($packing_detail->packing->status == 'approve')
                        <div class="badge badge-success gap-2 text-base-100 w-16 font-semibold">
                            {{ $packing_detail->packing->status }}
                        </div>
                    @elseif ($packing_detail->packing->status == 'confirm')
                        <div class="badge badge-info gap-2 text-base-100 w-16 font-semibold">
                            {{ $packing_detail->packing->status }}
                        </div>
                    @else
                        <div class="badge badge-warning gap-2 text-base-100 w-16 font-semibold">
                            {{ $packing_detail->packing->status }}
                        </div>
                    @endif
                </label>
            </div>
            <form method="POST" action="/update_packing_detail/{{ $packing_detail->id }}">
                @csrf
                <div class="mb-3 row">
                    <label for="product_code" class="font-bold">Product Code</label>
                    <div class="mt-3">
                        {!! Form::select('product_id', $products, $packing_detail->product->id, ['class' => 'select2 select select-bordered w-full']) !!}
                    </div>
                </div>
                @error('product_code')
                    <div class="my-3">
                        <span class="text-error">{{ $message }}</span>
                    </div>
                @enderror

                <div class="mb-3">
                    <label for="ref_no" class="font-bold">Ref No.</label>
                    <div class="mt-3">
                        <input type="text" name="ref_no" class="input input-bordered w-full" value="{{ $packing_detail->ref_no }}">
                    </div>
                </div>
                @error('ref_no')
                    <div class="my-3">
                        <span class="text-error">{{ $message }}</span>
                    </div>
                @enderror

                <div class="mb-3">
                    <label for="quantity" class="font-bold">Quantity</label>
                    <div class="mt-3">
                        <input type="text" name="quantity" class="input input-bordered w-full" value="{{ $packing_detail->quantity }}">
                    </div>
                </div>
                @error('quantity')
                    <div class="my-3">
                        <span class="text-error">{{ $message }}</span>
                    </div>
                @enderror

                @if (Auth::user()->role == 'admin')
                    <div class="mt-[20px] text-center">
                        <input type="submit" value="Save" class="btn btn-primary w-[300px] text-lg">
                    </div>
                @endif
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="DeleteRackModal" tabindex="-1" aria-labelledby="DeleteRackModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form-delete-rack" action="" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="DeleteRackModalLabel">Delete Rack</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Code: </strong><span class="code"></span></p>
                        <p><strong>Location: </strong><span class="location"></span></p>
                        <p><strong>Depth: </strong><span class="depth"></span></p>
                        <p><strong>Rows: </strong><span class="rows"></span></p>
                        <p><strong>Columns: </strong><span class="columns"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ConfirmRackModal" tabindex="-1" aria-labelledby="ConfirmRackModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form-confirm-rack" action="" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="ConfirmRackModalLabel">Confirm Rack</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Code: </strong><span class="code"></span></p>
                        <p><strong>Location: </strong><span class="location"></span></p>
                        <p><strong>Depth: </strong><span class="depth"></span></p>
                        <p><strong>Rows: </strong><span class="rows"></span></p>
                        <p><strong>Columns: </strong><span class="columns"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i> Confirm</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DisableRackModal" tabindex="-1" aria-labelledby="DisableRackModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form-disable-rack" action="" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="DisableRackModalLabel">Disable Rack</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Code: </strong><span class="code"></span></p>
                        <p><strong>Location: </strong><span class="location"></span></p>
                        <p><strong>Depth: </strong><span class="depth"></span></p>
                        <p><strong>Rows: </strong><span class="rows"></span></p>
                        <p><strong>Columns: </strong><span class="columns"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-ban"></i> Disable</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="EnableRackModal" tabindex="-1" aria-labelledby="EnableRackModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form-enable-rack" action="" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="EnableRackModalLabel">Enable Rack</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Code: </strong><span class="code"></span></p>
                        <p><strong>Location: </strong><span class="location"></span></p>
                        <p><strong>Depth: </strong><span class="depth"></span></p>
                        <p><strong>Rows: </strong><span class="rows"></span></p>
                        <p><strong>Columns: </strong><span class="columns"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fa-regular fa-circle-check"></i>
                            Enable</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        //todo:slug generate
        $(document).on('click', '.delete_rack_details', function(e) {
            let item = $(this).data('item');

            $('.code').text(item['code']);
            $('.location').text(item['location']['name']);
            $('.depth').text(item['depth']);
            $('.rows').text(item['rows']);
            $('.columns').text(item['columns']);
            document.getElementById("form-delete-rack").action = "/delete_rack/" + item['id'];
        });
        $(document).on('click', '.confirm_rack_details', function(e) {
            let item = $(this).data('item');

            $('.code').text(item['code']);
            $('.location').text(item['location']['name']);
            $('.depth').text(item['depth']);
            $('.rows').text(item['rows']);
            $('.columns').text(item['columns']);
            document.getElementById("form-confirm-rack").action = "/confirm_rack/" + item['id'];
        });

        $(document).on('click', '.disable_rack_details', function(e) {
            let item = $(this).data('item');

            $('.code').text(item['code']);
            $('.location').text(item['location']['name']);
            $('.depth').text(item['depth']);
            $('.rows').text(item['rows']);
            $('.columns').text(item['columns']);
            document.getElementById("form-disable-rack").action = "/disable_rack/" + item['id'];
        });
        $(document).on('click', '.enable_rack_details', function(e) {
            let item = $(this).data('item');

            $('.code').text(item['code']);
            $('.location').text(item['location']['name']);
            $('.depth').text(item['depth']);
            $('.rows').text(item['rows']);
            $('.columns').text(item['columns']);
            document.getElementById("form-enable-rack").action = "/enable_rack/" + item['id'];
        });
    </script>
@endsection

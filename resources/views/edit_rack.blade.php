@extends('layouts.app')
@section('title', 'Edit Rack')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 uppercase">
                <a class="btn btn-ghost text-xl">
                    <i class="fas fa-align-justify fa-lg"></i>
                    Edit Rack
                </a>
            </div>
        </div>
        <div class="p-[20px] border-base-400 border-2 border-t-0 rounded-b-box">
            <form method="POST" action="/update_rack/{{ $rack->id }}">
                @csrf
                <div class="mb-3">
                    <label for="code" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Code</kbd></label>
                    <label name="code" class="col-sm-2 col-form-label">{{ $rack->code }}</label>
                </div>

                <div class="mb-3">
                    <label for="name" class="font-bold">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="input input-bordered w-full"
                            value="{{ $rack->name }}">
                    </div>
                </div>
                @error('name')
                    <div class="my-3">
                        <span class="text-error">{{ $message }}</span>
                    </div>
                @enderror

                <div class="mb-3">
                    <label for="location_id" class="font-bold">Location</label>
                    <div class="col-sm-10">
                        {!! Form::select('location_id', $locations, $rack->location_id, ['class' => 'select select-bordered w-full']) !!}
                    </div>
                </div>
                @error('location_id')
                    <div class="my-3">
                        <span class="text-error">{{ $message }}</span>
                    </div>
                @enderror

                <div class="mb-3">
                    <label for="depth" class="font-bold">Depth</label>
                    <div class="col-sm-10">
                        <input type="text" name="depth" class="input input-bordered w-full"
                            value="{{ $rack->depth }}">
                    </div>
                </div>
                @error('depth')
                    <div class="my-3">
                        <span class="text-error">{{ $message }}</span>
                    </div>
                @enderror

                <div class="mb-3">
                    <label for="rows" class="font-bold">Rows</label>
                    <div class="col-sm-10">
                        <input type="text" name="rows" class="input input-bordered w-full"
                            value="{{ $rack->rows }}">
                    </div>
                </div>
                @error('rows')
                    <div class="my-3">
                        <span class="text-error">{{ $message }}</span>
                    </div>
                @enderror

                <div class="mb-3">
                    <label for="columns" class="font-bold">Columns</label>
                    <div class="col-sm-10">
                        <input type="text" name="columns" class="input input-bordered w-full"
                            value="{{ $rack->columns }}">
                    </div>
                </div>
                @error('columns')
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
@endsection

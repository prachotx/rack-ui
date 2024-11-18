@extends('layouts.app')
@section('title', 'Edit Block')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 uppercase">
                <a class="btn btn-ghost text-xl">
                    <i class="fa-solid fa-cube"></i>
                    Edit Block
                </a>
            </div>
        </div>
        <div class="p-[20px] border-base-400 border-2 border-t-0 rounded-b-box">
            <form method="POST" action="/update_block/{{ $block->id }}">
                @csrf
                <div class="mb-3 grid grid-cols-10 items-center">
                    <label for="rack" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Rack</kbd></label>
                    <label name="rack" class="col-form-label"><a
                            href="/view_rack/{{ $block->rack->id }}">{{ $block->rack->name }}</a></label>
                    <label for="code" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Code</kbd></label>
                    <label name="code" class="col-form-label"><a
                            href="/view_block/{{ $block->id }}">{{ $block->code }}</a></label>
                </div>
                <div class="mb-3 grid grid-cols-10 items-center">
                    <label for="row" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Row</kbd></label>
                    <label name="row" class="col-form-label">{{ $block->row_position }}</label>
                    <label for="column" class="col-sm-2 col-form-label fw-bold"><kbd class="kbd">Column</kbd></label>
                    <label name="column" class="col-form-label">{{ $block->column_position }}</label>
                </div>

                <div class="mb-3">
                    <label for="depth" class="font-bold">Depth</label>
                    <div class="mt-3">
                        <input type="text" name="depth" class="input input-bordered w-full" value="{{ $block->depth }}"
                            readonly>
                    </div>
                </div>
                @error('depth')
                    <div class="my-3">
                        <span class="text-error">{{ $message }}</span>
                    </div>
                @enderror

                <div class="mb-3">
                    <label for="long" class="font-bold">Long</label>
                    <div class="mt-3">
                        <input type="text" name="long" class="input input-bordered w-full" value="{{ $block->long }}">
                    </div>
                </div>
                @error('long')
                    <div class="my-3">
                        <span class="text-error">{{ $message }}</span>
                    </div>
                @enderror

                <div class="mb-3">
                    <label for="height" class="font-bold">Height</label>
                    <div class="mt-3">
                        <input type="text" name="height" class="input input-bordered w-full" value="{{ $block->height }}">
                    </div>
                </div>
                @error('height')
                    <div class="my-3">
                        <span class="text-error">{{ $message }}</span>
                    </div>
                @enderror

                <div class="mb-3">
                    <label for="remain_height" class="font-bold">Remain Height (%)</label>
                    <div class="mt-3">
                        <input type="text" name="remain_height" class="input input-bordered w-full"
                            value="{{ $block->remain_height }}">
                    </div>
                </div>
                @error('remain_height')
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

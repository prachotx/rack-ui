@extends('layouts.app')
@section('title', 'Add Product Type')
@section('content')
<div class="shadow rounded-box mx-auto">
    <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
        <div class="flex-1 uppercase">
            <a class="btn btn-ghost text-xl">
                <i class="fa-brands fa-intercom"></i>
                Add Product Type
            </a>
        </div>
    </div>
    <div class="p-[20px] border-base-400 border-2 border-t-0 rounded-b-box">
        <form method="POST" action="/create_product_type">
            @csrf
            <div class="mb-3">
                <label for="name" class="font-bold">Name</label>
                <div class="mt-3">
                    <input type="text" name="name" class="input input-bordered w-full">
                </div>
            </div>
            @error('name')
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
@extends('layouts.app')
@section('title', 'Add Product')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 uppercase">
                <a class="btn btn-ghost text-xl">
                    <i class="fa-solid fa-briefcase"></i>
                    Add Product
                </a>
            </div>
        </div>
        <div class="p-[20px] border-base-400 border-2 border-t-0 rounded-b-box">
            <form method="POST" action="/create_product">
                @csrf
                <div class="mb-3">
                    <label for="code" class="font-bold">Code</label>
                    <div class="mt-3">
                        <input type="text" name="code" class="input input-bordered w-full">
                    </div>
                </div>
                @error('code')
                    <div class="my-3">
                        <span class="text-error">{{ $message }}</span>
                    </div>
                @enderror

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

                <div class="mb-3">
                    <label for="product_type_id" class="font-bold">Product Type</label>
                    <div class="mt-3">
                        {!! Form::select('product_type_id', $product_types, 0, ['class' => 'select select-bordered w-full']) !!}
                    </div>
                </div>
                @error('product_type_id')
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

@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 uppercase">
                <a class="btn btn-ghost text-xl">
                    <i class="fas fa-address-book fa-lg"></i>
                    Edit User
                </a>
            </div>
        </div>
        <div class="p-[20px] border-base-400 border-2 border-t-0 rounded-b-box">
            <form method="POST" action="/update_user/{{ $user->id }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="font-bold mb-2">Email</label>
                    <div class="mt-3">
                        <input type="text" name="email" class="input input-bordered w-full"
                            value="{{ $user->email }}">
                    </div>
                </div>
                @error('email')
                    <div class="my-3">
                        <span class="text-error">{{ $message }}</span>
                    </div>
                @enderror
                <div class="mb-3">
                    <label for="name" class="font-bold mb-2">Name</label>
                    <div class="mt-3">
                        <input type="text" name="name" class="input input-bordered w-full"
                            value="{{ $user->name }}">
                    </div>
                </div>
                @error('name')
                    <div class="my-3">
                        <span class="text-error">{{ $message }}</span>
                    </div>
                @enderror
                <div class="grid grid-cols-2 gap-[20px]">
                    <div>
                        <label for="role" class="font-bold mb-2">Role</label>
                        <div class="mt-3">
                            {!! Form::select('role', ['admin' => 'Admin', 'super visor' => 'Super Visor', 'staff' => 'Staff'], $user->role, [
                                'class' => 'select select-bordered w-full',
                            ]) !!}
                        </div>
                        @error('role')
                            <div class="my-3">
                                <span class="text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label for="branch_id" class="font-bold mb-2">Branch</label>
                        <div class="mt-3">
                            {!! Form::select('branch_id', $branches, $user->branch_id, [
                                'class' => 'select select-bordered w-full',
                            ]) !!}
                        </div>
                        @error('branch_id')
                            <div class="my-3">
                                <span class="text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>
                @if (Auth::user()->role == 'admin')
                    <div class="mt-[20px] text-center">
                        <input type="submit" value="Save" class="btn btn-primary w-[300px] text-lg">
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection

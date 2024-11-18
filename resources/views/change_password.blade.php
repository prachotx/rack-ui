@extends('layouts.app')
@section('title', 'Change Password')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 uppercase">
                <a class="btn btn-ghost text-xl">
                    <i class="fas fa-address-book fa-lg"></i>
                    Change Password
                </a>
            </div>
        </div>
        <div class="p-[20px] border-base-400 border-2 border-t-0 rounded-b-box">
            <form method="POST" action="/update_password/{{ $user->id }}">
                @csrf
                <div class="grid grid-cols-8 items-center">
                    <label for="email" class="col-sm-3 col-form-label"><kbd class="kbd">Email</kbd></label>
                    <label for="email" class="col-sm-9 col-form-label">{{ $user->email }}</label>
                </div>

                <div class="grid grid-cols-8 items-center my-[20px]">
                    <label for="name" class="col-sm-3 col-form-label"><kbd class="kbd">Name</kbd></label>
                    <label for="email" class="col-sm-9 col-form-label">{{ $user->name }}</label>
                </div>
                <div class="mb-2">
                    <label for="password" class="font-bold">Password</label>
                    <div class="mt-2">
                        <input id="password" type="password" class="input input-bordered w-full"
                            name="password" required autocomplete="new-password">
                    </div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div>
                    <label for="password-confirm" class="font-bold">Confirm Password</label>
                    <div class="mt-2">
                        <input id="password-confirm" type="password" class="input input-bordered w-full" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>
                </div>
                @if ($user->id == Auth::user()->id or Auth::user()->role == 'admin')
                    <div class="mt-[20px] text-center">
                        <input type="submit" value="Save" class="btn btn-primary w-[300px] text-lg">
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection

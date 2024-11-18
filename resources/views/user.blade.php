@extends('layouts.app')
@section('title', 'Users')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 uppercase">
                <a class="btn btn-ghost text-xl">
                    <i class="fas fa-address-book fa-lg"></i>
                    Users
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
                        <a class="btn btn-success text-base-100" href="/add_user"><i class="fa-solid fa-plus"></i>
                            Add</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="p-[10px] border-base-400 border-2 border-t-0 rounded-b-box">
            <table class="table rounded shadow table-zebra">
                <thead class="bg-neutral text-neutral-content text-lg">
                    <tr>
                        <th class="rounded-tl" scope="col">Email</th>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Branch</th>
                        <th class="rounded-tr" scope="col">Operation</th>
                    </tr>
                </thead>
                <tbody class="text-[16px]">
                    @foreach ($users as $item)
                        <tr>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->role }}</td>
                            <td>{{ $item->branch->name }}</td>
                            <td class="flex gap-2">
                                @if (Auth::user()->role == 'admin')
                                    <a class="btn btn-warning text-base-100" href="/edit_user/{{ $item->id }}"><i
                                            class="fa-solid fa-edit"></i></a>
                                @endif
                                @if ($item->id == Auth::user()->id or Auth::user()->role == 'admin')
                                    <a class="btn btn-info text-base-100" href="/change_password/{{ $item->id }}"><i
                                            class="fa-solid fa-arrows-rotate"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links('vendor.pagination.tailwind') }}
        </div>
    </div>
@endsection

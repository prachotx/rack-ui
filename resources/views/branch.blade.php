@extends('layouts.app')
@section('title', 'Branches')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 uppercase">
                <a class="btn btn-ghost text-xl">
                    <i class="fa-solid fa-code-branch fa-lg"></i>
                    Branches
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
                        <a class="btn btn-success text-base-100" href="/add_branch"><i class="fa-solid fa-plus"></i>Add</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="p-[10px] border-base-400 border-2 border-t-0 rounded-b-box">
            <table class="table rounded shadow table-zebra">
                <thead class="bg-neutral text-neutral-content text-lg">
                    <tr>
                        <th class="rounded-tl" scope="col">Name</th>
                        <th class="rounded-tr" scope="col">Operation</th>
                    </tr>
                </thead>
                <tbody class="text-[16px]">
                    @foreach ($branches as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>
                                @if (Auth::user()->role == 'admin')
                                    <a class="btn btn-warning text-base-100" href="/edit_branch/{{ $item->id }}"><i
                                            class="fa-solid fa-edit"></i></a>
                                    <a href="#" class="btn btn-error text-base-100 delete_branch"
                                        data-item="{{ json_encode($item) }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $branches->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div id="DeleteBranchModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <form id="form-branch" action="" method="post">
                @csrf
                <div class="flex justify-between items-center p-4 border-b">
                    <h5 class="text-lg font-semibold">Delete Branch</h5>
                </div>
                <div class="p-4">
                    <p><kbd class="kbd mr-2">Name</kbd><span class="name"></span></p>
                </div>
                <div class="flex justify-end p-4 border-t gap-2">
                    <button type="submit" class="btn btn-error text-base-100">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                    <button type="button" class="btn"
                        id="closeModalBtn">Close</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).on('click', '.delete_branch', function(e) {
            e.preventDefault();
            let item = $(this).data('item');
            $('.name').text(item['name']);
            document.getElementById("form-branch").action = "/delete_branch/" + item['id'];
            $('#DeleteBranchModal').removeClass('hidden');
        });

        $('#closeModalBtn').on('click', function() {
            $('#DeleteBranchModal').addClass('hidden');
        });
    </script>
@endsection

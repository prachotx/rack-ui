@extends('layouts.app')
@section('title', 'Add Packing')
@section('content')
    <div class="shadow rounded-box mx-auto">
        <div class="navbar bg-base-200 rounded-t-box border-base-400 border-2">
            <div class="flex-1 uppercase">
                <a class="btn btn-ghost text-xl">
                    <i class="fa-solid fa-boxes-packing"></i>
                    Add Packing
                </a>
            </div>
        </div>
        <div class="p-[20px] border-base-400 border-2 border-t-0 rounded-b-box">
            <form method="POST" action="/create_packing">
                @csrf
                <div class="mb-3">
                    <label for="pack_date" class="font-bold">Date</label>
                    <div class="mt-3">
                        <input type="date" id="date" name="pack_date" class="input input-bordered w-full">
                    </div>
                </div>
                @error('pack_date')
                    <div class="my-3">
                        <span class="text-error">{{ $message }}</span>
                    </div>
                @enderror

                <div class="mb-3">
                    <label for="remark" class="font-bold">Remark</label>
                    <div class="mt-3">
                        <input type="text" name="remark" class="input input-bordered w-full">
                    </div>
                </div>
                @error('remark')
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

    <script>
        $(document).ready(function() {
            $('#date').datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                autoclose: true,
            });
        });
    </script>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tools</div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Code</th>
                                <th scope="col">Name</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">Last Calibrate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tools as $item)
                            <tr>
                                <td>{{$item->code}}</td>
                                <td>{{$item->testMethod->name}}</td>
                                <td>{{$item->calibrate->due_date}}</td>
                                <td>{{$item->calibrate->code}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
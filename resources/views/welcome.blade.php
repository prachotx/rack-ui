@extends('layouts.app')
@section('title','Calibrations')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <nav class="navbar navbar-expand-lg">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="#">Tools</a>
                            <div class="navbar-collapse justify-content-end">
                                <form class="d-flex" role="search">
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </div> &nbsp;
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">+ Add</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
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
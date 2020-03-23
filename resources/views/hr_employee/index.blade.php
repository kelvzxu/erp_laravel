@extends('layouts.admin')
@section('title','SK - Employee')
@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
        {{ session('status') }}
        </div>
    @endif
    <!-- header -->
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('employee')}}">Employee</a></li>
                    </ol>
                </nav>
            </div>
            <h3>Employee List</h3>
        </div>
        <div class="col-12 col-md-5 text-right">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search...." aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </div>
        </div>
    </div>
    <!-- header button -->
    <div class="row">
        <div class="col-3">
            <a href="{{route('employee.new')}}" class="btn btn-primary">Create</a>
        </div>
    </div>

    <div class="table-responsive-lg my-4">
        <table class="table">
        <caption>Employee List</caption>
            <thead class="table table-sm">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col">City</th>
                    <th scope="col">State</th>
                    <th scope="col">Department</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            @foreach($employee as $emp)
            <tbody>
                <tr>
                    <th scope="row">{{$loop->iteration}}
                    <th >{{$emp->photo}}</th>
                    <th >{{$emp->employee_name}}</th>
                    <th >{{$emp->city}}</th>
                    <th >{{$emp->state_name}}</th>
                    <th >{{$emp->department_id}}</th>
                    <th >
                        <a href="" class="badge badge-success">view detail</a>
                    </th>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</div>
@endsection

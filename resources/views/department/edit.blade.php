@extends('layouts.admin')
@section('title','SK - New Customer')
@section('content')

    <div class="page-wrapper">
    @if (session('error'))
        <div class="alert alert-danger">
        {{ session('error') }}
        </div>
    @endif


        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">System Management</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('department')}}">Department</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="card">
                        <form action="{{route('department.update',$department->id)}}" method="post" class="form-horizontal">
                            @csrf
                            <div class="card-body">
                                    <h4 class="card-title">Department</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Department Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="department_name" class="form-control" id="fname" placeholder="Enter a department name" value="{{$department->department_name}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Complete Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="complete_name" class="form-control" id="fname" placeholder="Enter a department Complete name" value="{{$department->complete_name}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Parent Department</label>
                                        <div class="col-sm-3">
                                            <select id="parent_id" name="parent_id" class="form-control">
                                                <option value="">Parent Dept</option>
                                                @foreach ($departments as $row)
                                                    <option value="{{ $row->id }}" {{ $row->id == $department -> parent_id ? 'selected':'' }}>
                                                        {{ ucfirst($row->department_name) }}
                                                    </option>
                                                @endforeach
                                            </select>                                        
                                        </div>
                                        <label for="fname" class="col-sm-2 text-right control-label col-form-label">Manager Name</label>
                                        <div class="col-sm-4">
                                            <select id="manager_id" name="manager_id" class="form-control">
                                                <option value="">manager</option>
                                                @foreach ($employee as $row)
                                                    <option value="{{ $row->id }}" {{ $row->id == $department -> manager_id ? 'selected':'' }}>
                                                        {{ ucfirst($row->employee_name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Complete Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="note" class="form-control" id="fname" placeholder="Description">
                                        </div>
                                    </div>
                                </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fa fa-send"></i> Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
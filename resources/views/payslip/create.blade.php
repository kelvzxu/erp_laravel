@extends('layouts.admin')
@section('title','SK - New Customer')
@section('content')
<div class="container">
    @if (session('error'))
        <div class="alert alert-danger">
        {{ session('error') }}
        </div>
    @endif
    <!-- header -->
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('payslip')}}">payslip</a></li>
                        <li class="breadcrumb-item" aria-current="page">Create Payslip</li>
                    </ol>
                </nav>
            </div>
            <h3>Create Payslip</h3>
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
    <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-3">
        <button class="btn btn-primary btn-sm">
                <i class="fa fa-send"></i> Save
            </button>
        </div>
    </div>

    </form>
    <div class="container my-3 bg-white">
        <br>
        @csrf
        <div class="row">
            <div class="col-sm-9">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Employee Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" class="form-control" value="{{$employee->employee_name}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Identification No</label>
                    <div class="col-sm-9">
                        <input type="text" name="identification_id" id="identification_id" class="form-control" value="{{$employee->identification_id}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Gender</label>
                    <div class="col-sm-4">
                        <input type="text" name="gender" id="gender" class="form-control" value="{{$employee->gender}}" readonly>
                    </div>
                    <label class="col-sm-1 col-form-label">Marital</label>
                    <div class="col-sm-4">
                        <input type="text" name="marital" id="marital" class="form-control" value="{{$employee->marital}}" readonly>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 text-center d-sm-none d-md-block ">
                <img src="{{asset('uploads/Employees/'.$employee->photo)}}" width=120px>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">department</label>
                    <div class="col-sm-4">
                        <input type="text" name="department" id="department" class="form-control" value="{{$employee->department_name}}" readonly>
                    </div>
                    <label class="col-sm-1 col-form-label">Designation</label>
                    <div class="col-sm-4">
                    <input type="text" name="jobs" id="jobs" class="form-control" value="{{$employee->jobs_name}}" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Date From</label>
                    <div class="col-sm-4">
                        <input type="date" name="drom" id="drom" class="form-control">
                    </div>
                    <label class="col-sm-1 col-form-label">To</label>
                    <div class="col-sm-4">
                    <input type="date" name="to" id="to" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-sm-3 text-center d-sm-none d-md-block ">
                <a class="btn btn-outline-success btn-primary text-white" id="hitung">Calculate</a>
            </div>
        </div>
        <hr>
        <div id="salarydetail">
            <div class="row">
                <h3 class="col-sm-10 font-weight-bold text-primary">Salary Detail</h3>
            </div>
            <div class="row">
                <label class="col-sm-3">employee salary</label>
                <div class="col-sm-7">
                    <input type="text" style="border:none" name="salary" id="salary" value="{{$employee->salary}}" readonly>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3">employee attendance</label>
                <div class="col-sm-7">
                    <input type="text" style="border:none" name="attendance" id="attendance" readonly>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-3">employee leave</label>
                <div class="col-sm-7">
                    <input type="text" style="border:none" name="salary" id="salary" value="{{$employee->salary}}" readonly>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
$.ajax  ({
    url: "{{asset('api/atd-count')}}",
    type: 'post',
    dataType: 'json',
    data :{
        'id': "{{ Auth::user()->email}}"
    },
    success: function (result) {
        $('#profile').append(`
            <img width="42" id="picture_profile" class="rounded" src="{{asset('uploads/Employees/`+result.data.photo+`')}}"
                alt="">
                                `);
        $(".widget-subheading").append(`<pre>`+result.data.jobs_name+`</pre>`)
    }
})
</script>
<script src="{{asset('js/employee.js')}}"></script>
@endsection
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('payslip')}}">Payslip</a></li>
                    </ol>
                </nav>
            </div>
            <h3>Employee Payslip</h3>
        </div>
        <div class="col-12 col-md-5 text-right">
            <form action="{{ route('payslip.filter') }}" method="get" >
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <select class="input-group-text bg-primary text-white" name="filter">
                                <option value="" selected>Filter By</option>
                                <option value="employee_name">Employee name</option>
                                <option value="department_name">Department</option>
                                <option value="jobs_name">Jobs</option>
                                <option value="city">City</option>
                        </select>
                    </div>
                    <input type="text" class="form-control" placeholder="Search...." name="value">
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit"><i class="fa fa-search" aria-hidden="true"> Search</i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- header button -->
    <!-- <div class="row">
        <div class="col-3">
            <a href="{{route('employee.new')}}" class="btn btn-primary">Create</a>
        </div>
    </div> -->

    <div class="table-responsive-lg my-4">
        <table class="table">
        <caption>Employee List</caption>
            <thead class="table table-sm">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Department</th>
                    <th scope="col">Jobs Position</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            @forelse($employee as $emp)
            <tbody>
                <tr> 
                    <th scope="row">{{$loop->iteration}}
                    <th ><img src="{{asset('uploads/Employees/'.$emp->photo)}}" width=50px></th>
                    <th >{{$emp->employee_name}}</th>
                    <th >{{$emp->department_name}}</th>
                    <th >{{$emp->jobs_name}}</th>
                    <th >
                        <a href="{{route('payslip.create',$emp->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit">  Create Payslip</i></a>
                    </th>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Jobs is Empty</td>
                </tr>
            </tbody>
            @endforelse
            {{ $employee->links() }}
        </table>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
    $('a#payslip').addClass('mm-active');
    $('a#payroll').addClass('mm-active');
</script>
@endsection

@extends('layouts.admin')
@section('title','SK - Attendance Log')
@section('content')
<div class="container">
    <!-- header -->
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('attendance')}}">Attendance Log</a></li>
                    </ol>
                </nav>
            </div>
            <h3>Attendance Log</h3>
        </div>
        <div class="col-12 col-md-8 text-right">
            <div class="input-group mb-3">
            <form action="{{ route('attendance.filter') }}" method="get" >
                <div class="form-row align-items-center">
                    <div class="col-5">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text bg-primary text-white">Start Date</div>
                        </div>
                        <input type="date" class="form-control" id="inlineFormInputGroup" name="start" required>
                    </div>
                    </div>
                    <div class="col-7">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text bg-primary text-white">End Date</div>
                        </div>
                        <input type="date" class="form-control" id="end" name="end" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-success" type="submit" name="submit"><i class="fa fa-send"> Submit</i></button>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>

    <div class="table-responsive-lg my-4">
        <table class="table">
        <caption>Attendance Log</caption>
            <thead class="table table-sm">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">date</th>
                    <th scope="col">Check In</th>
                    <th scope="col">Check Out</th>
                </tr>
            </thead>
            @forelse($attendance as $data)
            <tbody>
                <tr>
                    <th scope="row">{{$loop->iteration}}
                    <th >{{$data->name}}</th>
                    <th >{{$data->date}}</th>
                    <th >{{$data->check_in}}</th>
                    <th >{{$data->check_out}}</th>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Attendance Log is Empty</td>
                </tr>
            </tbody>
            @endforelse
        </table>
        <br/>
        {!! $attendance->links() !!}

    </div>
</div>
@endsection

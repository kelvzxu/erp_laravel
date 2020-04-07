@extends('layouts.admin')
@section('title','Leave Management')
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
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('leave')}}">Leave List</a></li>
                    </ol>
                </nav>
            </div>
            <h3>Leave List</h3>
        </div>
        <div class="col-12 col-md-5 text-right">
                <form action="{{ route('invoices.filter') }}" method="get" >
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <select class="input-group-text bg-primary text-white" name="filter">
                                    <option value="" selected>Filter By</option>
                                    <option value="invoice_no">Invoice No</option>
                                    <option value="name">Customer Name</option>
                                    <option value="due_date">Due Date</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" placeholder="Search...." name="value">
                        <div class="input-group-append">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
    <!-- header button -->
    <div class="table-responsive-lg my-4">
        <table class="table">
        <caption>Leave List</caption>
            <thead class="table table-sm">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Employee name</th>
                    <th scope="col">Leave type</th>
                    <th scope="col">Date from</th>
                    <th scope="col">Date to</th>
                    <th scope="col">No. of days</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Leave type offer</th>
                    <th></th>
                </tr>
            </thead>
            @forelse($leaves as $leave)
            <tbody>
                <tr>
                    <td>{{$loop -> index+1 }}</td>
                    <td>{{$leave->name }}</td>
                    <td>{{$leave->leave_type}}</td>
                    <td>{{$leave->date_from}}</td>
                    <td>{{$leave->date_to}}</td>
                    <td>{{$leave->days}}</td>
                    <td>{{$leave->reason}}</td>
                    <td class="text-center">
                        @if($leave->leave_type_offer==0)
                            <form id="{{$leave->id}}" action="{{route('leave.paid',$leave->id)}}" method="POST">
                                @csrf
                                <button type="submit" onclick="return confirm('Are you sure want to paid for leave?')" class="btn btn-sm btn-success font-weight-bold" name="paid" value="1"><i class="fa fa-money"> Paid</i></button>
                            </form>
                        @elseif($leave->leave_type_offer==1)

                            <form action="{{route('leave.paid',$leave->id)}}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-danger font-weight-bold" onclick="return confirm('Are you sure want to unpaid for leave?')" type="submit" name="paid" value="2">Unpaid</button>
                            </form>
                        @else
                            <form action="{{route('leave.paid',$leave->id)}}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-success font-weight-bold" onclick="return confirm('Are you sure want to piad for leave?')" type="submit" name="paid" value="1"><i class="fa fa-money"> Paid</i></button>
                            </form>
                        @endif
                    </td>
                    <td>
                        @if($leave->is_approved==0)
                            <form id="approve-leave-{{$leave->id}}" action="{{route('leave.approve',$leave->id)}}" method="POST">
                                @csrf
                                <button type="submit" onclick="return confirm('Are you sure want to approve leave?')" class="btn btn-sm btn-success" name="approve" value="1">Approve</button>
                            </form>
                        @elseif($leave->is_approved==1)

                            <form action="{{route('leave.approve',$leave->id)}}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to reject leave?')" type="submit" name="approve" value="0">Reject</button>
                            </form>
                        @else
                            <form action="{{route('leave.approve',$leave->id)}}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-success" onclick="return confirm('Are you sure want to approve leave?')" type="submit" name="approve" value="1">Approve</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">leave List is Empty</td>
                </tr>
            </tbody>
            @endforelse
        </table>
        <br/>
        {!! $leaves->links() !!}

    </div>
</div>
@endsection

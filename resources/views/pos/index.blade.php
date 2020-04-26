@extends('layouts.admin')
@section('title','SK - Product Managements')
@section('content')
<div class="container">
    <!-- header -->
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('pos')}}">Point Of Sale</a></li>
                    </ol>
                </nav>
            </div>
            <h3>POINT OF SALE Transaction History
            <div class="col-3">
                <a href="{{ route('pos.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-edit"></i> create
                </a>
            </div>
        </div>
    </div>

    
    <div class="table-responsive my-3">
        <table class="table table-hover">
            <thead class="table table-sm">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Struct No</th> 
                    <th scope="col">Customer</th>
                    <th scope="col">Grand Total</th>
                    <th scope="col">Pay</th>
                    <th scope="col">Change</th>
                    <th scope="col">Transaction Date</th>
                    <th scope="col" colspan="2">Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $row)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $row->invoice_no }}</td>
                    <td>{{ $row->customer->name }}</td>
                    <td>Rp {{ number_format($row->total) }}</td>
                    <td>Rp {{ number_format($row->pay) }}</td>
                    <td>Rp {{ number_format($row->change) }}</td>
                    <td>{{ $row->invoice_date }}</td>
                    <td>{{$row->created_at->diffForHumans()}}</td>
                    <td class="text-right">
                        <a href="{{route('pos.view', $row->id)}}" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Transaction completed is Empty</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
</div>
@endsection
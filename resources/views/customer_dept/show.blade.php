@extends('layouts.admin')
@section('title','SK - Partner List')
@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
        {{ session('success') }}
        </div>
    @endif
    <!-- header -->
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('CustomerDebt')}}">CustomerDept</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
            <h3>Customer Dept</h3>
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

    <div class="table-responsive-lg my-4">
        <table class="table">
        <caption>Customer Debt List</caption>
            <thead class="table table-sm">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Invoice No</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Invoice Date</th>
                    <th scope="col">Due Date</th>
                    <th scope="col">Total</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            @forelse($customerdebt as $cust)
            <tbody>
                <tr>
                    <th scope="row">{{$loop->iteration}}
                    <th >{{$cust->invoice_no}}</th>
                    <th >{{$cust->name}}</th>
                    <th >{{$cust->invoice_date}}</th>
                    <th >{{$cust->due_date}}</th>
                    <th >Rp. {{ number_format($cust->total)}}</th>
                    <th >
                        <a href="{{ route('CustomerDebt.edit', $cust->invoice_no) }}" class="btn btn-success btn-sm">
                        <i class="fa fa-edit"> View Detail</i></a>
                    </th>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">customer dept List is Empty</td>
                </tr>
            </tbody>
            @endforelse
        </table>
        <br/>
        {!! $customerdebt->links() !!}

    </div>
</div>
@endsection

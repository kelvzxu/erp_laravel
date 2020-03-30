@extends('layouts.admin')
@section('title','SK - Partner List')
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
        <caption>Customer Dept List</caption>
            <thead class="table table-sm">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">Credit</th>
                    <th scope="col">Debit</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            @forelse($customer as $cust)
            <tbody>
                <tr>
                    <th scope="row">{{$loop->iteration}}
                    <th >{{$cust->display_name}}</th>
                    <th >{{$cust->parent_id}}</th>
                    <th >Rp. {{ number_format($cust->credit_limit)}}</th>
                    <th >Rp. {{ number_format($cust->debit_limit)}}</th>
                    <th >
                        <a href="{{ route('CustomerDebt.show', $cust->id) }}" class="btn btn-success btn-sm">
                        <i class="fa fa-edit"> View Detail</i></a>
                    </th>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Customer List is Empty</td>
                </tr>
            </tbody>
            @endforelse
        </table>
        <br/>
        {!! $customer->links() !!}

    </div>
</div>
@endsection

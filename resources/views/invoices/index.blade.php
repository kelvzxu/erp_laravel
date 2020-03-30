@extends('layouts.admin')
@section('title','SK - Employee')
@section('content')
    <div class="panel panel-default">
        <div class="row">
            <div class="col-12 col-md-7">
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('invoices')}}">Invoices</a></li>
                        </ol>
                    </nav>
                </div>
                <h3>Invoices List</h3>
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
        <div class="row">
            <div class="col-3">
            <a href="{{route('invoices.create')}}" class="btn btn-success">Create</a>
            </div>
        </div>
        <div class="panel-body mt-3">
            @if($invoices->count())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Invoice No.</th>
                        <th>Grand Total</th>
                        <th>Client</th>
                        <th>Invoice Date</th>
                        <th>Due Date</th>
                        <th colspan="2">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td>{{$invoice->invoice_no}}</td>
                            <td>Rp. {{ number_format($invoice->grand_total)}}</td>
                            <td>{{$invoice->name}}</td>
                            <td>{{$invoice->invoice_date}}</td>
                            <td>{{$invoice->due_date}}</td>
                            <td>{{$invoice->created_at->diffForHumans()}}</td>
                            <td class="text-right">
                                <a href="{{route('invoices.show', $invoice)}}" class="btn btn-primary btn-sm">View</a>
                                <a href="{{route('invoices.edit', $invoice)}}" class="btn btn-warning btn-sm">Retur</a>
                                <!-- <form class="form-inline" method="post"
                                    action="{{route('invoices.destroy', $invoice)}}"
                                    onsubmit="return confirm('Are you sure?')"
                                >
                                    <input type="hidden" name="_method" value="delete">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                </form> -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $invoices->render() !!}
            @else
                <div class="invoice-empty">
                    <p class="invoice-empty-title">
                        No Invoices were created.
                        <a href="{{route('invoices.create')}}">Create Now!</a>
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection
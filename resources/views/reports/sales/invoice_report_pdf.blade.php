@extends('reports.layouts.report')
@section('title')
<title>Report Invoice ({{$monthName}}-{{$year}})</title>
@endsection
@section('css')
<style>
h3 {text-align: center;}
</style>
@endsection
@section('content')
    <h3><b><u>Report Invoice ({{$monthName}}-{{$year}})</u></b></h3>
    @if($invoices->count())
    <div class="table-responsive-lg mb-4">
        <table class="table">
            <thead class="table table-sm text-center">
                <tr>
                    <th class="align-middle" scope="col">Date</th>
                    <th class="align-middle" scope="col">Invoice No</th>
                    <th class="align-middle" scope="col">Customer</th>
                    <th class="align-middle" scope="col">Sales Person</th>
                    <th class="align-middle" scope="col">Discount</th>
                    <th class="align-middle" scope="col">Total</th> 
                    <th class="align-middle" scope="col">Due Amount</th>
                    <th class="align-middle" scope="col">Status</th>
                </tr>
            </thead> 
            <tbody> 
                @foreach($invoices as $invoice)
                    <tr>
                        <td>{{$invoice->invoice_date}}</td>
                        <td>{{$invoice->invoice_no}}</td>
                        <td>{{$invoice->name}}</td>
                        <td>{{$invoice->employee_name}}</td>
                        <td>Rp. {{ number_format($invoice->discount)}}</td>
                        <td>Rp. {{ number_format($invoice->grand_total)}}</td>
                        <td>Rp. {{ number_format($invoice->grand_total-$invoice->payment)}}</td>
                        <td>
                            @if(($invoice->grand_total-$invoice->payment)==0) 
                                <div class="mb-2 mr-2 badge badge-pill badge-success">PAID</div>
                                <!-- <a class="btn btn-warning btn-sm text-white">Pending...</a> -->
                            @endif
                            @if(($invoice->grand_total-$invoice->payment)!=0) 
                                <div class="mb-2 mr-2 badge badge-pill badge-danger">UNPAID</div>
                                <!-- <a class="btn btn-success btn-sm text-white">Complete</a> -->
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="o_nocontent_help">
        <p class="o_view_nocontent_smiling_face">
            <img src="{{ public_path('images/icons/smiling_face.svg')}}" alt=""><br>
            Create a customer invoice
        </p>
        <p>
            Create invoices, register payments and keep track of the discussions with your customers.
        </p>
    </div>
    @endif
@endsection
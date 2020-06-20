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
    @if($data->count())
    <div class="table-responsive-lg mb-4">
        <table class="table">
            <thead class="table table-sm text-center">
                <tr>
                    <th class="align-middle" scope="col">Reference</th>
                    <th class="align-middle" scope="col">Customer</th>
                    <th class="align-middle" scope="col">Order Date</th>
                    <th class="align-middle" scope="col">Sales Representative</th>
                    <th class="align-middle" scope="col">Total</th>
                    <th class="align-middle" scope="col">status</th>
                    <th class="align-middle" scope="col">Invoice</th>
                </tr>
            </thead> 
            <tbody> 
                @foreach($data as $row)
                    <tr>
                        <td>{{$row->order_no}}</td>
                        <td>{{$row->partner->name}}</td>
                        <td>{{$row->order_date}}</td>
                        <td>{{$row->sales_person->employee_name}}</td>
                        <td>Rp. {{ number_format($row->grand_total)}}</td>
                        <td>
                            @if($row->status == "Quotation" ) 
                                <div class="mb-2 mr-2 badge badge-pill badge-warning text-white">Quotation</div>
                                <!-- <a class="btn btn-warning btn-sm text-white">Pending...</a> -->
                            @endif
                            @if($row->status == "SO" ) 
                                <div class="mb-2 mr-2 badge badge-pill badge-success">Sales Order</div>
                                <!-- <a class="btn btn-success btn-sm text-white">Complete</a> -->
                            @endif
                        </td>
                        <td>
                            @if($row->invoice == False ) 
                                <div class="mb-2 mr-2 badge badge-pill badge-danger text-white">No_Invoice</div>
                                <!-- <a class="btn btn-warning btn-sm text-white">Pending...</a> -->
                            @endif
                            @if($row->invoice == True ) 
                                <div class="mb-2 mr-2 badge badge-pill badge-success">invoice</div>
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
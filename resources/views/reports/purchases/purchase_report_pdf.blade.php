@extends('reports.layouts.report')
@section('title')
<title>Report Purchases Orders ({{$monthName}}-{{$year}})</title>
@endsection
@section('css')
<style>
h3 {text-align: center;}
</style>
@endsection
@section('content')
    <h3><b><u>Report Purchases Orders ({{$monthName}}-{{$year}})</u></b></h3>
    @if($purchases->count())
        <div class="table-responsive-lg mb-4">
            <table class="table">
                <thead class="table table-sm text-center">
                    <tr>
                        <th class="align-middle" scope="col">Date</th>
                        <th class="align-middle" scope="col">Purchase No</th>
                        <th class="align-middle" scope="col">Vendors</th>
                        <th class="align-middle" scope="col">Merchandise</th>
                        <th class="align-middle" scope="col">Discount</th>
                        <th class="align-middle" scope="col">Total</th> 
                        <th class="align-middle" scope="col">Due Amount</th>
                        <th class="align-middle" scope="col">Status</th>
                    </tr>
                </thead> 
                <tbody> 
                    @foreach($purchases as $purchase)
                        <tr>
                            <td>{{$purchase->purchase_date}}</td>
                            <td>{{$purchase->purchase_no}}</td>
                            <td>{{$purchase->partner_name}}</td>
                            <td>{{$purchase->employee_name}}</td>
                            <td>- Rp. {{ number_format($purchase->discount)}}</td>
                            <td>- Rp. {{ number_format($purchase->grand_total)}}</td>
                            <td>- Rp. {{ number_format($purchase->grand_total-$purchase->payment)}}</td>
                            <td>
                                @if(($purchase->grand_total-$purchase->payment)==0) 
                                    <div class="mb-2 mr-2 badge badge-pill badge-success">PAID</div>
                                    <!-- <a class="btn btn-warning btn-sm text-white">Pending...</a> -->
                                @endif
                                @if(($purchase->grand_total-$purchase->payment)!=0) 
                                    <div class="mb-2 mr-2 badge badge-pill badge-danger">UNPAID</div>
                                    <!-- <a class="btn btn-success btn-sm text-white">Complete</a> -->
                                @endif
                            </td>
                            <td class="text-right">
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="o_nocontent_help">
            <p class="o_view_nocontent_smiling_face">
                <img src="{{ public_path('images/icons/smiling_face.svg')}}" alt=""><br>
                Create a Vendors Bill
            </p>
            <p>
                Create purchases, register payments and keep track of the discussions with your Vendors.
            </p>
        </div>
        @endif
@endsection
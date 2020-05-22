@extends('reports.layouts.report')
@section('title')
<title>Partner Ledger Payable Account</title>
@endsection
@section('css')
<style>
h3 {text-align: center;}
</style>
@endsection
@section('content')
    <h3><b><u>Partner Ledger Payable Account</u></b></h3>

    <table class="table mt-3">
        <thead class="table table-sm">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Invoice No</th>
                <th scope="col">Journal</th>
                <th scope="col">account</th>
                <th scope="col">Customer</th>
                <th scope="col">Debit</th>
                <th scope="col">Credit</th>
            </tr>
        </thead>
        @forelse($Payable as $data)
        <tbody>
                <tr>
                    <td scope="row">{{$loop->iteration}}</td>
                    <td>{{$data->purchase_no}}</td>
                    <td>{{$data->code}}</td>
                    <td>{{$data->default_credit_account_id}}</td>
                    <td>{{$data->partner_name}}</td>
                    <td>Rp. {{ number_format($data->payment)}}</td>
                    <td>Rp. {{ number_format($data->total)}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Payable Account is Empty</td>
                </tr>
        </tbody>
        @endforelse
    </table>
@endsection

@extends('reports.layouts.report')
@section('title')
<title>Partner Ledger Receivable Account</title>
@endsection
@section('css')
<style>
h3 {text-align: center;}
</style>
@endsection
@section('content')
    <h3><b><u>Partner Ledger Receivable Account</u></b></h3>

    <table class="table table-striped mt-3">
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
        @forelse($Receivable as $data)
        <tbody>
                <tr>
                    <td scope="row">{{$loop->iteration}}</td>
                    <td>{{$data->invoice_no}}</td>
                    <td>{{$data->code}}</td>
                    <td>{{$data->default_credit_account_id}}</td>
                    <td>{{$data->name}}</td>
                    <td>Rp. {{ number_format($data->total)}}</td>
                    <td>Rp. {{ number_format($data->payment)}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Receivable Account is Empty</td>
                </tr>
        </tbody>
        @endforelse
    </table>
@endsection

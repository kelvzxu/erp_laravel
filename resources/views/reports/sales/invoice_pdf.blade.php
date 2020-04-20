@extends('reports.layouts.report')
@section('title')
<title>Invoice {{$invoice->invoice_no}}</title>
@endsection
@section('content')
    <div class="customer">
        <ul style="list-style-type:none;" class="pull-right">
            <li><span class="text">{{$invoice->customer->parent_id}} , {{$invoice->customer->name}}</span></li>
            <li><span class="text">{{$invoice->customer->address}}</span></li>
            <li><span class="text">{{$invoice->customer->city}}, {{$invoice->customer->street}} </span></li>
            <li><span class="text">{{$invoice->customer->phone}}</span></li>
            <li><span class="text">{{$invoice->customer->email}}</span></li>
        </ul>
    </div>
    <table>
    <tr>
        <td colspan="2" style="font-size:30px;">
            <b>Invoice No {{$invoice->invoice_no}}</b>
        </td>
    </tr>
    <tr>
        <td class="mt-3">
            <b>Invoice Date :</b>
        </td>
        <td class="mt-3">
            <b>Due Date :</b>
        </td>
    </tr>
    <tr>
        <td>
            {{$invoice->invoice_date}}
        </td>
        <td>
            {{$invoice->due_date}}
        </td>
    </tr>
    </table>
    <table class="table mt-3">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Product Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->products as $product)
                <tr>
                    <td scope="row">{{$loop->iteration}}
                    <td id="product" class="table-name">{{$product->name}}</td>
                    <td class="table-price">Rp. {{number_format($product->price)}}</td>
                    <td class="table-qty">{{$product->qty}}</td>
                    <td class="table-total">Rp. {{number_format($product->qty * $product->price)}}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="table-empty" colspan="3"></td>
                <td class="table-label">Sub Total</td>
                <td class="table-amount">Rp. {{number_format($invoice->sub_total)}}</td>
            </tr>
            <tr>
                <td class="table-empty" colspan="3" style="border:0;"></td>
                <td class="table-label">Discount</td>
                <td class="table-amount">Rp. {{number_format($invoice->discount)}}</td>
            </tr>
            <tr>
                <td class="table-empty" colspan="3" style="border:0;"></td>
                <td class="table-label">Grand Total</td>
                <td class="table-amount">Rp. {{number_format($invoice->grand_total)}}</td>
            </tr>
        </tfoot>
    </table>
    <footer>
        <div>
        Memo: {{$invoice->title}}
@endsection
@section('type','Invoice')
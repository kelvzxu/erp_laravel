@extends('reports.layouts.report')
@section('title')
<title>Report Listing Product</title>
@endsection
@section('css')
<style>
h3 {text-align: center;}
</style>
@endsection
@section('content')
    <h3><b><u>Product List </u></b></h3>
    @if($products->count())
    <div class="table-responsive-lg mb-4">
        <table class="table">
            <thead class="table table-sm text-center">
                <tr>
                    <th class="align-middle" scope="col">Barcode</th>
                    <th class="align-middle" scope="col">References</th>
                    <th class="align-middle" scope="col">Product Name</th>
                    <th class="align-middle" scope="col">Public Price</th>
                    <th class="align-middle" scope="col">Cost</th>
                </tr>
            </thead> 
            <tbody> 
                @foreach ($products as $row)
                    <tr>
                        <td>{{$row->barcode}}</td>
                        <td>{{$row->code}}</td>
                        <td>{{$row->name}}</td>
                        <td>Rp. {{ number_format($row->price)}}</td>
                        <td>Rp. {{ number_format($row->cost)}}</td>
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
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
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('purchases')}}">Purchases</a></li>
                        </ol>
                    </nav>
                </div>
                <h3>Purchases List</h3>
            </div>
            <div class="col-12 col-md-5 text-right">
                <form action="{{ route('purchases.filter') }}" method="get" >
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <select class="input-group-text bg-primary text-white" name="filter">
                                    <option value="" selected>Filter By</option>
                                    <option value="purchase_no">Purchase No</option>
                                    <option value="partner_name">Vendor Name</option>
                                    <option value="due_date">Due Date</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" placeholder="Search...." name="value">
                        <div class="input-group-append">
                            <button class="btn btn-outline-success" type="submit"><i class="fa fa-search" aria-hidden="true"> Search</i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
            <a href="{{route('purchases.create')}}" class="btn btn-success">Create</a>
            </div>
        </div>
        <div class="panel-body mt-3">
            @if($purchases->count())
            <div class="table-responsive-lg my-4">
                <table class="table table-striped">
                    <thead class="table table-sm">
                        <tr>
                            <th scope="col">Purchase No.</th>
                            <th scope="col">Grand Total</th>
                            <th scope="col">Client</th>
                            <th scope="col">Purchase Date</th>
                            <th scope="col">Due Date</th>
                            <th scope="col" colspan="2">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchases as $purchase)
                            <tr>
                                <td>{{$purchase->purchase_no}}</td>
                                <td>Rp. {{ number_format($purchase->grand_total)}}</td>
                                <td>{{$purchase->partner_name}}</td>
                                <td>{{$purchase->purchase_date}}</td>
                                <td>{{$purchase->due_date}}</td>
                                <td>{{$purchase->created_at->diffForHumans()}}</td>
                                <td class="text-right">
                                    <a href="{{route('purchases.show', $purchase)}}" class="btn btn-primary btn-sm">View</a>
                                    <a href="{{route('purchases.edit', $purchase)}}" class="btn btn-warning btn-sm">Retur</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {!! $purchases->render() !!}
            @else
                <div class="puchase-empty">
                    <p class="puchase-empty-title">
                        No Purchases were created.
                        <a href="{{route('purchases.create')}}">Create Now!</a>
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('js')
<script>
$('a#purchases').addClass('mm-active');
</script>
@endsection
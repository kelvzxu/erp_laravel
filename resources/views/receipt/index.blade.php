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
                <h3>Receipt Product</h3>
            </div>
            <div class="col-12 col-md-5 text-right">
                <form action="{{ route('purchases.filter') }}" method="get" >
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <select class="input-group-text bg-primary text-white" name="filter">
                                    <option value="" selected>Filter By</option>
                                    <option value="purchase_no">Purchase No</option>
                                    <option value="receipt_no">Receipt No</option>
                                    <option value="receipt_date">Receipt Date</option>
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
        <div class="panel-body mt-3">
            <div class="table-responsive-lg my-4">
                <table class="table table-striped">
                    <thead class="table table-sm">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Receipt No</th>
                            <th scope="col">Purchase No</th>
                            <th scope="col">Receipt Date</th>
                            <th scope="col" colspan="2">Created At</th>
                        </tr>
                    </thead>
                    @forelse($receipt as $data)
                    <tbody>
                            <tr>
                                <td scope="row">{{$loop->iteration}}</td>
                                <td>{{$data->receipt_no}}</td>
                                <td>{{$data->purchase_no}}</td>
                                <td>{{$data->receipt_date}}</td>
                                <td>{{$data->created_at->diffForHumans()}}</td>
                                <td class="text-right">
                                    <a href="{{route('receipt.show',$data->purchase_no)}}" class="btn btn-primary btn-sm">View</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Receipt List is Empty</td>
                            </tr>
                    </tbody>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
$('a#receipt').addClass('mm-active');
</script>
@endsection
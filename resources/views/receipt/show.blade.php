@extends('layouts.admin')
@section('title','SK - Employee')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="clearfix">
                <span class="panel-title"><h3>Receipt Product / {{$receipt->receipt_no}}</h3></span>
                <div class="pull-right">
                    <a href="{{route('receipt.index')}}" class="btn btn-danger">Back</a>              
                    @if($receipt->validate == False ) 
                        <a href="{{route('receipt.validate', $receipt)}}" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"> validate</i></a>
                    @endif
                </div> 
            </div>
        </div>
        <hr style="border: 1px solid;">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Receipt No.</label>
                        <p>{{$receipt->receipt_no}}</p>
                    </div>
                    <div class="form-group">
                        <label>Purchase No.</label>
                        <p>{{$receipt->po->purchase_no}}</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Supplier</label>
                        <p id="client">{{$receipt->po->client}}</p>
                    </div>
                    <div class="form-group">
                        <label>Supplier Address</label>
                        <pre class="pre">{{$receipt->po->client_address}}</pre>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Title</label>
                        <p>{{$receipt->po->title}}</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>purchase Date</label>
                            <p>{{$receipt->po->purchase_date}}</p>
                        </div>
                        <div class="col-sm-6">
                            <label>Due Date</label>
                            <p>{{$receipt->po->due_date}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($receipt->po->products as $data)
                        <tr>
                            <td id="product" class="table-name">{{$data->product->name}}</td>
                            <td class="table-price">Rp. {{ number_format($data->price)}}</td>
                            <td class="table-qty">{{$data->qty}}</td>
                            <td class="table-total text-right">Rp. {{ number_format($data->qty * $data->price)}}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="table-empty" colspan="2"></td>
                        <td class="table-label">Sub Total</td>
                        <td class="table-amount">Rp. {{ number_format($receipt->po->sub_total)}}</td>
                    </tr>
                    <tr>
                        <td class="table-empty" colspan="2"></td>
                        <td class="table-label">Discount</td>
                        <td class="table-amount">Rp. {{ number_format($receipt->po->discount)}}</td>
                    </tr>
                    <tr>
                        <td class="table-empty" colspan="2"></td>
                        <td class="table-label">Grand Total</td>
                        <td class="table-amount">Rp. {{ number_format($receipt->po->grand_total)}}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
@section('js')
<script>
$('a#purchases').addClass('mm-active');
$.ajax  ({
    url: "{{asset('api/partner/search')}}",
    type: 'post',
    dataType: 'json',
    data :{
        'id': "{{$receipt->po->client}}"
    },
    success: function (result) {
        $("#client").html(result.data.partner_name);
    }
})
</script>
@endsection
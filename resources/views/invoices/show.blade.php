@extends('layouts.admin')
@section('title','SK - Employee')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="clearfix">
                <span class="panel-title"><h3>Invoice</h3></span>
                <div class="pull-right">
                    <a href="{{route('invoices')}}" class="btn btn-danger">Back</a>
                    <a href="{{route('invoices')}}" class="btn btn-primary">Post</a>
                    <a href="{{route('invoices.print', $invoice)}}" class="btn btn-success"><i class="fa fa-print"></i> Print</a>
                    <a href="{{route('invoices.edit', $invoice)}}" class="btn btn-warning">Return</a>
                    <!-- <form class="form-inline" method="post"
                        action="{{route('invoices.destroy', $invoice)}}"
                        onsubmit="return confirm('Are you sure?')"
                    >
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form> -->
                </div>
            </div>
        </div>
        <hr style="border: 1px solid;">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Invoice No.</label>
                        <p>{{$invoice->invoice_no}}</p>
                    </div>
                    <div class="form-group">
                        <label>Grand Total</label>
                        <p>Rp. {{ number_format($invoice->grand_total)}}</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Client</label>
                        <p id="client">{{$invoice->client}}</p>
                    </div>
                    <div class="form-group">
                        <label>Client Address</label>
                        <pre class="pre">{{$invoice->client_address}}</pre>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Title</label>
                        <p>{{$invoice->title}}</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Invoice Date</label>
                            <p>{{$invoice->invoice_date}}</p>
                        </div>
                        <div class="col-sm-6">
                            <label>Due Date</label>
                            <p>{{$invoice->due_date}}</p>
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
                    @foreach($invoice->products as $product)
                        <tr>
                            <td id="product" class="table-name">{{$product->name}}</td>
                            <td class="table-price">Rp. {{number_format($product->price)}}</td>
                            <td class="table-qty">{{$product->qty}}</td>
                            <td class="table-total">Rp. {{number_format($product->qty * $product->price)}}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="table-empty" colspan="2"></td>
                        <td class="table-label">Sub Total</td>
                        <td class="table-amount">Rp. {{number_format($invoice->sub_total)}}</td>
                    </tr>
                    <tr>
                        <td class="table-empty" colspan="2"></td>
                        <td class="table-label">Discount</td>
                        <td class="table-amount">Rp. {{number_format($invoice->discount)}}</td>
                    </tr>
                    <tr>
                        <td class="table-empty" colspan="2"></td>
                        <td class="table-label">Grand Total</td>
                        <td class="table-amount">Rp. {{number_format($invoice->grand_total)}}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
@section('js')
<script>
function pdf() {
    window.print();
}
$('a#invoices').addClass('mm-active');
$.ajax  ({
    url: "{{asset('api/customer/search')}}",
    type: 'post',
    dataType: 'json',
    data :{
        'id': "{{$invoice->client}}"
    },
    success: function (result) {
        $("#client").html(result.data.name);
    }
})
// $.ajax  ({
//     url: "{{asset('api/product/search')}}",
//     type: 'post',
//     dataType: 'json',
//     data :{
//         'id': "{{$product->name}}"
//     },
//     success: function (result) {
//         console.log(result.data.price);
//         $("#product").html(result.data.name);
//     }
// })
</script>
@endsection
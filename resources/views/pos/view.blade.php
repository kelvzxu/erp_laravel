@extends('layouts.admin')
@section('title','SK - Product Managements')
@section('content')
<div class="container">
    <!-- header -->
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('pos')}}">Point Of Sale</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('pos.view', $order->id)}}">{{$order->invoice_no}}</a></li>
                    </ol>
                </nav>
            </div>
            <h3>Point Of Sale / {{$order->invoice_no}}</h3>
        </div>
    </div>
    <div class="row my-4 justify-content-md-center">
        <div class="col-md-auto text-center">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-danger" onclick="pdf()"><i class="fa fa-print"></i> Print</button>
                </div>
                <div class="card-body" id="printTable">
                    <div class="text-center table-responsive">
                        <table class="text-center">
                            <tbody>
                                <tr>
                                <th scope="col" style="border:none;" colspan="3">Company Name</th>
                                </tr>
                                <tr>
                                <th scope="col" style="border:none;" colspan="3">Struck No : {{$order->invoice_no}}</th>
                                </tr>
                                <tr>
                                <th scope="col" style="border:none;" colspan="3">Customer : {{$order->customer->name}}</th>
                                </tr>
                                <tr>
                                <th scope="col" style="border:none;" colspan="3">Sales : {{$order->sales->name}}</th>
                                </tr>
                                <tr>
                                <th scope="col" style="border:none;" colspan="3">=====================================</th>
                                </tr>
                                @foreach($order->order_detail as $data)
                                    <tr>
                                    <td>{{$data->name}}</td>
                                    <td>Rp. {{ number_format($data->price)}}</td>
                                    <td>{{$data->qty}}</td>
                                    </tr>
                                    <tr>
                                    <td class="table-empty" colspan="2"></td>
                                    <td>Rp. {{ number_format($data->qty * $data->price)}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                <th scope="col" style="border:none;" colspan="3">=====================================</th>
                                </tr>
                                <tr>
                                    <td class="table-empty"></td>
                                    <td>Grand Total </td>
                                    <td>: Rp. {{ number_format($order->total)}}</td>
                                </tr>
                                <tr>
                                    <td class="table-empty"></td>
                                    <td>Pay </td>
                                    <td>: Rp. {{ number_format($order->pay)}}</td>
                                </tr>
                                <tr>
                                    <td class="table-empty"></td>
                                    <td>Change </td>
                                    <td>: Rp. {{ number_format($order->Change)}}</td>
                                </tr>
                                <tr>
                                <th scope="col" style="border:none;" colspan="3" class="mt-5">>>> Thank You <<<</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}
    function pdf() {
        printData();
    }
</script>
@endsection

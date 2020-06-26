@extends('layouts.admin')
@section('title','Point Of Sale')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="app-page-title bg-white">
    <div class="o_control_panel">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('pos')}}">Point Of Sale</a></li>
                <li class="breadcrumb-item active">{{$order->invoice_no}}</li>
            </ol>
        </div>
        <div>
            <div class="o_cp_left">
                <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                    <div>
                    <button class="btn btn-primary" onclick="pdf()"><i class="fa fa-print"></i> Print</button>
                        <a href="{{route('pos')}}" class="btn btn-secondary mby-2">Discard</a>
                    </div>
                </div>
                <aside class="o_cp_sidebar">
                    <div class="btn-group">
                        <div class="btn-group o_dropdown">
                            <button class="o_dropdown_toggler_btn btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                Print
                            </button>
                            
                            <div class="dropdown-menu o_dropdown_menu" role="menu">
                                <button class="dropdown-item undefined" onclick="pdf()"><i class="fa fa-print"> Print</i></button>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="o_cp_right">
                <div class="btn-group o_search_options position-static" role="search"></div>
                <nav class="o_cp_pager" role="search" aria-label="Pager">
                    <div class="o_pager">
                        <span class="o_pager_counter">
                            <span class="o_pager_value">1</span> / <span class="o_pager_limit">1</span>
                        </span>
                        <span class="btn-group" aria-atomic="true">
                            <button type="button" class="fa fa-chevron-left btn btn-secondary o_pager_previous"
                                accesskey="p" aria-label="Previous" title="Previous" tabindex="-1" disabled=""></button>
                            <button type="button" class="fa fa-chevron-right btn btn-secondary o_pager_next"
                                accesskey="n" aria-label="Next" title="Next" tabindex="-1" disabled=""></button>
                        </span>
                    </div>
                </nav>
                <nav class="btn-group o_cp_switch_buttons" role="toolbar" aria-label="View switcher"></nav>
            </div>
        </div>
    </div>
</div>
<div class="row my-4 justify-content-md-center">
    <div class="col-md-auto text-center">
        <div class="card">
            <div class="card-header">
                <h3>{{$order->invoice_no}}</h3>
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
                                <td colspan="3">{{$data->name}}</td>
                                </tr>
                                <tr>
                                <td>Rp. {{ number_format($data->price)}}</td>
                                <td>{{$data->qty}}</td>
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

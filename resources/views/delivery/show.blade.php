@extends('layouts.admin')
@section('title','SK - Employee')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="app-page-title bg-white">
    <div class="o_control_panel">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('Delivere.index')}}">Receive Products</a></li>
                <li class="breadcrumb-item active">{{$delivery->delivery_no}}</li>
            </ol>
        </div>
        <div>
            <div class="o_cp_left">
                <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                    <div>
                        @if($delivery->validate == False ) 
                            <a href="{{route('Delivere.validate', $delivery)}}" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"> validate</i></a>
                        @endif
                        <a href="{{route('Delivere.index')}}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
            <div class="o_cp_right">
                <div class="btn-group o_search_options invsition-static" role="search"></div>
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
    <div class="o_form_view o_sale_order o_form_editable">

        <div class="o_form_statusbar">
            <div class="o_statusbar_buttons">
            </div>
            <div class="o_field_many2many o_field_widget o_invisible_modifier o_readonly_modifier"
                name="authorized_transaction_ids" id="o_field_input_290" data-original-title="" title=""></div>
            <div class="o_statusbar_status o_field_widget o_readonly_modifier" name="state" data-original-title="" title="">
                <button type="button" data-value="sent" disabled="disabled" title="Not active state" aria-pressed="false"
                    class="btn o_arrow_button btn-secondary disabled d-none d-md-block">
                    validate
                </button>
                <button type="button" data-value="draft" disabled="disabled" title="Current state" aria-pressed="true"
                    class="btn o_arrow_button btn-primary disabled d-none d-md-block" aria-current="step">
                    Draft
                </button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 mt-4">
        <div class="card container">
            <div class="row mt-4 mx-2">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Receipt No.</label>
                        <p>{{$delivery->delivery_no}}</p>
                    </div>
                    <div class="form-group">
                        <label>Invoice No.</label>
                        <p>{{$delivery->inv->invoice_no}}</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Supplier</label>
                        <p id="client">{{$delivery->inv->client}}</p>
                    </div>
                    <div class="form-group">
                        <label>Supplier Address</label>
                        <pre class="pre">{{$delivery->inv->client_address}}</pre>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Title</label>
                        <p>{{$delivery->inv->title}}</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Invoice Date</label>
                            <p>{{$delivery->inv->invoice_date}}</p>
                        </div>
                        <div class="col-sm-6">
                            <label>Due Date</label>
                            <p>{{$delivery->inv->due_date}}</p>
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
                    @foreach($delivery->inv->products as $data)
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
                        <td class="table-empty" colspan="2" style="border:none;"></td>
                        <td class="table-label">Sub Total</td>
                        <td class="table-amount">Rp. {{ number_format($delivery->inv->sub_total)}}</td>
                    </tr>
                    <tr>
                        <td class="table-empty" colspan="2" style="border:none;"></td>
                        <td class="table-label">Discount</td>
                        <td class="table-amount">Rp. {{ number_format($delivery->inv->discount)}}</td>
                    </tr>
                    <tr>
                        <td class="table-empty" colspan="2" style="border:none;"></td>
                        <td class="table-label">Grand Total</td>
                        <td class="table-amount">Rp. {{ number_format($delivery->inv->grand_total)}}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<br>
@endsection
@section('js')
<script>
$('a#receipt').addClass('mm-active');
$.ajax  ({
    url: "{{asset('api/partner/search')}}",
    type: 'invst',
    dataType: 'json',
    data :{
        'id': "{{$delivery->inv->client}}"
    },
    success: function (result) {
        $("#client").html(result.data.partner_name);
    }
})
</script>
@endsection
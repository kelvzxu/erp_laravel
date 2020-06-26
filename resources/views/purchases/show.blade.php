@extends('layouts.admin')
@section('title','Purchase - Quotation')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
<style>
    .disabled {
        pointer-events: none;
        cursor: default;
    }
</style>
@endsection
@section('content')
<div class="app-page-title bg-white">
    <div class="o_control_panel">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b">
                    <a href="{{route('purchase_orders')}}">
                        @if($orders->status == "Quotation" )
                            Request for Quotation
                        @endif
                        @if($orders->status == "PO" ) 
                            Purchase Order
                        @endif
                    </a>
                </li>
                <li class="breadcrumb-item active">{{$orders->order_no}}</li>
            </ol>
        </div>
        <div>
            <div class="o_cp_left">
                <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                    <div>
                        @if($orders->invoice== True )
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Edit</button>
                        @endif
                        @if($orders->invoice== False )
                            <a type="button" href="{{route('purchase_orders.edit', $orders)}}" class="btn btn-primary">Edit</a>
                        @endif
                        <a type="button" class="btn btn-secondary" accesskey="c" href="{{route('purchase_orders.create')}}">
                            Create
                        </a>
                    </div>
                </div>
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
    <div class="o_form_view o_sale_order o_form_editable">

        <div class="o_form_statusbar">
            <div class="o_statusbar_buttons">
                @if($orders->status == "PO" ) 
                    @if($orders->invoice == False )                
                        <a href="{{route('purchases.wizard_create', $orders)}}" class="btn btn-primary"><i class="fa fa-pencil-square-o"> Create Bills</i></a>
                    @endif
                @endif
                @if($orders->status == "Quotation" )
                <a href="{{route('purchase_orders.confirm', $orders)}}" class="btn btn-primary"><i class="fa fa fa-check"> Confirm Order</i></a>
                @endif
                <a href="" class="btn btn-secondary"><i class="fa fa-print"></i> Print</a>
                <a href="{{route('purchase_orders')}}" class="btn btn-secondary">Back</a>
            </div>
            <div class="o_statusbar_status o_field_widget o_readonly_modifier" name="state" data-original-title="" title="">
                @if($orders->status == "Quotation" ) 
                    <button type="button" data-value="Purchase Order" disabled="disabled" title="Not active state" aria-pressed="false"
                        class="btn o_arrow_button btn-secondary disabled d-none d-md-block">
                        Purchase Order
                    </button>
                    <button type="button" data-value="Request for Quotation" disabled="disabled" title="Current state" aria-pressed="true"
                        class="btn o_arrow_button btn-primary disabled d-none d-md-block" aria-current="step">
                        Request for Quotation
                    </button>
                @endif
                @if($orders->status == "PO" ) 
                    <button type="button" data-value="Purchase Order" disabled="disabled" title="Current state" aria-pressed="true"
                        class="btn o_arrow_button btn-primary disabled d-none d-md-block" aria-current="step">
                        Purchase Order
                    </button>
                    <button type="button" data-value="Request for Quotation" disabled="disabled" title="Current state" aria-pressed="true"
                        class="btn o_arrow_button btn-secondary disabled d-none d-md-block">
                        Request for Quotation
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="o_content my-4" v-cloak>
        <div class="o_form_view o_form_editable">
            <div class="o_form_sheet_bg">
                <div class="clearfix position-relative o_form_sheet">
                    <div class="oe_title">
                        <span class="o_form_label">
                            @if($orders->status == "Quotation" )
                                Request for Quotation
                            @endif
                            @if($orders->status == "PO" ) 
                                Purchase Order
                            @endif
                        </span>
                        <h1><span class="o_field_char o_field_widget o_readonly_modifier o_required_modifier" name="name">{{$orders->order_no}}</span></h1>
                    </div>
                    <div class="o_group">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <table class="o_group o_inner_group">
                                    <tbody>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label o_required_modifier">Vendor</label>
                                            </td>
                                            <td>
                                                <div class="wrap-input200">
                                                    <p class="input200">{{$orders->partner->partner_name}}</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label">Vendor Reference</label>
                                            </td>
                                            <td>
                                                <div class="wrap-input200">
                                                    <p class="input200">{{$orders->vendor_reference}}</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-md-6">
                                <table class="o_group o_inner_group">
                                    <tbody>
                                        <tr>
                                            <td class="o_td_label"><label class="o_form_label o_required_modifier" for="o_field_input_19"
                                                    data-original-title="" title="">Order Date</label></td>
                                            <td>
                                                <div class="wrap-input200">
                                                    <p class="input200">{{$orders->order_date}}</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label"><label class="o_form_label o_invisible_modifier o_readonly_modifier"
                                                    for="o_field_input_20">Confirmation Date</label></td>
                                            <td style="width: 100%;"><span
                                                    class="o_field_date o_field_widget o_invisible_modifier o_readonly_modifier"
                                                    name="date_approve"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label"><label class="o_form_label o_invisible_modifier" for="o_field_input_21"
                                                    data-original-title="" title="">Source Document</label></td>
                                            <td style="width: 100%;"><input class="o_field_char o_field_widget o_input o_invisible_modifier"
                                                    name="origin" placeholder="" type="text" id="o_field_input_21"></td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label"><label class="o_form_label o_invisible_modifier o_required_modifier"
                                                    for="o_field_input_22">Company</label></td>
                                            <td style="width: 100%;">
                                                <div class="o_field_widget o_field_many2one o_with_button o_invisible_modifier o_required_modifier"
                                                    aria-atomic="true" name="company_id">
                                                    <div class="o_input_dropdown">
                                                        <input type="text" class="o_input ui-autocomplete-input" autocomplete="off"
                                                            id="o_field_input_22">
                                                        <a role="button" class="o_dropdown_button" draggable="false"></a>
                                                    </div>
                                                    <button type="button" class="fa fa-external-link btn btn-secondary o_external_button"
                                                        tabindex="-1" draggable="false" aria-label="External link" title="External link"></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="o_list_view o_list_optional_columns">
                        <div class="table-responsive">
                            <table class="table table-bordered table-form">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders->products as $data)
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
                                        <td class="table-empty" colspan="2">
                                            <span @click="addLine" class="table-add_line">Add a Product</span>
                                        </td>
                                        <td class="table-label">Sub Total</td>
                                        <td class="table-amount">Rp. {{ number_format($orders->sub_total)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-empty" colspan="2" style="border:none;"></td>
                                        <td class="table-label">Discount</td>
                                        <td class="table-amount">Rp. {{ number_format($orders->discount)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-empty" colspan="2" style="border:none;"></td>
                                        <td class="table-label">Grand Total</td>
                                        <td class="table-amount">Rp. {{ number_format($orders->grand_total)}}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<br>
@endsection
@section('modal')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Something Wrong</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{asset('images/icons/warning.png')}}" alt=""><br>
                <p class="mb-0">You Can't Edit this Record </p>
                <p class="mb-0">because this record already has an invoice</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('js/asset_common/purchase_order.js')}}"></script>
@endsection
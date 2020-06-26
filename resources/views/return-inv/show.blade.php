@extends('layouts.admin')
@section('title','Return Invoice')
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
                    <a href="{{route('return-invoice.index')}}">
                        Report Return Invoice
                    </a>
                </li>
                <li class="breadcrumb-item active">{{$data->return_no}}</li>
            </ol>
        </div>
        <div>
            <div class="o_cp_left">
                <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                    <div>
                        <a type="button" href="{{route('return-invoice.edit', $data)}}" class="btn btn-primary">Edit</a>
                        <a type="button" class="btn btn-secondary" accesskey="c" href="{{route('return-invoice.index')}}">
                            Discard
                        </a>
                    </div>
                </div>
                <aside class="o_cp_sidebar">
                    <div class="btn-group">
                        <div class="btn-group o_dropdown">
                            <button class="o_dropdown_toggler_btn btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> 
                                Action
                            </button>
                            
                            <div class="dropdown-menu o_dropdown_menu" role="menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                                <button type="button" class="dropdown-item undefined" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-trash"> Delete Record</i>
                                </button>
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
    <div class="o_form_view o_sale_order o_form_editable">

        <div class="o_form_statusbar">
            <div class="o_statusbar_buttons">
                <a href="" class="btn btn-secondary"><i class="fa fa-print"></i> Print</a>
                <a href="{{route('return-invoice.index')}}" class="btn btn-secondary">Back</a>
            </div>
            <div class="o_statusbar_status o_field_widget o_readonly_modifier" name="state" data-original-title="" title="">
                <button type="button" data-value="Request for Quotation" disabled="disabled" title="Current state" aria-pressed="true"
                    class="btn o_arrow_button btn-primary disabled d-none d-md-block" aria-current="step">
                    Return Invoice
                </button>
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
                            Return Invoice
                        </span>
                        <h1><span class="o_field_char o_field_widget o_readonly_modifier o_required_modifier" name="name">{{$data->return_no}}</span></h1>
                    </div>
                    <div class="o_group">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <table class="o_group o_inner_group">
                                    <tbody>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label o_required_modifier">Invoice No</label>
                                            </td>
                                            <td>
                                                <div class="wrap-input200">
                                                    <p class="input200">{{$data->invoice_no}}</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label">customer</label>
                                            </td>
                                            <td>
                                                <div class="wrap-input200">
                                                    <p class="input200">{{$data->customer->name}}</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label">Delivery No</label>
                                            </td>
                                            <td>
                                                <div class="wrap-input200">
                                                    <p class="input200">{{$data->delivery_no}}</p>
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
                                                    data-original-title="" title="">Return Date</label></td>
                                            <td>
                                                <div class="wrap-input200">
                                                    <p class="input200">{{$data->created_at}}</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label"><label class="o_form_label o_required_modifier" for="o_field_input_19"
                                                    data-original-title="" title="">Representative</label></td>
                                            <td>
                                                <div class="wrap-input200">
                                                    <p class="input200">{{$data->user->employee_name}}</p>
                                                </div>
                                            </td>
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
                                        <th>Retun Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->products as $data)
                                        <tr>
                                            <td id="product" class="table-name">{{$data->product->name}}</td>
                                            <td class="table-price">Rp. {{ number_format($data->price)}}</td>
                                            <td class="table-qty">{{$data->qty}}</td>
                                            <td class="table-retur">{{$data->return_qty}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
                <h5 class="modal-title" id="exampleModalLabel">Something Went Wrong</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{asset('images/icons/warning.png')}}" alt=""><br>
                <p class="mb-0">The operation cannot be completed: another model requires the record being deleted. If possible, archive it instead. </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('js/asset_common/return_inv.js')}}"></script>
@endsection
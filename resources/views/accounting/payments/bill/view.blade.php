@extends('layouts.admin')
@section('title',"Payment | $data->name")
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<form>
    <div class="app-page-title bg-white">
        <div class="o_control_panel">
            <div>
                <ol class="breadcrumb" role="navigation">
                    <li class="breadcrumb-item" accesskey="b"><a href="{{route('payment_bills.index')}}">Payments</a></li>
                    <li class="breadcrumb-item active">{{$data->name}}</li>
                </ol>
            </div>
            <div>
                <div class="o_cp_left">
                    <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                        <div>
                            @if($data->state == "posted")
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deliverwarning">Edit</button>                        
                            @else
                                <a type="button" href="{{route('payment.edit', $data)}}" class="btn btn-primary o-kanban-button-new">Edit</a>
                            @endif
                            <a type="button" class="btn btn-secondary o-kanban-button-new" accesskey="c" href="{{route('payment_bills.create')}}">
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
                    @if($data->state == "draft" ) 
                        <a href="{{route('payment.posted', $data)}}" class="btn btn-primary"><i class="fa fa-check">Approved</i></a>
                    @endif
                </div>
                <div class="o_field_many2many o_field_widget o_invisible_modifier o_readonly_modifier"
                    name="authorized_transaction_ids" id="o_field_input_290" data-original-title="" title=""></div>
                <div class="o_statusbar_status o_field_widget o_readonly_modifier" name="state" data-original-title="" title="">
                    @if($data->state == "draft" ) 
                        <button type="button" data-value="sent" disabled="disabled" title="Not active state" aria-pressed="false"
                            class="btn o_arrow_button btn-secondary disabled d-none d-md-block">
                            Validate
                        </button>
                        <button type="button" data-value="draft" disabled="disabled" title="Current state" aria-pressed="true"
                            class="btn o_arrow_button btn-primary disabled d-none d-md-block" aria-current="step">
                            Draft
                        </button>
                    @endif
                    @if($data->state == "posted" ) 
                        <button type="button" data-value="draft" disabled="disabled" title="Current state" aria-pressed="true"
                            class="btn o_arrow_button btn-primary disabled d-none d-md-block" aria-current="step">
                            Validate
                        </button>
                        <button type="button" data-value="sent" disabled="disabled" title="Not active state" aria-pressed="false"
                            class="btn o_arrow_button btn-secondary disabled d-none d-md-block">
                            Draft
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="o_content">
        <div class="o_form_view o_form_editable">
            <div class="o_form_sheet_bg">
                <div class="clearfix o_form_sheet">
                    <div class="o_not_full oe_button_box mx-0">
                        <a href="{{route('reconcile.bill', $data->partner_id)}}" type="button" class="btn oe_stat_button">
                            <i class="fa fa-fw o_button_icon fa-dollar"></i>
                            <span>Payment Matching</span>
                        </a>
                    </div>
                    <div class="oe_title ml-3 mt-5">
                        <h1>
                            <span class="o_field_char o_field_widget o_readonly_modifier">{{$data->name}}</span>
                        </h1>
                    </div>
                    <div class="o_group">
                        <div class="row">
                            <div class="col-12 col-md-6"> 
                                <table class="o_group o_inner_group ml-3">
                                    <tbody>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label o_required_modifier">Payment Type</label>
                                            </td>
                                            <td style="width: 100%;">
                                                @if ($data->payment_type == "inbound")
                                                    Send Money
                                                @else
                                                    Receive Money
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="partner_type" class="col-form-label"><b>Partner Type </b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                {{$data->partner_type}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="partner" class="col-form-label"><b>Partner</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                {{$data->vendor->partner_name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label o_readonly_modifier o_required_modifier">Company</label>
                                            </td>
                                            <td style="width: 100%;">
                                                {{$data->company->company_name}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-md-6">
                                <table class="o_group o_inner_group">
                                    <tbody>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label o_required_modifier">Journal</label>
                                            </td>
                                            <td style="width: 100%;">
                                                {{$data->journal->name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label o_required_modifier">Payment Method</label></td>
                                            <td style="width: 100%;">
                                                {{$data->payment_method_id}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6"> 
                                <table class="o_group o_inner_group ml-3">
                                    <tbody>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label">Amount</label>
                                            </td>
                                            <td style="width: 100%;">
                                                Rp. {{ number_format($data->amount)}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label o_required_modifier">Date</label>
                                            </td>
                                            <td style="width: 100%;">
                                                {{$data->payment_date}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label">Bank Reference</label>
                                            </td>
                                            <td style="width: 100%;">
                                                {{$data->bank_reference}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label">Cheque Reference</label>
                                            </td>
                                            <td style="width: 100%;">
                                                {{$data->cheque_reference}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label">Memo</label>
                                            </td>
                                            <td style="width: 100%;">
                                                {{$data->communication}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('js')
<script src="{{asset('js/asset_common/payment.js')}}"></script>
@endsection
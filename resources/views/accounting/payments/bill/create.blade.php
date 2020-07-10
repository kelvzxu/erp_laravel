@extends('layouts.admin')
@section('title','Payment Invoice')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<form action="{{ route('payment.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="app-page-title bg-white">
        <div class="o_control_panel">
            <div>
                <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('payment_bills.index')}}">Payments</a></li>
                    <li class="breadcrumb-item active">New</li>
                </ol>
            </div>
            <div>
                <div class="o_cp_left">
                    <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                        <div>
                            <button class="btn btn-primary my-2" @click="create" :disabled="isProcessing">Save</button>
                            <a href="{{route('payment_bills.index')}}" class="btn btn-secondary mby-2">Discard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="o_content">
        <div class="o_form_view o_form_editable">
            <div class="o_form_sheet_bg">
                <div class="clearfix position-relative o_form_sheet">
                    <div class="o_not_full oe_button_box">
                        <button type="button" class="btn oe_stat_button o_invisible_modifier">
                            <i class="fa fa-fw o_button_icon fa-dollar"></i>
                            <span>Payment Matching</span>
                        </button>
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
                                                <div class="row ml-3">
                                                    <input class="form-check-input" type="radio" id="payment_type" name="payment_type" value="inbound" checked="True">
                                                    <label class="o_form_label">Send Money</label>
                                                </div>
                                                <div class="row ml-3 mb-2">
                                                    <input class="form-check-input" type="radio" id="payment_type" name="payment_type" value="outbound">
                                                    <label class="o_form_label">Receive Money</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="partner_type" class="col-form-label"><b>Partner Type </b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="form-group">
                                                    <select id="partner_type" required name="partner_type" class="form-control o_input o_field_widget o_required_modifier">
                                                        <option value="vendor">Vendor</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="partner" class="col-form-label"><b>Partner</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="form-group">
                                                    <select id="partner_id" required name="partner_id" class="form-control o_input o_field_widget o_required_modifier">
                                                        <option value=""></option>
                                                        @foreach ($partner as $row)
                                                            <option value="{{ $row->id }}">{{ ucfirst($row->partner_name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label o_readonly_modifier o_required_modifier">Company</label>
                                            </td>
                                            <td style="width: 100%;">
                                                <a class="o_form_uri o_field_widget o_readonly_modifier o_required_modifier"
                                                href="#id=1&amp;model=res.company" name="company_id"><span>{{$company->company_name}}</span></a>
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
                                                <select class="o_input o_field_widget o_required_modifier required" required name="journal_id">
                                                    <option value=""></option>
                                                    @foreach ($journal as $row)
                                                        <option value="{{ $row->id }}">{{ ucfirst($row->name) }} ({{ ucfirst($row->currency->currency_name) }})</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label o_required_modifier required">Payment Method</label></td>
                                            <td style="width: 100%;">
                                                <div class="row ml-3">
                                                    <input class="form-check-input" type="radio" id="payment_method" name="payment_method" value="Manual" checked="True">
                                                    <label class="o_form_label">Manual</label>
                                                </div>
                                                <div class="row ml-3 mb-2">
                                                    <input class="form-check-input" type="radio" id="payment_method" name="payment_method" value="PDC">
                                                    <label class="o_form_label">PDC</label>
                                                </div>
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
                                                <div name="amount_div" class="o_row">
                                                    <input type="text" class="o_input o_field_widget o_required_modifier" required name="amount">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label o_required_modifier">Date</label>
                                            </td>
                                            <td style="width: 100%;">
                                                <input type="date" class="o_input o_field_widget o_required_modifier" required name="payment_date">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label">Bank Reference</label>
                                            </td>
                                            <td style="width: 100%;">
                                                <input class="o_field_char o_field_widget o_input" name="bank_reference">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label">Cheque Reference</label>
                                            </td>
                                            <td style="width: 100%;">
                                                <input class="o_field_char o_field_widget o_input" name="cheque_reference">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label">Memo</label>
                                            </td>
                                            <td style="width: 100%;">
                                                <input class="o_field_char o_field_widget o_input" name="communication">
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
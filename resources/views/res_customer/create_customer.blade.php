@extends('layouts.admin')
@section('title','Partner - Customers')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<form action="{{ route('customer.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="app-page-title bg-white">
        <div class="o_control_panel">
            <div>
                <ol class="breadcrumb" role="navigation">
                    <li class="breadcrumb-item" accesskey="b"><a href="{{route('customer')}}">Customers</a></li>
                    <li class="breadcrumb-item active">New</li>
                </ol>
            </div>
            <div>
                <div class="o_cp_left">
                    <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                        <div>
                            <button class="btn btn-primary my-2" @click="create" :disabled="isProcessing">Save</button>
                            <a href="{{route('customer')}}" class="btn btn-secondary mby-2">Discard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="o_content">
        <div class="o_form_view o_form_editable">
            <div class="o_form_sheet_bg">
                <div class="clearfix o_form_sheet">
                    <div class="o_not_full oe_button_box mx-0">
                        <button type="button" class="btn oe_stat_button" name="457">
                            <i class="fa fa-fw o_button_icon fa-usd"></i>
                            <div name="sale_order_count" class="o_field_widget o_stat_info o_readonly_modifier"
                                data-original-title="" title="">
                                <span class="o_stat_value">0</span>
                                <span class="o_stat_text">Saldo</span>
                            </div>
                        </button>
                        <button type="button" class="btn oe_stat_button" name="457">
                            <i class="fa fa-fw o_button_icon fa-usd"></i>
                            <div name="sale_order_count" class="o_field_widget o_stat_info o_readonly_modifier"
                                data-original-title="" title="">
                                <span class="o_stat_value">0</span>
                                <span class="o_stat_text">Sales</span>
                            </div>
                        </button>
                        <button type="button" class="btn oe_stat_button" name="action_view_partner_invoices"
                            context="{'default_partner_id': active_id}">
                            <i class="fa fa-fw o_button_icon fa-pencil-square-o"></i>
                            <div class="o_form_field o_stat_info">
                                <span class="o_stat_value">
                                    <span class="o_field_monetary o_field_number o_field_widget o_readonly_modifier"
                                    name="total_invoiced" data-original-title="" title="">0.00</span>
                                </span>
                                <span class="o_stat_text">Invoiced</span>
                            </div>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <div class="row">
                                <div class="col-9">
                                    <h1>
                                        <div class="o_field_partner_autocomplete dropdown open wrap-input200 o_required_modifier" name="name"
                                            placeholder="Name" data-original-title="" title="">
                                            <input class="input200  @error('name') is-invalid @enderror" placeholder="Name" type="text" id="name" name="name" value="{{ old('name') }}" required>
                                        </div>
                                    </h1>
                                    <div class="o_row">
                                        <div class="wrap-input200 " aria-atomic="true" name="Parent_id" placeholder="Company" data-original-title="" title="">
                                            <input type="text" class="input200" placeholder="Company" autocomplete="off" value="{{ old('Parent_id') }}" name="Parent_id" id="Parent_id" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <img id='img-upload' src="{{asset('images/icons/picture.png')}}" width="50px"/>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file bg-primary text-white">
                                            Browse… <input type="file" id="imgInp" name="photo">
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="o_group">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <table class="o_group o_inner_group">
                                    <tbody>
                                        <tr>
                                            <td class="o_td_label"><label class="col-form-label" for="o_field_input_566"
                                                    data-original-title="" title=""><b>Address type</b></label></td>
                                            <td style="width: 100%;">
                                            <div class="wrap-input200">
                                                <select class="input200" name="type" id="type" style="border:none;" required>
                                                    <option value="" style=""></option>
                                                    <option value="contact" style="">Contact</option>
                                                    <option value="invoice" style="">Invoice Address</option>
                                                    <option value="delivery" style="">Delivery Address</option>
                                                    <option value="other" style="">Other Address</option>
                                                    <option value="private" style="">Private Address</option>
                                                </select>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="address_name" class="col-form-label"><b>Address</b></label>
                                            </td>
                                            <td>
                                                <div class="o_address_format">
                                                    <div class="wrap-input200">
                                                        <input class="input200 " name="street1" required value="{{ old('street1') }}" 
                                                            placeholder="Street..." type="text" id="street1" >
                                                    </div>
                                                    <div class="wrap-input200">
                                                        <input class="input200" value="{{ old('street2') }}"
                                                            name="street2" placeholder="Street 2..." type="text" id="street2">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="wrap-input200">
                                                                <input class="input200" required value="{{ old('city') }}"
                                                                    name="city" placeholder="City..." type="text" id="city">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="wrap-input200">
                                                                <input class="input200" required value="{{ old('zip') }}"
                                                                    name="zip" placeholder="ZIP" type="text" id="zip">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wrap-input200">
                                                        <select id="country" name="country" class="input200" required style="border:none;">
                                                            <option value="">country</option>
                                                        </select>
                                                    </div>
                                                    <div class="wrap-input200">
                                                        <select id="state" name="state" class="input200" style="border:none;">
                                                            <option value="">State</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="industry" class="col-form-label"><b>industry</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="wrap-input200">
                                                    <select id="industry_id" required name="industry_id" class="input200" style="border:none;">
                                                        <option value="">Industry</option>
                                                    </select>
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
                                            <td class="o_td_label">
                                                <label for="" name="email" class="col-form-label"><b>Email</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="wrap-input200">
                                                    <input class="input200 " name="email" required value="{{ old('email') }}" 
                                                        placeholder="email@example.com" type="text" id="email" >
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="phone" class="col-form-label"><b>Phone</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="wrap-input200">
                                                    <input class="input200 " name="phone" required value="{{ old('phone') }}" type="text" id="phone" >
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="mobile" class="col-form-label"><b>mobile</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="wrap-input200">
                                                    <input class="input200 " name="mobile" value="{{ old('mobile') }}" type="text" id="mobile" >
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="website" class="col-form-label"><b>Website Link</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="wrap-input200">
                                                    <input class="input200 " name="website" placeholder="https://www.kltech-intl.technology" value="{{ old('website') }}" type="text" id="website" >
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="reference" class="col-form-label"><b>Reference</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="wrap-input200">
                                                    <input class="input200 " name="reference" value="{{ old('reference') }}" type="text" id="reference" >
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="lag" class="col-form-label"><b>Language</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="wrap-input200">
                                                    <select id="lag" name="lag" class="input200" required style="border:none;">
                                                        <option value="">Language</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="tz/cr" class="col-form-label"><b>Timezone / Currency</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="wrap-input200">
                                                            <select id="tz" name="tz" class="input200" required style="border:none;">
                                                                <option value="">Timezone</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="wrap-input200">
                                                            <select id="currency_id" name="currency_id" required class="input200" style="border:none;">
                                                                <option value="">Currency</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="o_notebook">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a data-toggle="tab" disable_anchor="true" href="#notebook_page_581"
                                    class="nav-link active" role="tab" aria-selected="true">Sales &amp; Purchase</a></li>
                            <li class="nav-item"><a data-toggle="tab" disable_anchor="true" href="#notebook_page_591"
                                    class="nav-link" role="tab">Accounting</a></li>
                            <li class="nav-item o_invisible_modifier"><a data-toggle="tab" disable_anchor="true"
                                    href="#notebook_page_595" class="nav-link" role="tab">Invoicing</a></li>
                            <li class="nav-item"><a data-toggle="tab" disable_anchor="true" href="#notebook_page_596"
                                    class="nav-link" role="tab">Internal Notes</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="notebook_page_581">
                                <div class="o_group">
                                    <table class="o_group o_inner_group o_group_col_6">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" style="width: 100%;">
                                                    <div class="o_horizontal_separator">Sales</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label for="" name="sales" class="col-form-label"><b>Sales Person</b></label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <select id="sales" name="sales" class="input200" required style="border:none;">
                                                            <option value=""></option>
                                                            @foreach ($employee as $row)
                                                                <option value="{{ $row->id }}">{{ ucfirst($row->employee_name) }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label for="" name="payment" class="col-form-label"><b>Payment Terms</b></label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <select id="payment_terms" name="payment_terms" class="input200" style="border:none;">
                                                            <option value=""></option>
                                                            <option value="1" style="">Immediate Payment</option>
                                                            <option value="2" style="">15 Days</option>
                                                            <option value="3" style="">21 Days</option>
                                                            <option value="4" style="">30 Days</option>
                                                            <option value="5" style="">45 Days</option>
                                                            <option value="6" style="">2 Months</option>
                                                            <option value="7" style="">End of Following Month</option>
                                                            <option value="8" style="">30% Now, Balance 60 Days</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="notebook_page_591">
                                <div class="o_group">
                                    <table class="o_group o_inner_group o_group_col_6">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" style="width: 100%;">
                                                    <div class="o_horizontal_separator">Accounting Entries</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label for="" name="journal" class="col-form-label"><b>Invoice Journal </b></label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <select id="journal" required name="journal" class="input200" style="border:none;">
                                                            <option value=""></option>
                                                            @foreach ($journal as $row)
                                                                <option value="{{ $row->id }}">{{ ucfirst($row->name) }} | {{ ucfirst($row->code) }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label for="" name="receivable_account" class="col-form-label"><b>Account Receivable</b></label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <select id="receivable_account" required name="receivable_account" class="input200" style="border:none;">
                                                            <option value=""></option>
                                                            @foreach ($account as $row)
                                                                <option value="{{ $row->id }}">{{ ucfirst($row->name) }} | {{ ucfirst($row->code) }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="width: 100%;">
                                                    <div class="o_horizontal_separator">Bank Accounts</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="o_td_label">
                                                    <label for="" name="bank_account" class="col-form-label"><b>Bank Account</b></label>
                                                </td>
                                                <td style="width: 100%;">
                                                    <div class="wrap-input200">
                                                        <input class="input200" name="bank_account" value="{{ old('bank_account') }}" type="text" id="bank_account" >
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="notebook_page_596">
                                <div class="wrap-input200">
                                    <textarea class="input200"
                                        name="note" placeholder="Internal note..." type="text" 
                                        style="overflow-y: hidden; height: 50px; resize: none;" data-original-title=""
                                        title="" value="{{old('note')}}"></textarea>
                                </div>
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
<script src="{{asset('js/asset_common/customer.js')}}"></script>
<script src="{{asset('js/ajax.js')}}"></script>
@endsection
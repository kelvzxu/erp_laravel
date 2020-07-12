@extends('layouts.admin')
@section('title','Customer Invoice')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<div id="invoice">
    <div class="app-page-title bg-white">
        <div class="o_control_panel">
            <div>
                <ol class="breadcrumb" role="navigation">
                    <li class="breadcrumb-item" accesskey="b"><a href="{{route('invoices')}}">Invoices</a></li>
                    <li class="breadcrumb-item active">New</li>
                </ol>
            </div>
            <div>
                <div class="o_cp_left">
                    <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                        <div>
                            <button class="btn btn-primary my-2" @click="create" :disabled="isProcessing">Save</button>
                            <a href="{{route('invoices')}}" class="btn btn-secondary mby-2">Discard</a>
                        </div>
                    </div>
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
                            <input type="text" class="input200 bg-white" readonly style="border:none" value="INV/<?php echo date("Y"); ?>/*Draft_Invoice">
                        </span>
                        <h1><span class="o_field_char o_field_widget o_readonly_modifier o_required_modifier" name="name">New</span></h1>
                    </div>
                    <div class="o_group">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <table class="o_group o_inner_group">
                                    <tbody>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label o_required_modifier">Customer</label>
                                            </td>
                                            <td>
                                                <div class="wrap-input200">
                                                    <select id="client" class="input200" v-model="form.client" style="border:none;">
                                                        <option value="">Select customer</option>
                                                        @foreach ($customer as $row)
                                                            <option value="{{ $row->id }}">{{ ucfirst($row->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label">Address</label>
                                            </td>
                                            <td>
                                                <div class="wrap-input200">
                                                    <textarea id="address" class="input200" v-model="form.client_address" require></textarea>
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
                                                    data-original-title="" title="">Invoice Date</label></td>
                                            <td>
                                                <div class="wrap-input200">
                                                    <input type="text" class="input200" v-model="form.invoice_date" value="<?php echo date("Y-m-d");?>"require>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label"><label class="o_form_label o_readonly_modifier"
                                                    for="o_field_input_20">Due Date</label></td>
                                            <td>
                                                <div class="wrap-input200">
                                                    <input type="date" class="input200" v-model="form.due_date" require>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label"><label class="o_form_label o_readonly_modifier"
                                                    for="o_field_input_20">Source Document</label></td>
                                            <td>
                                                <div class="wrap-input200">
                                                    <input type="text" class="input200" v-model="form.title" require>
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
                                    <tr v-for="product in form.products">
                                        <td class="table-name" :class="{'table-error': errors['products.' + $index + '.name']}">
                                            <select id="product" class="input200" v-model="product.name" style="border:none;">
                                                <option value="">Select product</option>
                                                @foreach ($product as $row)
                                                    <option value="{{ $row->id }}">{{ ucfirst($row->name) }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="table-price" :class="{'table-error': errors['products.' + $index + '.price']}">
                                            <input type="text" id="price" class="input200"  v-model="product.price">
                                        </td>
                                        <td class="table-qty" :class="{'table-error': errors['products.' + $index + '.qty']}">
                                            <input type="text" class="input200" v-model="product.qty">
                                        </td>
                                        <td class="table-total">
                                            <span class="table-text">@{{product.qty * product.price}}</span>
                                        </td>
                                        <td class="table-remove">
                                            <span @click="remove(product)" class="table-remove-btn"><i class="fa fa-trash"></i></span>
                                        </td>
                                    </tr> 
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="table-empty" colspan="2">
                                            <span @click="addLine" class="table-add_line">Add Line</span>
                                        </td>
                                        <td class="table-label">Sub Total</td>
                                        <td class="table-amount">@{{subTotal}}</td>
                                    </tr>
                                    <tr>
                                        <td class="table-empty" colspan="2" style="border:none;"></td>
                                        <td class="table-label">Discount</td>
                                        <td class="table-discount" :class="{'table-error': errors.discount}">
                                            <input type="text" class="table-discount_input" v-model="form.discount">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-empty" colspan="2" style="border:none;"></td>
                                        <td class="table-label">Grand Total</td>
                                        <td class="table-amount">@{{grandTotal}}</td>
                                    </tr>
                                </tfoot> 
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
<script src="{{asset('/js/transaksi/vue-resource.min.js')}}"></script>
<script type="text/javascript">
    Vue.http.headers.common['X-CSRF-TOKEN'] = '{{csrf_token()}}';

    window._form = {
        invoice_no: '',
        client: '',
        client_address: '',
        title: '',
        invoice_date: '',
        due_date: '',
        discount: 0,
        products: [{
            name: '',
            price: 0,
            qty: 1
        }]
    };
</script>
<script src="{{asset('/js/transaksi/invoice.js')}}"></script>
<script src="{{asset('js/asset_common/invoice.js')}}"></script>
@endsection
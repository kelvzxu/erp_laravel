@extends('layouts.admin')
@section('title','Sales - Quotation')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<div id="sales" class="system_background">
    <div class="app-page-title bg-white">
        <div class="o_control_panel">
            <div>
                <ol class="breadcrumb" role="navigation">
                    <li class="breadcrumb-item" accesskey="b"><a href="{{route('sales_orders')}}">Quotation</a></li>
                    <li class="breadcrumb-item active">New</li>
                </ol>
            </div>
            <div>
                <div class="o_cp_left">
                    <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                        <div>
                            <button class="btn btn-primary my-2" @click="create" :disabled="isProcessing">Save</button>
                            <a href="{{route('sales_orders')}}" class="btn btn-secondary mby-2">Discard</a>
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
                        <span class="o_form_label">Quotation</span>
                        <h1><span class="o_field_char o_field_widget o_readonly_modifier o_required_modifier" name="name">New</span></h1>
                    </div>
                    <div class="o_group">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <table class="o_group o_inner_group">
                                    <tbody>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label o_required_modifier">customer</label>
                                            </td>
                                            <td>
                                                <div class="wrap-input200">
                                                    <select id="Customer" class="input200" required style="border:none;" v-model="form.customer">
                                                        <option value=""></option>
                                                        @foreach ($partner as $row)
                                                            <option value="{{ $row->id }}">{{ ucfirst($row->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label class="o_form_label">Customer Reference</label>
                                            </td>
                                            <td>
                                                <div class="wrap-input200">
                                                    <input class="input200" type="text" v-model="form.customer_reference">
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
                                                    <input type="text" class="input200" v-model="form.order_date" readonly  value="<?php echo date("Y-m-d");?>"require>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label"><label class="o_form_label o_required_modifier" for="o_field_input_19"
                                                    data-original-title="" title="">Expiration</label></td>
                                            <td>
                                                <div class="wrap-input200">
                                                    <input type="date" class="input200" v-model="form.expiration">
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
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="product in form.products">
                                        <td class="table-name" :class="{'table-error': errors['products.' + $index + '.name']}">
                                            <select id="product" class="form-control" v-model="product.name">
                                                <option value="">Select product</option>
                                                @foreach ($product as $row)
                                                    <option value="{{ $row->id }}">{{ ucfirst($row->name) }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="table-price" :class="{'table-error': errors['products.' + $index + '.price']}">
                                            <input type="text" id="price" class="form-control"  v-model="product.price">
                                        </td>
                                        <td class="table-qty" :class="{'table-error': errors['products.' + $index + '.qty']}">
                                            <input type="text" class="form-control" v-model="product.qty">
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
                                            <span @click="addLine" class="table-add_line">Add a Product</span>
                                        </td>
                                        <td class="table-label">Sub Total</td>
                                        <td class="table-amount">@{{subTotal}}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="table-empty" colspan="2" style="border:none;"></td>
                                        <td class="table-label">Discount</td>
                                        <td class="table-discount" :class="{'table-error': errors.discount}">
                                            <input type="text" class="table-discount_input" v-model="form.discount">
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="table-empty" colspan="2" style="border:none;"></td>
                                        <td class="table-label">Grand Total</td>
                                        <td class="table-amount">@{{grandTotal}}</td>
                                        <td></td>
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
        purchase_no: '',
        client: '',
        client_address: '',
        title: '',
        purchase_date: '',
        due_date: '',
        discount: 0,
        products: [{
            name: '',
            price: 0,
            qty: 1
        }]
    };
</script>
<script src="{{asset('/js/transaksi/sales_order.js')}}"></script>
<script src="{{asset('js/asset_common/sales.js')}}"></script>
@endsection
@extends('layouts.admin')
@section('title','SK - Employee')
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
    <div class="row">
        <div class="col-12 mt-5">
            <div class="panel panel-default container bg-white" v-cloak>
                <div class="panel-body">
                    <div class="row ">
                        <div class="col-sm-4 mt-4">
                            <div class="form-group">
                                <label>Invoice No.</label>
                                <input type="text" class="form-control bg-white" readonly style="border:none" value="INV/<?php echo date("Y"); ?>/*Draft_Invoice">
                                <p v-if="errors.invoice_no" class="error">@{{errors.invoice_no[0]}}</p>
                            </div>
                            <div class="form-group">
                                <label>Client</label>
                                <select id="client" class="form-control" v-model="form.client">
                                    <option value="">Select customer</option>
                                    @foreach ($customer as $row)
                                        <option value="{{ $row->id }}">{{ ucfirst($row->name) }}</option>
                                    @endforeach
                                </select>
                                <p v-if="errors.client" class="error">@{{errors.client[0]}}</p>
                            </div>
                        </div>
                        <div class="col-sm-4 mt-4 ">
                            <div class="form-group">
                                <label>Client Address</label>
                                <textarea id="address" class="form-control" v-model="form.client_address" require></textarea>
                                <p v-if="errors.client_address" class="error">@{{errors.client_address[0]}}</p>
                            </div>
                        </div>
                        <div class="col-sm-4 mt-4">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" v-model="form.title" require>
                                <p v-if="errors.title" class="error">@{{errors.title[0]}}</p>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Invoice Date</label>
                                    <input type="text" class="form-control" v-model="form.invoice_date" value="<?php echo date("Y-m-d");?>"require>
                                    <p v-if="errors.invoice_date" class="error">@{{errors.invoice_date[0]}}</p>
                                </div>
                                <div class="col-sm-6">
                                    <label>Due Date</label>
                                    <input type="date" class="form-control" v-model="form.due_date" require>
                                    <p v-if="errors.due_date" class="error">@{{errors.due_date[0]}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div v-if="errors.products_empty">
                        <p class="alert alert-danger">@{{errors.products_empty[0]}}</p>
                        <hr>
                    </div>
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
                <div class="panel-footer mb-4">
                    <br>
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
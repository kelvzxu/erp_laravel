@extends('layouts.admin')
@section('title','Inventory - Product')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="app-page-title bg-white">
        <div class="o_control_panel">
            <div>
                <ol class="breadcrumb" role="navigation">
                    <li class="breadcrumb-item" accesskey="b"><a href="{{route('product')}}">Products</a></li>
                    <li class="breadcrumb-item active">New</li>
                </ol>
            </div>
            <div>
                <div class="o_cp_left">
                    <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                        <div>
                            <button class="btn btn-primary my-2" @click="create" :disabled="isProcessing">Save</button>
                            <a href="{{route('product')}}" class="btn btn-secondary mby-2">Discard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="o_form_view o_form_editable">
            <div class="container-fluid mt-5">
                <div class="clearfix o_form_sheet">
                    <div class="o_not_full oe_button_box mx-0">
                        <button type="button" class="btn oe_stat_button" name="457">
                            <i class="fa fa-cubes o_button_icon fa-usd"></i>
                            <div name="sale_order_count" class="o_field_widget o_stat_info o_readonly_modifier"
                                data-original-title="" title="">
                                <span class="o_stat_value">0 Units</span>
                                <span class="o_stat_text">On Hands</span>
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
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="wrap-input200">
                                        <label for="">Produk Name</label>
                                            <input type="text" name="name" required placeholder="Product Name"
                                                class="input200 {{ $errors->has('name') ? 'is-invalid':'' }}">
                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                    </div>
                                    <div class="form-check mt-0">
                                        <input class="form-check-input" type="checkbox" id="can_be_sold" name="can_be_sold" value="1">
                                        <label class="form-check-label" for="canbesold">
                                            Can Be Sold
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="can_be_purchase" name="can_be_purchase" value="1">
                                        <label class="form-check-label" for="canbepurchase">
                                            Can Be Purchase
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <img id='img-upload' src="{{asset('images/icons/picture.png')}}" width=1000px/>
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
                    <div class="o_notebook">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a data-toggle="tab" disable_anchor="true" href="#notebook_page_581"
                                    class="nav-link active" role="tab" aria-selected="true">General Information</a>
                            </li>
                            <li class="nav-item"><a data-toggle="tab" disable_anchor="true" href="#notebook_page_582"
                                    class="nav-link" role="tab" aria-selected="true">Accounting</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="notebook_page_581">
                                <div class="o_group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-5 col-form-label">Product Category</label>
                                                <div class="wrap-input200 col-sm-6">
                                                    <select name="category_id" id="category_id" style="border:none"
                                                        required class="input200 {{ $errors->has('price') ? 'is-invalid':'' }}">
                                                        <option value="">Select Category</option>
                                                        @foreach ($categories as $row)
                                                            <option value="{{ $row->id }}">{{ ucfirst($row->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-5 col-form-label">Internal Reference</label>
                                                <div class="wrap-input200 col-sm-6">
                                                    <input type="text" name="code" id="code" maxlength="10" class="input200 {{ $errors->has('code') ? 'is-invalid':'' }}" value="{{ old('code') }}" autofocus>
                                                    <p class="text-danger">{{ $errors->first('code') }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-5 col-form-label">Barcode</label>
                                                <div class="wrap-input200 col-sm-6">
                                                    <input type="text" name="barcode" id="barcode" maxlength="10" class="input200 {{ $errors->has('barcode') ? 'is-invalid':'' }}" value="{{ old('barcode') }}" required autofocus>
                                                    <p class="text-danger">{{ $errors->first('barcode') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-5 col-form-label">Sales Price</label>
                                                <div class="wrap-input200 col-sm-5">
                                                    <input type="number" name="price" required value="0"
                                                    class="input200 {{ $errors->has('price') ? 'is-invalid':'' }}">
                                                    <p class="text-danger">{{ $errors->first('price') }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-5 col-form-label">Cost</label>
                                                <div class="wrap-input200 col-sm-5">
                                                    <input type="number" name="cost" required value="0"
                                                    class="input200 {{ $errors->has('cost') ? 'is-invalid':'' }}">
                                                    <p class="text-danger">{{ $errors->first('cost') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-11">
                                            <div class="wrap-input200 mt-4">
                                                <label for="">Internal Note</label>
                                                <textarea name="description" id="description" 
                                                    cols="5" rows="5" placeholder="This note is only for internal purpose"
                                                    class="input200 {{ $errors->has('description') ? 'is-invalid':'' }}"></textarea>
                                                <p class="text-danger">{{ $errors->first('description') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <div class="tab-pane" id="notebook_page_582">
                                <div class="o_group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-5 col-form-label">Income Account</label>
                                                <div class="wrap-input200 col-sm-6">
                                                    <select name="income_account" id="income_account" style="border:none"
                                                        required class="input200 {{ $errors->has('income_account') ? 'is-invalid':'' }}">
                                                        @foreach ($account as $row)
                                                            <option value="{{ $row->id }}">{{ $row->code }}&nbsp;{{ ucfirst($row->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">{{ $errors->first('income_account') }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-5 col-form-label">Expense Account</label>
                                                <div class="wrap-input200 col-sm-6">
                                                    <select name="expense_account" id="expense_account" style="border:none"
                                                        required class="input200 {{ $errors->has('expense_account') ? 'is-invalid':'' }}">
                                                        @foreach ($account as $row)
                                                            <option value="{{ $row->id }}">{{ $row->code }}&nbsp;{{ ucfirst($row->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">{{ $errors->first('expense_account') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-5 col-form-label">Stock Input Account</label>
                                                <div class="wrap-input200 col-sm-6">
                                                    <select name="stock_input_account" id="stock_input_account" style="border:none"
                                                        required class="input200 {{ $errors->has('stock_input_account') ? 'is-invalid':'' }}">
                                                        @foreach ($account as $row)
                                                            <option value="{{ $row->id }}">{{ $row->code }}&nbsp;{{ ucfirst($row->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">{{ $errors->first('stock_input_account') }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-5 col-form-label">Stock output Account</label>
                                                <div class="wrap-input200 col-sm-6">
                                                    <select name="stock_output_account" id="stock_output_account" style="border:none"
                                                        required class="input200 {{ $errors->has('stock_output_account') ? 'is-invalid':'' }}">
                                                        @foreach ($account as $row)
                                                            <option value="{{ $row->id }}">{{ $row->code }}&nbsp;{{ ucfirst($row->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">{{ $errors->first('stock_output_account') }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-5 col-form-label">Stock valuation Account</label>
                                                <div class="wrap-input200 col-sm-6">
                                                    <select name="stock_valuation_account" id="stock_valuation_account" style="border:none"
                                                        required class="input200 {{ $errors->has('stock_valuation_account') ? 'is-invalid':'' }}">
                                                        @foreach ($account as $row)
                                                            <option value="{{ $row->id }}">{{ $row->code }}&nbsp;{{ ucfirst($row->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">{{ $errors->first('stock_valuation_account') }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-5 col-form-label">Stock Journal</label>
                                                <div class="wrap-input200 col-sm-6">
                                                    <select name="stock_journal" id="stock_journal" style="border:none"
                                                        required class="input200 {{ $errors->has('stock_journal') ? 'is-invalid':'' }}">
                                                        @foreach ($journal as $row)
                                                            <option value="{{ $row->id }}">{{ $row->code }}&nbsp;{{ ucfirst($row->name) }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">{{ $errors->first('stock_journal') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</form>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
$('a#product').addClass('mm-active');
</script>
@endsection
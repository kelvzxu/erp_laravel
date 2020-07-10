@extends('layouts.admin')
@section('title',"[$product->code] $product->name")
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="app-page-title bg-white">
        <div class="o_control_panel">
            <div>
                <ol class="breadcrumb" role="navigation">
                    <li class="breadcrumb-item" accesskey="b"><a href="{{route('product')}}">Products</a></li>
                    <li class="breadcrumb-item active">{{$product->name}}</li>
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
                    <aside class="o_cp_sidebar">
                        <div class="btn-group">
                            <div class="btn-group o_dropdown" style="display: none;">
                                <button class="o_dropdown_toggler_btn btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Print
                                </button>
                                
                                <div class="dropdown-menu o_dropdown_menu" role="menu">
                                        
                                </div>
                            </div>

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
    </div>
    <div class="o_content">
        <div class="o_form_view o_form_editable">
            <div class="o_form_sheet_bg">
                <div class="clearfix o_form_sheet">
                    <div class="o_not_full oe_button_box mx-0">
                        <button type="button" class="btn oe_stat_button" name="457">
                            <i class="fa fa-cubes o_button_icon fa-usd"></i>
                            <div name="sale_order_count" class="o_field_widget o_stat_info o_readonly_modifier"
                                data-original-title="" title="">
                                <span class="o_stat_value">{{ $product->stock }} Units</span>
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
                                                class="input200 {{ $errors->has('name') ? 'is-invalid':'' }}" value="{{ $product->name }}">
                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                    </div>
                                    <div class="form-check mt-0">
                                        <input class="form-check-input" type="checkbox" id="can_be_sold" name="can_be_sold" value="1"  @if($product->can_be_sold == "1" ) checked @endif>
                                        <label class="form-check-label" for="canbesold">
                                            Can Be Sold
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="can_be_purchase" name="can_be_purchase" value="1" @if($product->can_be_purchase == "1" ) checked @endif>
                                        <label class="form-check-label" for="canbepurchase">
                                            Can Be Purchase
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <img id='img-upload' src="{{ asset('uploads/product/' . $product->photo) }}" width=1000px/>
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
                                                            <option value="{{ $row->id }}" {{ $row->id == $product->category_id ? 'selected':'' }}>
                                                                {{ ucfirst($row->name) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-5 col-form-label">Internal Reference</label>
                                                <div class="wrap-input200 col-sm-6">
                                                    <input type="text" name="code" id="code" maxlength="10" class="input200 {{ $errors->has('code') ? 'is-invalid':'' }}" value="{{ $product->code }}" autofocus>
                                                    <p class="text-danger">{{ $errors->first('code') }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-5 col-form-label">Barcode</label>
                                                <div class="wrap-input200 col-sm-6">
                                                    <input type="text" name="barcode" id="barcode" maxlength="10" class="input200 {{ $errors->has('barcode') ? 'is-invalid':'' }}" value="{{ $product->barcode }}" required autofocus>
                                                    <p class="text-danger">{{ $errors->first('barcode') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-5 col-form-label">Sales Price</label>
                                                <div class="wrap-input200 col-sm-5">
                                                    <input type="number" name="price" required value="{{ $product->price }}"
                                                    class="input200 {{ $errors->has('price') ? 'is-invalid':'' }}">
                                                    <p class="text-danger">{{ $errors->first('price') }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-sm-5 col-form-label">Cost</label>
                                                <div class="wrap-input200 col-sm-5">
                                                    <input type="number" name="cost" required value="{{ $product->cost }}"
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
                                                <textarea name="description" id="description" value="{{ $product->description }}"
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
                                                            <option value="{{ $row->id }}"  {{ $row->id == $product->income_account ? 'selected':'' }}>{{ $row->code }}&nbsp;{{ ucfirst($row->name) }}</option>
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
                                                            <option value="{{ $row->id }}" {{ $row->id == $product->expense_account ? 'selected':'' }}>{{ $row->code }}&nbsp;{{ ucfirst($row->name) }}</option>
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
                                                            <option value="{{ $row->id }}" {{ $row->id == $product->stock_input_account ? 'selected':'' }}>{{ $row->code }}&nbsp;{{ ucfirst($row->name) }}</option>
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
                                                            <option value="{{ $row->id }}" {{ $row->id == $product->stock_output_account ? 'selected':'' }}>{{ $row->code }}&nbsp;{{ ucfirst($row->name) }}</option>
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
                                                            <option value="{{ $row->id }}" {{ $row->id == $product->stock_valuation_account ? 'selected':'' }}>{{ $row->code }}&nbsp;{{ ucfirst($row->name) }}</option>
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
                                                            <option value="{{ $row->id }}" {{ $row->id == $product->stock_journal ? 'selected':'' }}>{{ $row->code }}&nbsp;{{ ucfirst($row->name) }}</option>
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
@section('modal')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{asset('images/icons/warning.png')}}" alt=""><br>
                <p class="mb-0">Are you sure to delete this Products record ( {{$product->name}} )</p>
                <p class="mb-0">You won't be able to revert this!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form id="delete-form-{{ $product->id }}" action="{{route('product.destroy', $product->id)}}" method="put">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash">  Delete</i></button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
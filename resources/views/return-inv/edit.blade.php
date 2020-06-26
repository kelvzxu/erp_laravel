@extends('layouts.admin')
@section('title','Return Invoice')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content') 
<form action="{{ route('return-invoice.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ $data-> id }}">
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
                            <button class="btn btn-primary my-2" @click="update" :disabled="isProcessing">Save</button>
                            <a href="{{route('return-invoice.view', $data)}}" class="btn btn-secondary mby-2">Discard</a>
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
    </div>
    <div class="o_content my-4" v-cloak>
        <div class="o_form_view o_form_editable">
            <div class="o_form_sheet_bg">
                <div class="clearfix position-relative o_form_sheet">
                    <div class="oe_title">
                        <span class="o_form_label">Return Invoice</span>
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
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->products as $row)
                                        <tr>
                                            <td class="table-name">
                                                <input type="hidden" class="form-control" name="line[]" value="{{$row->id}}" readonly>
                                                <input type="hidden" class="form-control" name="product[]" value="{{$row->name}}" readonly>
                                                <input type="text" style="border:none" class="form-control bg-white" value="{{$row->product->name}}" name="product_name[]" readonly>
                                            </td>
                                            <td class="table-price">
                                                <input type="text" style="border:none" class="form-control bg-white" value="Rp. {{ number_format($row->price)}}" readonly >
                                                <input type="hidden" style="border:none" class="form-control" value="{{$row->price}}" name="price[]">
                                            </td>
                                            <td class="table-qty">
                                                <input type="text" style="border:none"  class="form-control bg-white" value="{{$row->qty - $row->return_qty}}" name="buy_qty[]" readonly>
                                            </td>
                                            <td class="table-qty">
                                                <input type="number" style="border:none"  class="form-control" value="0" name="return_qty[]">
                                            </td>
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
</form>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
<script src="{{asset('/js/transaksi/vue-resource.min.js')}}"></script>
<script type="text/javascript">
    Vue.http.headers.common['X-CSRF-TOKEN'] = '{{csrf_token()}}';

    window._form = {!! $data->toJson() !!};
    var data  = {!! $data->toJson() !!};
</script>
<script src="{{asset('js/asset_common/return_inv.js')}}"></script>
@endsection
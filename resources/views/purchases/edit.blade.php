@extends('layouts.admin')
@section('title','SK - Employee')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<div id="purchase">
    <div class="app-page-title bg-white">
        <div class="o_control_panel">
            <div>
                <ol class="breadcrumb" role="navigation">
                    <li class="breadcrumb-item" accesskey="b"><a href="{{route('purchase_orders')}}">Request for Quotation</a></li>
                    <li class="breadcrumb-item active">{{$orders->order_no}}</li>
                </ol>
            </div>
            <div>
                <div class="o_cp_left">
                    <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                        <div>
                            <button class="btn btn-primary my-2" @click="update" :disabled="isProcessing">Save</button>
                            <a href="{{route('purchase_orders.show', $orders)}}" class="btn btn-secondary mby-2">Discard</a>
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
                    @include('purchases.form')
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

        window._form = {!! $orders->toJson() !!};
        var data  = {!! $orders->toJson() !!};
        console.log(data);
        $('a#purchases').addClass('mm-active');
        // $.each(product, function (i) {
        //     $.ajax  ({
        //         url: "{{asset('api/product/search')}}",
        //         type: 'post',
        //         dataType: 'json',
        //         data :{
        //             'id': product[i].name
        //         },
        //         success: function (result) {
        //             console.log(result.data.price);
        //             $("#product").val(result.data.name);
        //         }
        //     })
        // });
        $.ajax  ({
            url: "{{asset('api/partner/search')}}",
            type: 'post',
            dataType: 'json',
            data :{
                'id': "{{$orders->vendor}}"
            },
            success: function (result) {
                $("#client").val(result.data.partner_name);
            }
        })
        
        $('a#purchases_orders').addClass('mm-active');
    </script> 
    <script src="{{asset('/js/transaksi/purchase_order.js')}}"></script>
@endsection
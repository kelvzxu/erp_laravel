@extends('layouts.admin')
@section('title','SK - Employee')
@section('content')
    <div id="purchase">
        <div class="panel panel-default" v-cloak>
            <div class="panel-heading">
                <div class="clearfix">
                    <span class="panel-title">Create Purchase</span>
                    <a href="{{route('purchases')}}" class="btn btn-default pull-right">Back</a>
                </div>
            </div>
            <div class="panel-body">
                @include('purchases.form')
            </div>
            <div class="panel-footer">
                <a href="{{route('purchases')}}" class="btn btn-default">CANCEL</a>
                <button class="btn btn-success" @click="update" :disabled="isProcessing">UPDATE</button>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
    <script src="{{asset('/js/transaksi/vue-resource.min.js')}}"></script>
    <script type="text/javascript">
        Vue.http.headers.common['X-CSRF-TOKEN'] = '{{csrf_token()}}';

        window._form = {!! $purchase->toJson() !!};
        var data  = {!! $purchase->toJson() !!};
        var product = data.products
        $('a#purchases').addClass('mm-active');
        $.each(product, function (i) {
            $.ajax  ({
                url: "{{asset('api/product/search')}}",
                type: 'post',
                dataType: 'json',
                data :{
                    'id': product[i].name
                },
                success: function (result) {
                    console.log(result.data.price);
                    $("#product").val(result.data.name);
                }
            })
        });
        $.ajax  ({
            url: "{{asset('api/partner/search')}}",
            type: 'post',
            dataType: 'json',
            data :{
                'id': "{{$purchase->client}}"
            },
            success: function (result) {
                $("#client").val(result.data.partner_name);
            }
        })
        
        
    </script>
    <script src="{{asset('/js/transaksi/purchase.js')}}"></script>
@endsection
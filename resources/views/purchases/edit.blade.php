@extends('layouts.admin')
@section('title','SK - Employee')
@section('content')
<div id="purchase">
    <div class="panel-heading">
        <div class="clearfix mb-2">
            <div class="row">
                <div class="col-12 col-md-7">
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('purchases') }}">Purchases</a></li>
                                <li class="breadcrumb-item" aria-current="page" active>Return</li>
                            </ol>
                        </nav>
                    </div>
                    <h3>Return Purchase</h3>
                </div>
            </div>
            <span class="panel-title">
                <a href="{{route('purchases')}}" class="btn btn-danger mby-2">CANCEL</a>
                <button class="btn btn-success my-2" @click="update" :disabled="isProcessing">UPDATE</button>
            </span>
            <a href="{{route('purchases')}}" class="btn btn-warning my-2 pull-right">Back</a>
        </div>
    </div>
    <div class="panel panel-default container bg-white" v-cloak>
        <div class="panel-body">
            @include('purchases.form')
        </div>
        <div class="panel-footer">
            <br>
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
                'id': "{{$purchase->client}}"
            },
            success: function (result) {
                $("#client").val(result.data.partner_name);
            }
        })
        
        
    </script>
    <script src="{{asset('/js/transaksi/purchase.js')}}"></script>
@endsection
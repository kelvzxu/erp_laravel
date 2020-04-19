@extends('layouts.admin')
@section('title','SK - Employee')
@section('content')
<div class="panel-heading">
    <div class="clearfix">
        <div class="row">
            <div class="col-12 col-md-7">
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('invoices') }}">Invoice</a></li>
                                <li class="breadcrumb-item" aria-current="page" active>Return</li>
                            </ol>
                        </nav>
                    </div>
                    <h3>Invoice</h3>
                </div>
            </div>
            <span class="panel-title">
                <a href="{{route('invoices')}}" class="btn btn-danger mby-2">CANCEL</a>
                <button class="btn btn-success my-2" @click="update" :disabled="isProcessing">UPDATE</button>
            </span>
            <a href="{{route('invoices')}}" class="btn btn-warning my-2 pull-right">Back</a>
        </div>
    </div>
    <div id="invoice">
        <div class="panel container bg-white panel-default" v-cloak>
            <div class="panel-body">
                @include('invoices.form')
            </div>
            <div class="panel-footer mb-4">
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

        window._form = {!! $invoice->toJson() !!};
        var data  = {!! $invoice->toJson() !!};
        console.log(data);
        var product = data.products
        $('a#invoices').addClass('mm-active');

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
            url: "{{asset('api/customer/search')}}",
            type: 'post',
            dataType: 'json',
            data :{
                'id': "{{$invoice->client}}"
            },
            success: function (result) {
                $("#client").val(result.data.name);
            }
        })
        
        
    </script>
    <script src="{{asset('/js/transaksi/invoice.js')}}"></script>
@endsection
@extends('layouts.admin')
@section('title','SK - new Product')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Point Of Sale</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Transaksi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content" id="dw">
            <div class="card container bg-white">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row my-4">
                            <label class="col-10 col-sm-3 col-form-label">Barcode Product <div class="pull-right">:</div></label>
                            <div class="wrap-input200 col-5 ml-3">
                                <input type="text" name="barcode" autocomplete="off" class="input200 ">
                            </div>
                            <!-- <div class="col-md-2 md-none float-right">
                                <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i></button>
                            </div> -->
                        </div>
                        <hr style="border: 1px solid;">
                        <div class="row mt-2">
                            <div id="product-list" class="card-group">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pull-right">
                    <div class="container bg-white mt-3">
                        <div class="class-title my-3">
                        <i class="fa fa-shopping-cart"></i> Cart
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(row, index) in shoppingCart">
                                        <td>@{{ row.name }} (@{{ row.code }})</td>
                                        <td>@{{ row.price | currency }}</td>
                                        <td>@{{ row.qty }}</td>
                                        <td>
                                            <button 
                                                @click.prevent="removeCart(index)"    
                                                class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-muted">
                            @if (url()->current() == route('pos'))
                            <a href="{{ route('order.checkout') }}" 
                                class="btn btn-info btn-sm float-right">
                                Checkout
                            </a>
                            @else
                            <a href="{{ route('pos') }}"
                                class="btn btn-secondary btn-sm float-right"
                                >
                                Kembali
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js"></script>
    <script src="{{ asset('js/transaksi.js') }}"></script>
    <script>
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
    $.ajax({
        url: "{{asset('api/Products')}}",
        type: 'get',
        dataType: 'json',
        success: function (result) {
            if (result.status == "success") {
                let product = result.data;
                console.log(product);
                $.each(product, function (i, data) {
                    $('#product-list').append(`
                        <div class="col-md-4">
                        <div class="card mb-3">
                        <img src="{{ asset('uploads/product/` + data.photo + `')}}" class="card-img-top" width="150px" height="150px">
                        <div class="card-body">
                        <h5 class="card-title">` + data.name + `</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Category :` + data.category.name + `</h6>
                        <h6 class="card-subtitle mb-2 text-muted">Category :` + formatNumber(data.price) + `</h6>
                        <a href="#" class="card-link see-detail" data-toggle="modal" data-target="#exampleModal" 
                        >See Detail</a>
                        </div>
                        </div>
                    `)
                });

                // $('#search-input').val('');
            } else {
                console.log('error');
                // $('#movie-list').html(`
                // <div class="col">
                //     <h1 class="text-center">` + result.Error + `</h1>
                // </div>
                // `)
            }
        }
    });
    </script>
@endsection
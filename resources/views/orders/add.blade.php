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
                        <h1 class="m-0 text-dark">Transaksi</h1>
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card container bg-white">
                            @slot('title')
                            
                            @endslot

                            <div class="row">
                                <div class="col-md-4">
                                    <form action="#" @submit.prevent="addToCart" method="post">
                                        <div class="form-group">
                                            <label for="">Produk</label>
                                            <select name="product_id" id="product_id"
                                                v-model="cart.product_id"
                                                class="form-control" required width="100%">
                                                <option value="">Pilih</option>
                                                @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->code }} - {{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Qty</label>
                                            <input type="number" name="qty"
                                                v-model="cart.qty" 
                                                id="qty" value="1" 
                                                min="1" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm"
                                                :disabled="submitCart"
                                                >
                                                <i class="fa fa-shopping-cart"></i> @{{ submitCart ? 'Loading...':'Ke Keranjang' }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-5">
                                    <h4>Detail Produk</h4>
                                    <div v-if="product.name">
                                        <table class="table table-stripped">
                                            <tr>
                                                <th>Kode</th>
                                                <td>:</td>
                                                <td>@{{ product.code }}</td>
                                            </tr>
                                            <tr>
                                                <th width="3%">Produk</th>
                                                <td width="2%">:</td>
                                                <td>@{{ product.name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Harga</th>
                                                <td>:</td>
                                                <td>@{{ product.price | currency }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-3" v-if="product.photo">
                                    <img :src="'/uploads/product/' + product.photo" 
                                        height="150px" 
                                        width="150px" 
                                        :alt="product.name">
                                </div>
                            </div>
                            @slot('footer')

                            @endslot
                        </div>
                    </div>
                    @include('orders.cart')
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js"></script>
    <script src="{{ asset('js/transaksi.js') }}"></script>
@endsection
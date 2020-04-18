@extends('layouts.admin')
@section('title','SK - new Product')
@section('content')
    <!-- header -->
    <div class="container row">
        <div class="col-12 col-md-7">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('product') }}">Produk</a></li>
                        <li class="breadcrumb-item" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
            <h3>Update Product</h3>
        </div>
    </div>
    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="container row">
            <div class="col-3">
            <button class="btn btn-primary btn-sm">
                    <i class="fa fa-send"></i> Save
                </button>
            </div>
        </div>


        <section class="content mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container bg-white my-3">
                            @slot('title')
                            
                            @endslot
                            
                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif
                            <br>
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
                                                <input class="form-check-input" type="checkbox" value="" id="canbesold" name="canbesold">
                                                <label class="form-check-label" for="canbesold">
                                                    Can Be Sold
                                                </label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" value="" id="canbesold" name="canbesold">
                                                <label class="form-check-label" for="canbesold">
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
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">General Information</a>
                                </li>
                            </ul>
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
                                            <input type="number" name="cost" required 
                                            class="input200 {{ $errors->has('cost') ? 'is-invalid':'' }}">
                                            <p class="text-danger">{{ $errors->first('cost') }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">Stock</label>
                                        <div class="wrap-input200 col-sm-5">
                                            <input type="number" name="stock" required readonly value="{{ $product->stock }}"
                                            class="input200 {{ $errors->has('stock') ? 'is-invalid':'' }}">
                                            <p class="text-danger">{{ $errors->first('stock') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-11">
                                    <div class="wrap-input200 mt-4">
                                        <label for="">Internal Note</label>
                                        <textarea name="description" id="description" value="{{ $product->description }}
                                            cols="5" rows="5" placeholder="This note is only for internal purpose"
                                            class="input200 {{ $errors->has('description') ? 'is-invalid':'' }}"></textarea>
                                        <p class="text-danger">{{ $errors->first('description') }}</p>
                                    </div>
                                </div>
                            </div>
                            @slot('footer')
                            
                            @endslot
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection
@extends('layouts.admin')
@section('title','Inventory - Product Categories')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="app-page-title bg-white">
    <div class="o_control_panel">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('product-categories')}}">Product Categories</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div>
    </div>
</div>
<section class="content mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card container">
                    <div class="card-title my-3">
                    Edit Categories
                    </div>
                    
                    @if (session('error'))
                        <div class="alert alert-success">
                        {{ session('error') }}
                        </div>
                    @endif

                    <form role="form" action="{{ route('product-categories.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label for="name">Kategori</label>
                            <input type="text" 
                                name="name"
                                value="{{ $categories->name }}"
                                class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description" cols="5" rows="5" class="form-control {{ $errors->has('description') ? 'is-invalid':'' }}">{{ $categories->description }}</textarea>
                        </div>
                        <input type="hidden" 
                                name="id"
                                value="{{ $categories->id }}"
                                class="form-control {{ $errors->has('id') ? 'is-invalid':'' }}" id="id" required>
                        <div class="card-footer">
                            <button class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
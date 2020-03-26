@extends('layouts.admin')
@section('title','SK - Edit Categories')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Kategori</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('product-categories') }}">Kategori</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
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
    </div>
@endsection
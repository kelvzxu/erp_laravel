@extends('layouts.master')

@section('title')
    <title>Manajemen Produk</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Produk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Produk</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @card
                            @slot('title')
                            <a href="{{ route('produk.create') }}" 
                                class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Tambah
                            </a>
                            @endslot
                            
                            @if (session('success'))
                                @alert(['type' => 'success'])
                                    {!! session('success') !!}
                                @endalert
                            @endif
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Produk</th>
                                            <th>Stok</th>
                                            <th>Harga</th>
                                            <th>Kategori</th>
                                            <th>Last Update</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $row)
                                        <tr>
                                            <td>
                                                @if (!empty($row->photo))
                                                    <img src="{{ asset('uploads/product/' . $row->photo) }}" 
                                                        alt="{{ $row->name }}" width="50px" height="50px">
                                                @else
                                                    <img src="http://via.placeholder.com/50x50" alt="{{ $row->name }}">
                                                @endif
                                            </td>
                                            <td>
                                                <sup class="label label-success">({{ $row->code }})</sup>
                                                <strong>{{ ucfirst($row->name) }}</strong>
                                            </td>
                                            <td>{{ $row->stock }}</td>
                                            <td>Rp {{ number_format($row->price) }}</td>
                                            <td>{{ $row->category->name }}</td>
                                            <td>{{ $row->updated_at }}</td>
                                            <td>
                                                <form action="{{ route('produk.destroy', $row->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <a href="{{ route('produk.edit', $row->id) }}" 
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="float-right">
                                {!! $products->links() !!}
                            </div>
                            @slot('footer')

                            @endslot
                        @endcard
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
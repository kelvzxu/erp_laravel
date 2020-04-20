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
                        <li class="breadcrumb-item"><a href="{{ route('account.index') }}">Chart Of Account</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('account.create')}}">New</a></li>
                    </ol>
                </nav>
            </div>
            <h3>Chart Of Account / *New</h3>
        </div>
    </div>
    <form action="{{ route('account.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container row">
            <div class="col-3">
            <button class="btn btn-primary btn-sm mt-2">
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
                                <div class="col-sm-8">
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">Code</label>
                                        <div class="col-sm-6">
                                            <div class="wrap-input200">
                                                <input type="text" name="code" 
                                                class="input200 {{ $errors->has('code') ? 'is-invalid':'' }}" value="{{ old('code') }}">
                                            </div>
                                            <p class="text-danger">{{ $errors->first('code') }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">Name</label>
                                        <div class="col-sm-6">
                                            <div class="wrap-input200">
                                                <input type="text" name="name" id="name"
                                                class="input200 {{ $errors->has('name') ? 'is-invalid':'' }}" value="{{ old('name') }}" autofocus>
                                            </div>
                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">Type</label>
                                        <div class="col-sm-6">
                                            <div class="wrap-input200">
                                                <select name="type" id="type" style="border:none"
                                                    class="input200 {{ $errors->has('type') ? 'is-invalid':'' }}">
                                                    <option value="">Select Type</option>
                                                    @foreach ($account_type as $row)
                                                        <option value="{{ $row->id }}">{{ ucfirst($row->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <p class="text-danger">{{ $errors->first('type') }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">Internal Type</label>
                                        <div class="col-sm-6">
                                            <div class="wrap-input200">
                                                <input type="text" name="internal_type" 
                                                class="input200 {{ $errors->has('internal_type') ? 'is-invalid':'' }}">
                                            </div>
                                            <p class="text-danger">{{ $errors->first('internal_type') }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">Internal Group</label>
                                        <div class="col-sm-6">
                                            <div class="wrap-input200">
                                                <input type="text" name="internal_group" 
                                                class="input200 {{ $errors->has('internal_group') ? 'is-invalid':'' }}">
                                            </div>
                                            <p class="text-danger">{{ $errors->first('internal_group') }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">Currency</label>
                                        <div class="col-sm-6">
                                            <div class="wrap-input200">
                                                <select name="currency_id" id="currency_id" style="border:none"
                                                    class="input200 {{ $errors->has('currency_id') ? 'is-invalid':'' }}">
                                                    <option value="">Select currency</option>
                                                    @foreach ($currency as $row)
                                                        <option value="{{ $row->id }}">{{ ucfirst($row->currency_name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <p class="text-danger">{{ $errors->first('currency_id') }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-5 col-form-label">Company</label>
                                        <div class="col-sm-6">
                                            <div class="wrap-input200">
                                                <select name="company_id" id="company_id" style="border:none"
                                                    class="input200 {{ $errors->has('company_id') ? 'is-invalid':'' }}">
                                                    <option value="">Select company</option>
                                                    @foreach ($company as $row)
                                                        <option value="{{ $row->id }}">{{ ucfirst($row->company_name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <p class="text-danger">{{ $errors->first('company_id') }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-5">Allow Reconciliation</label>
                                        <div class="col-sm-6">
                                            <input class="form-check-input" type="checkbox" id="reconcile" name="reconcile" value="True">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-5">Deprecated</label>
                                        <div class="col-sm-6">
                                            <input class="form-check-input" type="checkbox" id="deprecated" name="deprecated" value="True">
                                        </div>
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
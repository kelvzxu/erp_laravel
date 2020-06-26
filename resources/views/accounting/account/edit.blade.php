@extends('layouts.admin')
@section('title','Accounting - Account')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<form action="{{ route('account.update', $account->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="app-page-title bg-white">
        <div class="o_control_panel">
            <div>
                <ol class="breadcrumb" role="navigation">
                    <li class="breadcrumb-item" accesskey="b"><a href="{{route('account.index')}}">account</a></li>
                    <li class="breadcrumb-item active">{{$account->name}}</li>
                </ol>
            </div>
            <div>
                <div class="o_cp_left">
                    <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                        <div>
                            <button class="btn btn-primary my-2" @click="create" :disabled="isProcessing">Save</button>
                            <a href="{{route('account.index')}}" class="btn btn-secondary mby-2">Discard</a>
                        </div>
                    </div>
                    <aside class="o_cp_sidebar">
                        <div class="btn-group">
                            <div class="btn-group o_dropdown" style="display: none;">
                                <button class="o_dropdown_toggler_btn btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Print
                                </button>
                                
                                <div class="dropdown-menu o_dropdown_menu" role="menu">
                                        
                                </div>
                            </div>

                            <div class="btn-group o_dropdown">
                                <button class="o_dropdown_toggler_btn btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> 
                                    Action
                                </button>
                                
                                <div class="dropdown-menu o_dropdown_menu" role="menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                                    <button type="button" class="dropdown-item undefined" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-trash"> Delete Record</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
                <div class="o_cp_right">
                    <div class="btn-group o_search_options position-static" role="search"></div>
                    <nav class="o_cp_pager" role="search" aria-label="Pager">
                        <div class="o_pager">
                            <span class="o_pager_counter">
                                <span class="o_pager_value">1</span> / <span class="o_pager_limit">1</span>
                            </span>
                            <span class="btn-group" aria-atomic="true">
                                <button type="button" class="fa fa-chevron-left btn btn-secondary o_pager_previous"
                                    accesskey="p" aria-label="Previous" title="Previous" tabindex="-1" disabled=""></button>
                                <button type="button" class="fa fa-chevron-right btn btn-secondary o_pager_next"
                                    accesskey="n" aria-label="Next" title="Next" tabindex="-1" disabled=""></button>
                            </span>
                        </div>
                    </nav>
                    <nav class="btn-group o_cp_switch_buttons" role="toolbar" aria-label="View switcher"></nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container bg-white my-3">
        <br>
        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <label class="col-sm-5 col-form-label">Code</label>
                    <div class="col-sm-6">
                        <div class="wrap-input200">
                            <input type="text" name="code" value="{{ $account->code }}" readonly
                            class="input200 {{ $errors->has('code') ? 'is-invalid':'' }}" value="{{ old('code') }}">
                        </div>
                        <p class="text-danger">{{ $errors->first('code') }}</p>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-5 col-form-label">Name</label>
                    <div class="col-sm-6">
                        <div class="wrap-input200">
                            <input type="text" name="name" id="name" value="{{ $account->name }}"
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
                                    <option value="{{ $row->id }}" {{ $row->id == $account->type ? 'selected':'' }}>{{ ucfirst($row->name) }}</option>
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
                            <input type="text" name="internal_type" value="{{ $account->internal_type}}"
                            class="input200 {{ $errors->has('internal_type') ? 'is-invalid':'' }}">
                        </div>
                        <p class="text-danger">{{ $errors->first('internal_type') }}</p>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-5 col-form-label">Internal Group</label>
                    <div class="col-sm-6">
                        <div class="wrap-input200">
                            <input type="text" name="internal_group" value="{{ $account->internal_group}}"
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
                                    <option value="{{ $row->id }}"  {{ $row->id == $account->currency_id ? 'selected':'' }}>{{ ucfirst($row->currency_name) }} ({{ ucfirst($row->symbol) }})</option>
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
                                    <option value="{{ $row->id }}"  {{ $row->id == $account->company_id ? 'selected':'' }}>{{ ucfirst($row->company_name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="text-danger">{{ $errors->first('company_id') }}</p>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-5">Allow Reconciliation</label>
                    <div class="col-sm-6">
                        <input class="form-check-input" type="checkbox" id="reconcile" name="reconcile" value="1" @if($account->reconcile == "1" ) checked @endif>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-5">Deprecated</label>
                    <div class="col-sm-6">
                        <input class="form-check-input" type="checkbox" id="deprecated" name="deprecated" value="1" @if($account->deprecated == "1" ) checked @endif>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <br>
</form>
                            
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
$('a#account-config').addClass('mm-active');
$('a#account').addClass('mm-active');
</script>
@endsection
@section('modal')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{asset('images/icons/warning.png')}}" alt=""><br>
                <p class="mb-0">Are you sure to delete this Products record ( {{$account->name}} )</p>
                <p class="mb-0">You won't be able to revert this!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form id="delete-form-{{ $account->id }}" action="{{route('account.destroy', $account->id)}}" method="put">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash">  Delete</i></button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
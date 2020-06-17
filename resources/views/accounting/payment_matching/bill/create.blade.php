@extends('layouts.admin')
@section('title','Payment Invoice')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <div class="app-page-title bg-white">
        <div class="o_control_panel">
            <div>
                <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('payment_bills.index')}}">Payments</a></li>
                    <li class="breadcrumb-item active">Reconcile payments</li>
                </ol>
            </div>
            <div>
                <div class="o_cp_left">
                    <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                        <div>
                            <button class="btn btn-primary my-2" @click="create" :disabled="isProcessing">Save</button>
                            <a href="{{route('purchases')}}" class="btn btn-secondary mby-2">Discard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row o-content">
        <div class="col-12 my-4">
            <div class="o_form_view o_form_editable">
                <div class="clearfix position-relative o_form_sheet">
                    <div class="oe_title ml-3 mt-5">
                        <h1>
                            <span class="o_field_char o_field_widget o_readonly_modifier">{{$data->partner_name}}</span>
                        </h1>
                    </div>
                    <div class="o_group">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('js')
<script src="{{asset('js/asset_common/payment.js')}}"></script>
@endsection
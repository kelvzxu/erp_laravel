@extends('layouts.admin')
@section('title','Home | MyProfile')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<form action="{{route('user_setting.update', $user_access->user_id)}}" method="post" enctype="multipart/form-data">
    @csrf
<div class="app-page-title bg-white">
    <div class="o_control_panel">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('internaluser.index')}}">User Setting</a></li>
                <li class="breadcrumb-item active">{{ $user_access->user->name }}</li>
            </ol>
        </div>
        <div>
            <div class="o_cp_left">
                <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                    <div>
                        <button class="btn btn-primary my-2" @click="create" :disabled="isProcessing">Save</button>
                        <a href="{{route('home')}}" class="btn btn-secondary mby-2">Discard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container bg-white my-3">
    <div class="o_form_view o_form_editable">
        <div class="row">
            <div class="col-sm-10 mt-5">
                <div class="row">
                    <div class="col-sm-6 ml-2">
                        <div class="wrap-input200">
                            <h1>
                                <input type="text" name="name" value="{{ $user_access->user->name }}"
                                    required class="input200 {{ $errors->has('name') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            </h1>
                        </div>
                        <div class="wrap-input200">
                            <input type="text" name="email" value="{{ $user_access->user->email }}"
                                required class="input200 {{ $errors->has('email') ? 'is-invalid':'' }}">
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        </div>        
                    </div>
                </div>
            </div>
            <div class="col-sm-2 text-center d-none d-md-block mt-5 ">
                <img src="{{asset('uploads/Employees/'.$user_access->employee->photo)}}" width=80px height=100px>
            </div>
        </div>
        <div class="o_group">
            <div class="o_notebook mt-3">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a data-toggle="tab" disable_anchor="1" href="#notebook_page_511"
                            class="nav-link active" role="tab" aria-selected="1">Access Right</a></li>
                    <li class="nav-item"><a data-toggle="tab" disable_anchor="1" href="#notebook_page_521"
                            class="nav-link" role="tab">Preference</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="notebook_page_511">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <table class="o_group o_inner_group 0_label_nowrap">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" style="width: 100%;">
                                                <div class="o_horizontal_separator">Users Access</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="User Types" class="col-form-label"><b>User Types</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <select id="user_type" name="user_type" class="input200" style="border:none;">
                                                    @foreach ($type as $row)
                                                    <option value="{{ $row->id }}" {{ $row->id == $user_access->user->user_type ? 'selected':'' }}>
                                                        {{ ucfirst($row->name) }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="User Groups" class="col-form-label"><b>User Groups</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <select id="user_groups" name="user_groups" class="input200" style="border:none;">
                                                    @foreach ($groups as $row)
                                                    <option value="{{ $row->id }}" {{ $row->id == $user_access->user->user_groups ? 'selected':'' }}>
                                                        {{ ucfirst($row->name) }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <table class="o_group o_inner_group 0_label_nowrap">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" style="width: 100%;">
                                                <div class="o_horizontal_separator">Sales Order</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="Sales Order" class="col-form-label"><b>Sales Order</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <input class="o_field_boolean o_field_widget custom-control custom-checkbox" type="checkbox" id="sales" 
                                                name="sales" value="1" @if($user_access->sales == "1" ) checked @endif>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="width: 100%;">
                                                <div class="o_horizontal_separator">Purchases</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="Purchases" class="col-form-label"><b>Purchases</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <input class="o_field_boolean o_field_widget custom-control custom-checkbox" type="checkbox" id="purchase" 
                                                name="purchase" value="1" @if($user_access->purchase == "1" ) checked @endif>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="width: 100%;">
                                                <div class="o_horizontal_separator">Accounting</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="Accounting" class="col-form-label"><b>Accounting</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <input class="o_field_boolean o_field_widget custom-control custom-checkbox" type="checkbox" id="accounting" 
                                                name="accounting" value="1" @if($user_access->accounting == "1" ) checked @endif>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="width: 100%;">
                                                <div class="o_horizontal_separator">Administration</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="Administration" class="col-form-label"><b>Administration</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <input class="o_field_boolean o_field_widget custom-control custom-checkbox" type="checkbox" id="administration" 
                                                name="administration" value="1" @if($user_access->administration == "1" ) checked @endif>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-md-6">
                                <table class="o_group o_inner_group 0_label_nowrap">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" style="width: 100%;">
                                                <div class="o_horizontal_separator">Inventory</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="Inventory" class="col-form-label"><b>Inventory</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <input class="o_field_boolean o_field_widget custom-control custom-checkbox" type="checkbox" id="inventory" 
                                                name="inventory" value="1" @if($user_access->inventory == "1" ) checked @endif>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="width: 100%;">
                                                <div class="o_horizontal_separator">Human Resource</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="Human Resource" class="col-form-label"><b>Human Resource</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <input class="o_field_boolean o_field_widget custom-control custom-checkbox" type="checkbox" id="human_resources" 
                                                name="human_resources" value="1" @if($user_access->human_resources == "1" ) checked @endif>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="width: 100%;">
                                                <div class="o_horizontal_separator">Point Of Sale</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="Point Of Sale" class="col-form-label"><b>Point Of Sale</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <input class="o_field_boolean o_field_widget custom-control custom-checkbox" type="checkbox" id="point_of_sale" 
                                                name="point_of_sale" value="1" @if($user_access->point_of_sale == "1" ) checked @endif>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('js/profile.js')}}"></script>
@endsection

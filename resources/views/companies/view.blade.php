@extends('layouts.admin')
@section('title',"$data->company_name")
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="app-page-title bg-white">
    <div class="o_control_panel mx-0 my-0">
        <div>
            <ol class="breadcrumb" role="navigation">
            <li class="breadcrumb-item" accesskey="b"><a href="{{route('companies.index')}}">Companies</a></li>
                <li class="breadcrumb-item active">{{ $data->company_name }}</li>
            </ol>
            <div class="o_cp_searchview" role="search"></div>
        </div>
        <div>
            <div class="o_cp_left">
                <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                    <div>
                        <div class="o_form_buttons_edit o_hidden" role="toolbar" aria-label="Main actions"
                            data-original-title="" title="">
                            <a type="button" href="{{route('companies.edit', $data)}}" class="btn btn-primary">Edit</a>
                            <a type="button" class="btn btn-secondary" accesskey="c" href="{{route('companies.create')}}">
                                Create
                            </a>
                        </div>
                    </div>
                </div>
                <aside class="o_cp_sidebar">
                    <div class="btn-group">
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
<div class="o_content">
    <div class="o_form_view o_form_editable">
        <div class="o_form_sheet_bg">
            <div class="clearfix o_form_sheet">
                <div class="row">
                    <div class="col-12 col-md-10 mt-3">
                        <div class="row">
                            <div class="col-9">
                                <div class="oe_title">
                                    <label class="o_form_label oe_edit_only">Company Name</label>
                                    <h1>
                                        {{ $data->company_name }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 mt-3">
                        <div class="form-group">
                            <img id='img-upload' src="{{asset('uploads/companies/'.$data->photo)}}" width="50px"/>
                        </div>
                    </div>
                </div>
                <div class="o_notebook">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a data-toggle="tab" disable_anchor="true" href="#notebook_page_533"
                                class="nav-link active" role="tab">General Information</a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="tab" disable_anchor="true" href="#notebook_page_534"
                                class="nav-link" role="tab">Social Media</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="notebook_page_533">
                            <div class="o_group">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <table class="o_group o_inner_group">
                                            <tbody>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label class="o_form_label">Address</label></td>
                                                    <td style="width: 100%;">
                                                        <div class="o_address_format">
                                                            <div class="wrap-input200">
                                                                {{ $data->street }} &nbsp;
                                                            </div>
                                                            <div class="wrap-input200">
                                                                {{ $data->street2 }} &nbsp;
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="wrap-input200">
                                                                        {{ $data->city }}  &nbsp;
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="wrap-input200">
                                                                        {{ $data->zip }}  &nbsp;
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if ($data->country_id != "")
                                                                <div class="wrap-input200">
                                                                    {{$data->country->country_name}}
                                                                </div>
                                                            @endif
                                                            @if ($data->state_id != "")
                                                                <div class="wrap-input200">
                                                                    {{$data->state->state_name}}    
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label class="o_form_label">Phone</label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            {{$data->Phone}}  &nbsp;
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label class="o_form_label">Email</label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            {{$data->email}}  &nbsp;
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label class="o_form_label">Website</label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <a href="https://{{$data->website}}">{{$data->website}} &nbsp;</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <table class="o_group o_inner_group ">
                                            <tbody>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label class="o_form_label">VAT</label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            {{$data->vat}} &nbsp;
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label class="o_form_label">Company Registry</label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            {{$data->company_registry}} &nbsp;
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label class="o_form_label o_required_modifier">Currency</label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        @if ($data->currency_id != "")
                                                            <div class="wrap-input200">
                                                                {{$data->currency->currency_name}}    
                                                            </div>
                                                            @else
                                                            <div class="wrap-input200">
                                                                &nbsp;   
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label class="o_form_label">Parent Company</label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        @if ($data->parent_id != "")
                                                            <div class="wrap-input200">
                                                                {{$data->parent->company_name}}    
                                                            </div>
                                                        @else
                                                            <div class="wrap-input200">
                                                                {{$data->company_name}}    
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="notebook_page_534">
                            <div class="o_group">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <table class="o_group o_inner_group ">
                                            <tbody>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label class="o_form_label">Social Twitter</label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <a href="https://{{$data->social_twitter}}">{{$data->social_twitter}} &nbsp;</a> 
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label class="o_form_label">Social Facebook</label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <a href="https://{{$data->social_facebook}}">{{$data->social_facebook}} &nbsp;</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label class="o_form_label">Social Instagram</label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                        <a href="https://{{$data->social_instagram}}">{{$data->social_instagram}} &nbsp;</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label class="o_form_label">Social Youtube</label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                        <a href="https://{{$data->social_youtube}}">{{$data->social_youtube}} &nbsp;</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label class="o_form_label">Social Linkedin</label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <a href="https://{{$data->social_linkedid}}">{{$data->social_linkedid}} &nbsp;</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label class="o_form_label">Social Github</label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <a href="https://{{$data->social_github}}">{{$data->social_github}} &nbsp;</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Something Went Wrong</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{asset('images/icons/warning.png')}}" alt=""><br>
                <p class="mb-0">The operation cannot be completed: another model requires the record being deleted. If possible, archive it instead. </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
$('a#companies').addClass('mm-active');
</script>
<script src="{{asset('js/ajax.js')}}"></script>
@endsection
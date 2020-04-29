@extends('layouts.admin')
@section('title','SK - Product Managements')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="app-page-title bg-white">
    <div class="o_control_panel mx-0 my-0">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item"><a href="#">Job Positions</a></li>
                <li class="breadcrumb-item" accesskey="b"><a href="#">Applications</a></li>
                <li class="breadcrumb-item active">Advertisement</li>
            </ol>
            <div class="o_cp_searchview" role="search"></div>
        </div>
        <div>
            <div class="o_cp_left">
                <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                    <div>
                        <div class="o_form_buttons_view" role="toolbar" aria-label="Main actions">
                            <button type="button" class="btn btn-primary o_form_button_edit" accesskey="a">
                                Edit
                            </button>
                            <button type="button" class="btn btn-secondary o_form_button_create" accesskey="c">
                                Create
                            </button>
                        </div>
                        <div class="o_form_buttons_edit o_hidden" role="toolbar" aria-label="Main actions"
                            data-original-title="" title="">
                            <button type="button" class="btn btn-primary o_form_button_save" accesskey="s">
                                Save
                            </button>
                            <button type="button" class="btn btn-secondary o_form_button_cancel" accesskey="j">
                                Discard
                            </button>
                        </div>
                    </div>
                </div>
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
@endsection
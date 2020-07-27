@extends('layouts.admin')
@section('title','Companies')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<form action="{{ route('companies.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="app-page-title bg-white">
        <div class="o_control_panel mx-0 my-0">
            <div>
                <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('companies.index')}}">Companies</a></li>
                    <li class="breadcrumb-item active">New</li>
                </ol>
                <div class="o_cp_searchview" role="search"></div>
            </div>
            <div>
                <div class="o_cp_left">
                    <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                        <div>
                            <div class="o_form_buttons_edit o_hidden" role="toolbar" aria-label="Main actions"
                                data-original-title="" title="">
                                <button type="submit" class="btn btn-primary o_form_button_save" accesskey="s">
                                    Save
                                </button>
                                <a href="{{route('companies.index')}}" class="btn btn-secondary mby-2">Discard</a>
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
                                            <div class="o_field_partner_autocomplete dropdown open o_field_widget o_required_modifier">
                                                <input class="o_input" placeholder="" type="text" id="company_name" name="company_name" required>
                                            </div>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 mt-3">
                            <div class="form-group">
                                <img id='img-upload' src="{{asset('images/icons/picture.png')}}" width="50px"/>
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
                                                                    <input class="input200 " name="street" value="{{ old('street') }}" 
                                                                        placeholder="Street..." type="text" id="street" >
                                                                </div>
                                                                <div class="wrap-input200">
                                                                    <input class="input200" value="{{ old('street2') }}"
                                                                        name="street2" placeholder="Street 2..." type="text" id="street2">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="wrap-input200">
                                                                            <input class="input200" value="{{ old('city') }}"
                                                                                name="city" placeholder="City..." type="text" id="city">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="wrap-input200">
                                                                            <input class="input200" value="{{ old('zip') }}"
                                                                                name="zip" placeholder="ZIP" type="text" id="zip">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="wrap-input200">
                                                                    <select id="country" name="country_id" class="input200" style="border:none;">
                                                                        <option value="">country</option>
                                                                    </select>
                                                                </div>
                                                                <div class="wrap-input200">
                                                                    <select id="state" name="state_id" class="input200" style="border:none;">
                                                                        <option value="">State</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="o_td_label">
                                                            <label class="o_form_label">Phone</label>
                                                        </td>
                                                        <td style="width: 100%;">
                                                            <div class="wrap-input200">
                                                                <input class="input200" value="{{ old('Phone') }}"
                                                                    name="Phone" type="text" id="Phone">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="o_td_label">
                                                            <label class="o_form_label">Email</label>
                                                        </td>
                                                        <td style="width: 100%;">
                                                            <div class="wrap-input200">
                                                                <input class="input200" value="{{ old('email') }}"
                                                                    name="email" type="Email" id="email">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="o_td_label">
                                                            <label class="o_form_label">Website</label>
                                                        </td>
                                                        <td style="width: 100%;">
                                                            <div class="wrap-input200">
                                                                <input class="input200" value="{{ old('website') }}"
                                                                    name="website" placeholder="e.g. https://www.mycompany.com" type="text" id="website">
                                                            </div>
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
                                                                <input class="input200" value="{{ old('vat') }}"
                                                                    name="vat" type="text" id="vat">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="o_td_label">
                                                            <label class="o_form_label">Company Registry</label>
                                                        </td>
                                                        <td style="width: 100%;">
                                                            <div class="wrap-input200">
                                                                <input class="input200" value="{{ old('company_registry') }}"
                                                                    name="company_registry" type="text" id="company_registry">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="o_td_label">
                                                            <label class="o_form_label o_required_modifier">Currency</label>
                                                        </td>
                                                        <td style="width: 100%;">
                                                            <div class="wrap-input200">
                                                                <select id="currency_id" name="currency_id" class="input200" style="border:none;">
                                                                    <option value="">Currency</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="o_td_label"><label class="o_form_label o_invisible_modifier"
                                                                for="o_field_input_542">Parent Company</label></td>
                                                        <td style="width: 100%;">
                                                            <div class="o_field_widget o_field_many2one o_invisible_modifier"
                                                                aria-atomic="true" name="parent_id">
                                                                <div class="o_input_dropdown">
                                                                    <input type="text" class="o_input ui-autocomplete-input"
                                                                        autocomplete="off" id="o_field_input_542">
                                                                    <a role="button" class="o_dropdown_button"
                                                                        draggable="false"></a>
                                                                </div>
                                                                <button type="button"
                                                                    class="fa fa-external-link btn btn-secondary o_external_button"
                                                                    tabindex="-1" draggable="false" aria-label="External link"
                                                                    title="External link" style="display: none;"></button>
                                                            </div>
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
                                                                <input class="input200" value="{{ old('social_twitter') }}"
                                                                    name="social_twitter" type="text" id="social_twitter">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="o_td_label">
                                                            <label class="o_form_label">Social Facebook</label>
                                                        </td>
                                                        <td style="width: 100%;">
                                                            <div class="wrap-input200">
                                                                <input class="input200" value="{{ old('social_facebook') }}"
                                                                    name="social_facebook" type="text" id="social_facebook">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="o_td_label">
                                                            <label class="o_form_label">Social Instagram</label>
                                                        </td>
                                                        <td style="width: 100%;">
                                                            <div class="wrap-input200">
                                                                <input class="input200" value="{{ old('social_instagram') }}"
                                                                    name="social_instagram" type="text" id="social_instagram">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="o_td_label">
                                                            <label class="o_form_label">Social Youtube</label>
                                                        </td>
                                                        <td style="width: 100%;">
                                                            <div class="wrap-input200">
                                                                <input class="input200" value="{{ old('social_youtube') }}"
                                                                    name="social_youtube" type="text" id="social_youtube">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="o_td_label">
                                                            <label class="o_form_label">Social Linkedin</label>
                                                        </td>
                                                        <td style="width: 100%;">
                                                            <div class="wrap-input200">
                                                                <input class="input200" value="{{ old('social_linkedin') }}"
                                                                    name="social_linkedin" type="text" id="social_linkedin">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="o_td_label">
                                                            <label class="o_form_label">Social Github</label>
                                                        </td>
                                                        <td style="width: 100%;">
                                                            <div class="wrap-input200">
                                                                <input class="input200" value="{{ old('social_github') }}"
                                                                    name="social_github" type="text" id="social_github">
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
</form>
@endsection
@section('js')
<script>
$('a#companies').addClass('mm-active');
</script>
<script src="{{asset('js/ajax.js')}}"></script>
@endsection
@extends('layouts.admin')
@section('title','Human Resource - Employee')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="app-page-title bg-white">
        <div class="o_control_panel">
            <div>
                <ol class="breadcrumb" role="navigation">
                    <li class="breadcrumb-item" accesskey="b"><a href="{{route('employee')}}">Employee</a></li>
                    <li class="breadcrumb-item active">New</li>
                </ol>
            </div>
            <div>
                <div class="o_cp_left">
                    <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                        <div>
                            <button class="btn btn-primary my-2" @click="create" :disabled="isProcessing">Save</button>
                            <a href="{{route('employee')}}" class="btn btn-secondary mby-2">Discard</a>
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

    <div class="container">
        <div class="o_form_view o_form_editable">
            <div class="container-fluid mt-5">
                <div class="clearfix o_form_sheet">
                    <div class="o_not_full oe_button_box mx-0">
                        <button type="button" class="btn oe_stat_button" name="action_view_partner_invoices"
                            context="{'default_partner_id': active_id}">
                            <i class="fa fa-fw o_button_icon fa-pencil-square-o"></i>
                            <div class="o_form_field o_stat_info">
                                <span class="o_stat_value">
                                    <span class="o_field_monetary o_field_number o_field_widget o_readonly_modifier"
                                    name="total_invoiced" data-original-title="" title="">0.00</span>
                                </span>
                                <span class="o_stat_text">Status</span>
                            </div>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <div class="row">
                                <div class="col-9">
                                    <h1>
                                        <div class="o_field_partner_autocomplete dropdown open wrap-input200 o_required_modifier" name="name"
                                            placeholder="Name" data-original-title="" title="">
                                            <input class="input200  @error('name') is-invalid @enderror" placeholder="Name" type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                                        </div>
                                    </h1>
                                    <div class="o_row">
                                        <div class="wrap-input200 " aria-atomic="true" name="Parent_id" placeholder="Company" data-original-title="" title="">
                                            <input type="text" class="input200" placeholder="identification id" autocomplete="off" value="{{ old('identification_id') }}" required name="identification_id" id="identification_id" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
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
                    <div class="o_group">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <table class="o_group o_inner_group">
                                    <tbody>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="address_name" class="col-form-label"><b>Address</b></label>
                                            </td>
                                            <td>
                                                <div class="o_address_format">
                                                    <div class="wrap-input200">
                                                        <input class="input200 " name="street1" required value="{{ old('street1') }}" 
                                                            placeholder="Street..." type="text" id="street1" >
                                                    </div>
                                                    <div class="wrap-input200">
                                                        <input class="input200" value="{{ old('street2') }}"
                                                            name="street2" placeholder="Street 2..." type="text" id="street2">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="wrap-input200">
                                                                <input class="input200" required value="{{ old('city') }}"
                                                                    name="city" placeholder="City..." type="text" id="city">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="wrap-input200">
                                                                <input class="input200" required value="{{ old('zip') }}"
                                                                    name="zip" placeholder="ZIP" type="text" id="zip">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wrap-input200">
                                                        <select id="country" name="country" class="input200" required style="border:none;">
                                                            <option value="">country</option>
                                                        </select>
                                                    </div>
                                                    <div class="wrap-input200">
                                                        <select id="state" name="state" class="input200" style="border:none;">
                                                            <option value="">State</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="date_of_birth" class="col-form-label"><b>Date Of Birth</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="wrap-input200">
                                                    <input type="date" name="birthday" id="birthday" value="{{ old('birthday')}}"
                                                    class="input200  @error('birthday') is-invalid @enderror" placeholder="Date of birth">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="place/country" class="col-form-label"><b>Place / Country Of Birth</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="wrap-input200">
                                                            <input type="text" name="place_of_birth" id="place_of_birth" value="{{ old('place_of_birth') }}"
                                                            class="input200 @error('place_of_birth') is-invalid @enderror" placeholder="Place of birth" autocomplete="place_of_birth" autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="wrap-input200">
                                                            <select name="country_of_birth" id="country_of_birth" required style="border:none;" required
                                                            class="input200 @error('country_of_birth') is-invalid @enderror" autofocus>
                                                                <option value="NULL">Country</option>
                                                            </select>   
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-md-6">
                                <table class="o_group o_inner_group">
                                    <tbody>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="work_email" class="col-form-label"><b>Work Email</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="wrap-input200">
                                                    <input class="input200 " name="work_email" required value="{{ old('work_email') }}" 
                                                        placeholder="work_email@example.com" type="email" id="work_email" required>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="work_phone" class="col-form-label"><b>Work Phone</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="wrap-input200">
                                                    <input class="input200 " name="work_phone" required value="{{ old('work_phone') }}" type="text" id="work_phone" >
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="work_mobile" class="col-form-label"><b>Work Mobile</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                             <div class="wrap-input200">
                                                    <input class="input200 " name="work_mobile" value="{{ old('work_mobile') }}" type="text" id="work_mobile" >
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="work_location" class="col-form-label"><b>Work Location</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="wrap-input200">
                                                    <input class="input200 " name="work_location" value="{{ old('work_location') }}" type="text" id="website" >
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="department" class="col-form-label"><b>Department</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="wrap-input200">
                                                    <select name="department" id="department" class="input200" style="border:none;">
                                                        <option value=""></option>
                                                        @foreach ($departments as $row)
                                                            <option value="{{ $row->id }}">{{ ucfirst($row->department_name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="lag" class="col-form-label"><b>Job Position</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="wrap-input200">
                                                    <select name="jobs" id="jobs" class="input200" style="border:none;">
                                                        <option value=""></option>
                                                        @foreach ($jobs as $row)
                                                            <option value="{{ $row->id }}">{{ ucfirst($row->jobs_name) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="tz/cr" class="col-form-label"><b>Manager</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="wrap-input200">
                                                    <select name="parent_id" id="parent_id" class="input200" style="border:none;">
                                                        <option value=""></option>
                                                            @foreach ($employee as $row)
                                                                <option value="{{ $row->id }}">{{ ucfirst($row->employee_name) }}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="o_notebook">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a data-toggle="tab" disable_anchor="true" href="#notebook_page_511"
                                    class="nav-link active" role="tab" aria-selected="true">Private Information</a></li>
                            <li class="nav-item"><a data-toggle="tab" disable_anchor="true" href="#notebook_page_521"
                                    class="nav-link" role="tab">Work Information</a></li>
                            <li class="nav-item o_invisible_modifier"><a data-toggle="tab" disable_anchor="true"
                                    href="#notebook_page_595" class="nav-link" role="tab">Invoicing</a></li>
                            <li class="nav-item"><a data-toggle="tab" disable_anchor="true" href="#notebook_page_531"
                                    class="nav-link" role="tab">User Account</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="notebook_page_511">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <table class="o_group o_inner_group mt-0">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" style="width: 100%;">
                                                        <div class="o_horizontal_separator">Citizenship</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="nationality" class="col-form-label"><b>Nationality (country)</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <select name="nationality" id="nationality" style="border:none;"
                                                            class="input200 @error('nationality') is-invalid @enderror" autofocus>
                                                                <option value=""></option>
                                                            </select> 
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="Passport_no" class="col-form-label"><b>Passport No</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <input type="text" name="passport_id" id="passport_id" class="input200 @error('passport_id') is-invalid @enderror" 
                                                            value="{{ old('passport_id') }}"  autocomplete="passport_id" autofocus>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="gender" class="col-form-label"><b>Gender</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <select type="text" name="gender" class="input200 @error('gender') is-invalid @enderror"  
                                                            id="gender" placeholder="Gender" style="border:none;" required>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                                <option value="other">Other</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="width: 100%;">
                                                        <div class="o_horizontal_separator">Emergency</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="emergency_contact" class="col-form-label"><b>Emergency Contact</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <input type="text" name="emergency_contact" id="emergency_contact" class="input200 @error('emergency_contact') is-invalid @enderror"
                                                             value="{{ old('emergency_contact') }}"  autocomplete="emergency_contact" autofocus required> 
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="emergency_phone" class="col-form-label"><b>Emergency Phone</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <input type="text" name="emergency_phone" id="emergency_phone" class="input200 @error('emergency_phone') is-invalid @enderror"
                                                             value="{{ old('emergency_phone') }}"  autocomplete="emergency_phone" autofocus required>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="width: 100%;">
                                                        <div class="o_horizontal_separator">Education</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="certificate" class="col-form-label"><b>Certificate</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                        <select type="text" name="certificate" class="input200" style="border:none;" id="certificate" placeholder="certificate">
                                                            <option value="High_School">High School</option>
                                                            <option value="Diploma">Diploma</option>
                                                            <option value="Barchelor">Barchelor</option>
                                                            <option value="Magister">Magister</option>
                                                            <option value="Doctor">Doctor</option>
                                                        </select>                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="Field Of Study" class="col-form-label"><b>Field Of Study</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <input class="input200" name="study_field" value="{{ old('study_field') }}" type="text" id="study_field" >
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="School/University" class="col-form-label"><b>School/University</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <input class="input200" name="study_school" value="{{ old('study_school') }}" type="text" id="study_school" >
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <table class="o_group o_inner_group mt-0">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" style="width: 100%;">
                                                        <div class="o_horizontal_separator">Work Permit</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="visa-no" class="col-form-label"><b>Visa No</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <input type="text" name="visa_no" id="visa_no" value="{{ old('visa_no') }}"
                                                            class="input200 @error('visa_no') is-invalid @enderror"  autocomplete="visa_no" autofocus>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="permit_no" class="col-form-label"><b>Work Permit No</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <input type="text" name="permit_no" id="permit_no" class="input200 @error('permit_no') is-invalid @enderror" 
                                                            value="{{ old('permit_no') }}"  autocomplete="permit_no" autofocus>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="visa_exp" class="col-form-label"><b>Visa Expire</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <input type="date" name="visa_expire" class="input200  @error('visa_expire') is-invalid @enderror" 
                                                            id="visa_expire" placeholder="visa Expire">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="width: 100%;">
                                                        <div class="o_horizontal_separator">Marital Status</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="marital Status" class="col-form-label"><b>Marital Status</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <select type="text" name="marital" class="input200" id="marital" 
                                                            placeholder="marital" style="border:none;">
                                                                <option value="single">Single</option>
                                                                <option value="marriage">Marriage</option>
                                                                <option value="Legal Cohabitant">Legal Cohabitant</option>
                                                                <option value="Widower">Widower</option>
                                                                <option value="Divorced">Divorced</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="marriage" style="display: none;">
                                                    <td class="o_td_label marital">
                                                        <label for="" name="spouse" class="col-form-label"><b>Spouse Complete Name</b></label>
                                                    </td>
                                                    <td>
                                                        <div class="wrap-input200 marital">
                                                            <input type="text" name="spouse_complete_name" class="input200 @error('spouse_complete_name') is-invalid @enderror" 
                                                            value="{{ old('spouse_complete_name') }}" id="spouse_complete_name" autofocus>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="marriage" style="display: none;">
                                                    <td class="o_td_label">
                                                        <label for="" name="SpouseBirthdate" class="col-form-label"><b>Spouse Birthdate</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                        <input type="date" name="spouse_birthday" class="input200  @error('spouse_birthday') is-invalid @enderror" 
                                                        id="spouse_birthday" placeholder="Date of birth">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="width: 100%;">
                                                        <div class="o_horizontal_separator">Dependant</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="Children" class="col-form-label"><b>Number of Children</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <input class="input200" name="children" value="{{ old('children') }}" type="number" id="children" >
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="width: 100%;">
                                                        <div class="o_horizontal_separator">Sosial Media</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="ssnid" class="col-form-label"><b>Sosial Media Account</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <input class="input200" name="ssnid" value="{{ old('ssnid') }}" type="text" id="ssnid" >
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="notebook_page_521">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <table class="o_group o_inner_group mt-0">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" style="width: 100%;">
                                                        <div class="o_horizontal_separator">responsible</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="coach" class="col-form-label"><b>Coach</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <select name="coach_id" id="coach_id" class="input200" style="border:none;">
                                                                <option value=""></option>
                                                                @foreach ($employee as $row)
                                                                    <option value="{{ $row->id }}">{{ ucfirst($row->employee_name) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="width: 100%;">
                                                        <div class="o_horizontal_separator">Bank Accounts</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="currency" class="col-form-label"><b>Currency</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <select id="currency_id" name="currency_id" class="input200" style="border:none;">
                                                                <option value="NULL">Currency</option>
                                                                @foreach ($currency as $row)
                                                                <option value="{{ $row->id }}">
                                                                    {{ ucfirst($row->currency_name) }} ( {{ ucfirst($row->symbol) }} )
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="bank_account" class="col-form-label"><b>Bank Account</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <input class="input200" name="Bank_account_id" value="{{ old('Bank_account_id') }}" type="text" id="Bank_account_id" >
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="width: 100%;">
                                                        <div class="o_horizontal_separator">Salary</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="salary" class="col-form-label"><b>Salary</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <input class="input200" name="salary" value="{{ old('salary') }}" type="text" id="salary" >
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="notebook_page_531">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <table class="o_group o_inner_group mt-0">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" style="width: 100%;">
                                                        <div class="o_horizontal_separator">User Password</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="password" class="col-form-label"><b>{{ __('Password') }}</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <input id="password" type="password" class="input200 @error('password') is-invalid @enderror" 
                                                            name="password" required autocomplete="new-password" required>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="coach" class="col-form-label"><b>{{ __('Confirm Password') }}</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <input id="password-confirm" type="password" class="input200" required
                                                             name="password_confirmation" required autocomplete="new-password">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="width: 100%;">
                                                        <div class="o_horizontal_separator">Access</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="bank_account" class="col-form-label"><b>User Access</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <select name="access" id="access" class="input200" style="border:none;">
                                                                <option value=""></option>
                                                            </select>                                                        
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
</form>
@endsection
@section('js')
<script src="{{asset('js/ajax.js')}}"></script>
<script src="{{asset('js/asset_common/employee.js')}}"></script>
@endsection

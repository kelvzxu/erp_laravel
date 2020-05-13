@extends('layouts.admin')
@section('title','SK - Employee')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<form action="{{ route('employee.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{$hr_employee -> id}}">
    <div class="app-page-title bg-white">
        <div class="o_control_panel">
            <div>
                <ol class="breadcrumb" role="navigation">
                    <li class="breadcrumb-item" accesskey="b"><a href="{{route('employee')}}">Employee</a></li>
                    <li class="breadcrumb-item active">{{ $hr_employee->employee_name }}</li>
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
                                            <input class="input200  @error('name') is-invalid @enderror" placeholder="Name" type="text" id="name" name="name" value="{{ $hr_employee->employee_name }}" required autofocus>
                                        </div>
                                    </h1>
                                    <div class="o_row">
                                        <div class="wrap-input200 " aria-atomic="true" name="Parent_id" placeholder="Company" data-original-title="" title="">
                                            <input type="text" class="input200" placeholder="identification id" autocomplete="off" value="{{ $hr_employee->identification_id }}" required name="identification_id" id="identification_id" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <img id='img-upload' src="{{asset('uploads/Employees/'.$hr_employee->photo)}}" width="50px"/>
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
                                                        <input class="input200 " name="street1" required value="{{ $hr_employee->address }}" 
                                                            placeholder="Street..." type="text" id="street1" >
                                                    </div>
                                                    <div class="wrap-input200">
                                                        <input class="input200" value="{{ $hr_employee->street }}"
                                                            name="street2" placeholder="Street 2..." type="text" id="street2">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="wrap-input200">
                                                                <input class="input200" required value="{{ $hr_employee->city }}"
                                                                    name="city" placeholder="City..." type="text" id="city">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="wrap-input200">
                                                                <input class="input200" required value="{{ $hr_employee->zip }}"
                                                                    name="zip" placeholder="ZIP" type="text" id="zip">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="wrap-input200">
                                                        <select id="country" name="country" class="input200" required style="border:none;">
                                                            <option value="">country</option>
                                                            @foreach ($country as $row)
                                                                <option value="{{ $row->id }}" {{ $row->id == $hr_employee -> country_id ? 'selected':'' }}>
                                                                    {{ ucfirst($row->country_name) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="wrap-input200">
                                                        <select id="state" name="state" class="input200" style="border:none;">
                                                            <option value="">State</option>
                                                            @foreach ($state as $row)
                                                                <option value="{{ $row->id }}" {{ $row->id == $hr_employee -> state_id ? 'selected':'' }}>
                                                                    {{ ucfirst($row->state_name) }}
                                                                </option>
                                                            @endforeach
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
                                                    <input type="date" name="birthday" id="birthday" value="{{ $hr_employee->birthday}}"
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
                                                            <input type="text" name="place_of_birth" id="place_of_birth" value="{{ $hr_employee->place_of_birth }}"
                                                            class="input200 @error('place_of_birth') is-invalid @enderror" placeholder="Place of birth" autocomplete="place_of_birth" autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="wrap-input200">
                                                            <select name="country_of_birth" id="country_of_birth" style="border:none;" required
                                                            class="input200 @error('country_of_birth') is-invalid @enderror" autofocus>
                                                                <option value="NULL">Country</option>
                                                                @foreach ($country as $row)
                                                                    <option value="{{ $row->id }}" {{ $row->id == $hr_employee -> country_of_birth ? 'selected':'' }}>
                                                                        {{ ucfirst($row->country_name) }}
                                                                    </option>
                                                                @endforeach
                                                                le('image')->getClientOriginalName();
                $nama_file = time()                      </select>   
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
                                                    <input class="input200 " name="work_email" required value="{{ $hr_employee->work_email }}" 
                                                        placeholder="work_email@example.com" type="text" id="work_email" required>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="work_phone" class="col-form-label"><b>Work Phone</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="wrap-input200">
                                                    <input class="input200 " name="work_phone" required value="{{ $hr_employee->work_phone }}" type="text" id="work_phone" >
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="work_mobile" class="col-form-label"><b>Work Mobile</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="wrap-input200">
                                                    <input class="input200 " name="work_mobile" value="{{ $hr_employee->mobile_phonee }}" type="text" id="work_mobile" >
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="o_td_label">
                                                <label for="" name="work_location" class="col-form-label"><b>Work Location</b></label>
                                            </td>
                                            <td style="width: 100%;">
                                                <div class="wrap-input200">
                                                    <input class="input200 " name="work_location" value="{{ $hr_employee->work_location }}" type="text" id="website" >
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
                                                            <option value="{{ $row->id }}" {{ $row->id == $hr_employee -> department_id ? 'selected':'' }}>
                                                                {{ ucfirst($row->department_name) }}
                                                            </option>
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
                                                            <option value="{{ $row->id }}" {{ $row->id == $hr_employee -> job_id ? 'selected':'' }}>
                                                                {{ ucfirst($row->jobs_name) }}
                                                            </option>
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
                                                            <option value="{{ $row->id }}" {{ $row->id == $hr_employee -> parent_id ? 'selected':'' }}>
                                                                {{ ucfirst($row->employee_name) }}
                                                            </option>
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
                                                                @foreach ($country as $row)
                                                                    <option value="{{ $row->id }}" {{ $row->id == $hr_employee -> nationality ? 'selected':'' }}>
                                                                        {{ ucfirst($row->country_name) }}
                                                                    </option>
                                                                @endforeach
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
                                                            value="{{ $hr_employee->passport_id }}"  autocomplete="passport_id" autofocus>
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
                                                                <option value="male" @if($hr_employee->gender == "male" ) selected="selected" @endif>Male</option>
                                                                <option value="female" @if($hr_employee->gender == "female" ) selected="selected" @endif>Female</option>
                                                                <option value="other" @if($hr_employee->gender == "other" ) selected="selected" @endif>Other</option>
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
                                                             value="{{ $hr_employee->emergency_contact }}"  autocomplete="emergency_contact" autofocus required> 
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
                                                             value="{{ $hr_employee->emergency_phone }}"  autocomplete="emergency_phone" autofocus required>
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
                                                            <option value="High_School" @if($hr_employee->certificate == "High_School" ) selected="selected" @endif>High School</option>
                                                            <option value="Diploma" @if($hr_employee->certificate == "Diploma" ) selected="selected" @endif>Diploma</option>
                                                            <option value="Barchelor" @if($hr_employee->certificate == "Barchelor" ) selected="selected" @endif>Barchelor</option>
                                                            <option value="Magister" @if($hr_employee->certificate == "Magister" ) selected="selected" @endif>Magister</option>
                                                            <option value="Doctor" @if($hr_employee->certificate == "Doctor" ) selected="selected" @endif>Doctor</option>
                                                        </select>                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="Field Of Study" class="col-form-label"><b>Field Of Study</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <input class="input200" name="study_field" value="{{ $hr_employee->study_field }}" type="text" id="study_field" >
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="o_td_label">
                                                        <label for="" name="School/University" class="col-form-label"><b>School/University</b></label>
                                                    </td>
                                                    <td style="width: 100%;">
                                                        <div class="wrap-input200">
                                                            <input class="input200" name="study_school" value="{{ $hr_employee->study_school }}" type="text" id="study_school" >
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
                                                            <input type="text" name="visa_no" id="visa_no" value="{{ $hr_employee->visa_no }}"
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
                                                            value="{{ $hr_employee->permit_no }}"  autocomplete="permit_no" autofocus>
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
                                                            id="visa_expire" placeholder="visa Expire" value="{{ $hr_employee->visa_expire }}" >
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
                                                                <option value="single" @if($hr_employee->marital == "single" ) selected="selected" @endif>Single</option>
                                                                <option value="marriage" @if($hr_employee->marital == "marriage" ) selected="selected" @endif>Marriage</option>
                                                                <option value="Legal Cohabitant" @if($hr_employee->marital == "Legal Cohabitant" ) selected="selected" @endif>Legal Cohabitant</option>
                                                                <option value="Widower" @if($hr_employee->marital == "Widower" ) selected="selected" @endif>Widower</option>
                                                                <option value="Divorced" @if($hr_employee->marital == "Divorced" ) selected="selected" @endif>Divorced</option>
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
                                                            value="{{ $hr_employee->spouse_complete_name }}" id="spouse_complete_name" autofocus>
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
                                                        id="spouse_birthday" placeholder="Date of birth" value="{{ $hr_employee->spouse_birthdate }}" >
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
                                                            <input class="input200" name="children" value="{{ $hr_employee->children }}" type="number" id="children" >
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
                                                            <input class="input200" name="ssnid" value="{{ $hr_employee->ssnid }}" type="text" id="ssnid" >
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
                                                                    <option value="{{ $row->id }}" {{ $row->id == $hr_employee -> coach_id ? 'selected':'' }}>
                                                                        {{ ucfirst($row->employee_name) }}
                                                                    </option>
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
                                                                <option value="{{ $row->id }}" {{ $row->id == $hr_employee -> currency_id ? 'selected':'' }}>
                                                                    {{ ucfirst($row->currency_name) }}
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
                                                            <input class="input200" name="Bank_account_id" value="{{ $hr_employee->bank_account_id }}" type="text" id="Bank_account_id" >
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
                                                            <input class="input200" name="salary" value="{{ $hr_employee->salary }}" type="text" id="salary" >
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
@include('api.api')
<script src="{{asset('js/employee.js')}}"></script>
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
                <p class="mb-0">Are you sure to delete the customer's record ( {{$hr_employee->employee_name}} )</p>
                <p class="mb-0">You won't be able to revert this!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn-warning" role="menuitem" data-section="other" data-index="2" href="{{ route('employee.delete', $hr_employee -> id) }}" >
                    <i class="fa fa-trash"> Delete Record</i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')
@section('title','Home | MyProfile')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<form action="profile.update" method="post" enctype="multipart/form-data">
    @csrf
<div class="app-page-title bg-white">
    <div class="o_control_panel">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('profile')}}">My Profile</a></li>
                <li class="breadcrumb-item active">{{ $profile->employee_name }}</li>
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
<div class="content mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="container bg-white my-3">
                    <div class="row">
                        <div class="col-sm-10 mt-5">
                            <div class="row">
                                <div class="col-sm-6 ml-2">
                                    <div>
                                        <h1>{{ $profile->employee_name }}</h1>
                                    </div>
                                    <div class="wrap-input200">
                                        <input type="text" name="name" value="{{ $profile->jobs_name }}" readonly
                                            class="input200 {{ $errors->has('name') ? 'is-invalid':'' }}">
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    </div>        
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 text-center d-none d-md-block mt-5 ">
                            <img src="{{asset('uploads/Employees/'.$profile->photo)}}" width=60px>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <label class="col-sm-5 col-form-label">Work Mobile</label>
                                <div class="wrap-input200 col-sm-6">
                                    <input type="text" name="work_mobile" id="work_mobile"
                                    class="input200 {{ $errors->has('mobile_phonee') ? 'is-invalid':'' }}" value="{{ $profile->mobile_phonee}}" autofocus>
                                    <p class="text-danger">{{ $errors->first('mobile_phonee') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-5 col-form-label">Work Phone</label>
                                <div class="wrap-input200 col-sm-6">
                                    <input type="text" name="work_phone" id="work_phone" maxlength="10" 
                                    class="input200 {{ $errors->has('work_phone') ? 'is-invalid':'' }}" value="{{ $profile->work_phone}}" autofocus>
                                    <p class="text-danger">{{ $errors->first('work_phone') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Work Email</label>
                                <div class="wrap-input200 col-sm-6">
                                    <input type="text" name="work_email"  value="{{$profile->work_email}}" required 
                                    class="input200 {{ $errors->has('work_email') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('work_email') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Work Location</label>
                                <div class="wrap-input200 col-sm-6">
                                    <input type="text" name="work_location"  value="{{$profile->work_location}}" required 
                                    class="input200 {{ $errors->has('work_location') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('work_location') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs mt-3">
                        <li class="nav-item">
                            <a class="nav-link active work_information" href="#">Work Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link private_information" href="#">Private Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link preference" href="#">Preference</a>
                        </li>
                    </ul>
                    <section id="work_information">
                    <div class="row ml-1">
                        <div class="col-sm-9">
                            <h5 class="text-primary">Location</h5>
                            <div class="row mt-1">
                                <label class="col-sm-3 col-form-label">Department</label>
                                <div class="wrap-input200 col-sm-6">
                                    <input type="text" value="{{ $profile->department_name }}" readonly
                                    class="input200 {{ $errors->has('department_id') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('department_id') }}</p>
                                </div>
                            </div>
                            <h5 class="text-primary">Responsibles</h5>
                            <div class="row mt-1">
                                <label class="col-sm-3 col-form-label">Manager</label>
                                <div class="wrap-input200 col-sm-6">
                                    <select name="parent_id" id="parent_id" style="border:none"
                                    disabled class="input200 {{ $errors->has('parent_id') ? 'is-invalid':'' }}">
                                        <option value="">Select Manager</option>
                                        @foreach ($employee as $row)
                                            <option value="{{ $row->id }}" {{ $row->id == $profile -> parent_id ? 'selected':'' }}>
                                                {{ ucfirst($row->employee_name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('parent_id') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3 col-form-label">Coach</label>
                                <div class="wrap-input200 col-sm-6">
                                    <select name="coach_id" id="coach_id" style="border:none"
                                    disabled class="input200 {{ $errors->has('coach_id') ? 'is-invalid':'' }}">
                                        <option value="">Select Manager</option>
                                        @foreach ($employee as $row)
                                            <option value="{{ $row->id }}" {{ $row->id == $profile -> coach_id ? 'selected':'' }}>
                                                {{ ucfirst($row->employee_name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('coach_id') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3 col-form-label">Time Off</label>
                                <div class="wrap-input200 col-sm-6">
                                    <input type="text" value="HR department" readonly
                                    class="input200 {{ $errors->has('department_id') ? 'is-invalid':'' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    </section>
                    <section id="private_information">
                    <div class="row ml-1">
                        <div class="col-sm-6">
                            <h5 class="text-primary">Citizenship</h5>
                            <div class="row mt-1">
                                <label class="col-sm-4 col-form-label">Employee Country</label>
                                <div class="wrap-input200 col-sm-6">
                                    <select name="country" id="country" style="border:none"
                                            class="input200 {{ $errors->has('country') ? 'is-invalid':'' }}">
                                        <option value="">Select Manager</option>
                                        @foreach ($country as $row)
                                            <option value="{{ $row->id }}" {{ $row->id == $profile -> country_id ? 'selected':'' }}>
                                                {{ ucfirst($row->country_name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('country') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Identification No</label>
                                <div class="wrap-input200 col-sm-6">
                                    <input type="text" name="identification_id" id="identification_id" value="{{ $profile->identification_id }}"
                                    class="input200 {{ $errors->has('identification_id') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('identification_id') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Passport No</label>
                                <div class="wrap-input200 col-sm-6">
                                    <input type="text" name="passport_id" id="passport_id" value="{{ $profile->passport_id }}" 
                                    class="input200 {{ $errors->has('passport_id') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('passport_id') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Gender</label>
                                <div class="wrap-input200 col-sm-6">
                                    <select name="gender" id="gender" style="border:none"
                                        readonly class="input200 {{ $errors->has('gender') ? 'is-invalid':'' }}">
                                        <option value="{{ $profile->gender }}"> {{ $profile->gender }}</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('gender') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Date of Birth</label>
                                <div class="wrap-input200 col-sm-6">
                                    <input type="text" name="birthday" id="birthday" value="{{ $profile->birthday }}"
                                    class="input200 {{ $errors->has('birthday') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('birthday') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Place of Birth</label>
                                <div class="wrap-input200 col-sm-6">
                                    <input type="text" name="place_of_birth" id="place_of_birth" value="{{ $profile->place_of_birth }}"
                                    class="input200 {{ $errors->has('place_of_birth') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('place_of_birth') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Country of Birth</label>
                                <div class="wrap-input200 col-sm-6">
                                    <select name="country_of_birth" id="country_of_birth" style="border:none"
                                            class="input200 {{ $errors->has('country_of_birth') ? 'is-invalid':'' }}">
                                        <option value="">Select Manager</option>
                                        @foreach ($country as $row)
                                            <option value="{{ $row->id }}" {{ $row->id == $profile -> country_of_birth ? 'selected':'' }}>
                                                {{ ucfirst($row->country_name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('country') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                        <h5 class="text-primary">Work Permit</h5>
                            <div class="row mt-1">
                                <label class="col-sm-4 col-form-label">Visa No</label>
                                <div class="wrap-input200 col-sm-6">
                                    <input type="text" name="visa_no" id="visa_no" value="{{ $profile->visa_no }}"
                                    class="input200 {{ $errors->has('visa_no') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('visa_no') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Work Permit No</label>
                                <div class="wrap-input200 col-sm-6">
                                    <input type="text" name="permit_no" id="permit_no" value="{{ $profile->permit_no }}"
                                    class="input200 {{ $errors->has('permit_no') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('permit_no') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Visa Expire Date</label>
                                <div class="wrap-input200 col-sm-6">
                                    <input type="date" name="visa_expire" id="visa_expire" value="{{ $profile->visa_expire }}"
                                    class="input200 {{ $errors->has('visa_expire') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('visa_expire') }}</p>
                                </div>
                            </div>
                            <h5 class="mt-2 text-primary">emergency </h5>
                            <div class="row mt-1">
                                <label class="col-sm-4 col-form-label">Emergency Contact</label>
                                <div class="wrap-input200 col-sm-6">
                                    <input type="text" name="emergency_contact" id="emergency_contact" value="{{ $profile->emergency_contact }}"
                                    class="input200 {{ $errors->has('emergency_contact') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('emergency_contact') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Emergency Phone</label>
                                <div class="wrap-input200 col-sm-6">
                                    <input type="text" name="emergency_phone" id="emergency_phone" value="{{ $profile->emergency_phone }}"
                                    class="input200 {{ $errors->has('emergency_phone') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('emergency_phone') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ml-1">
                        <div class="col-sm-6 mt-2">
                        <h5 class="text-primary">Education</h5>
                            <div class="row mt-1">
                                <label class="col-sm-4 col-form-label">Certificate level</label>
                                <div class="wrap-input200 col-sm-6">
                                    <select name="certificate" id="certificate" style="border:none"
                                        readonly class="input200 {{ $errors->has('certificate') ? 'is-invalid':'' }}">
                                        <option value="{{ $profile->certificate }}"> {{ $profile->certificate }}</option>
                                        <option value="High_School">High School</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="Barchelor">Barchelor</option>
                                        <option value="Magister">Magister</option>
                                        <option value="Doctor">Doctor</option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('country') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Field of Study</label>
                                <div class="wrap-input200 col-sm-6">
                                    <input type="text" name="study_field" id="study_field" value="{{ $profile->study_field }}"
                                    class="input200 {{ $errors->has('study_field') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('study_field') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 col-form-label">School</label>
                                <div class="wrap-input200 col-sm-6">
                                    <input type="text" name="study_school" id="study_school" value="{{ $profile->study_school }}"
                                    class="input200 {{ $errors->has('study_school') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('study_school') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </section>
                    <section id="preference">
                    <div class="row ml-1">
                        <div class="col-sm-6">
                            <div class="row mt-1">
                                <label class="col-sm-4 col-form-label">Language</label>
                                <div class="wrap-input200 col-sm-8">
                                    <select name="lang" id="lang" style="border:none"
                                            class="input200 {{ $errors->has('lang') ? 'is-invalid':'' }}">
                                        <option value="">Select Manager</option>
                                        @foreach ($lang as $row)
                                            <option value="{{ $row->id }}" {{ $row->id == 37 ? 'selected':'' }}>
                                                {{ ucfirst($row->lang_name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('country') }}</p>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <label class="col-sm-4 col-form-label">TimeZone</label>
                                <div class="wrap-input200 col-sm-8">
                                    <select name="tz" id="tz" style="border:none"
                                            class="input200 {{ $errors->has('tz') ? 'is-invalid':'' }}">
                                        <option value="">Select Manager</option>
                                        @foreach ($tz as $row)
                                            <option value="{{ $row->timezone }}" {{ $row->timezone == 'Asia/Jakarta' ? 'selected':'' }}>
                                                {{ ucfirst($row->timezone) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('country') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </section>     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('js/profile.js')}}"></script>
@endsection

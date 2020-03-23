@extends('layouts.admin')
@section('title','SK - New Customer')
@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
        {{ session('status') }}
        </div>
    @endif
    <!-- header -->
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('employee')}}">employee</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('employee.new')}}">New</a></li>
                    </ol>
                </nav>
            </div>
            <h3>Create New employee</h3>
        </div>
        <div class="col-12 col-md-5 text-right">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search...." aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </div>
        </div>
    </div>
    <!-- header button -->
    <div class="row">
        <div class="col-3">
            <a href="" class="btn btn-primary">Save</a>
        </div>
    </div>

    <div class="container bg-white my-4">
        <br>
        <form>
            <div class="row">
                <div class="col-sm-9">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            active
                        </label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="name" placeholder="Employee Name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"  autocomplete="name" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Identification id</label>
                        <div class="col-sm-10">
                            <input type="text" name="identification_id" id="identification_id" class="form-control @error('identification_id') is-invalid @enderror" value="{{ old('identification_id') }}"  autocomplete="identification_id" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-4">
                            <select type="text" name="gender" class="form-control" id="gender" placeholder="Gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label">Marital</label>
                        <div class="col-sm-4">
                            <select type="text" name="marital" class="form-control" id="marital" placeholder="marital">
                                <option value="single">Single</option>
                                <option value="marriage">Marriage</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div id="marriage" style="display: none">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">couple's name</label>
                            <div class="col-sm-10">
                                <input type="text" name="spouse_complete_name" id="spouse_complete_name" class="form-control @error('spouse_complete_name') is-invalid @enderror" value="{{ old('spouse_complete_name') }}"  autocomplete="Identification id" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Couple's Birth</label>
                            <div class="col-sm-4">
                                <input type="date" name="spouse_birthday" class="form-control" id="spouse_birthday" placeholder="Date of birth">
                            </div>
                            <label class="col-sm-2 col-form-label">children</label>
                            <div class="col-sm-4">
                            <select type="text" name="children" class="form-control" id="children" placeholder="children">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="<5"><= 5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Place Of Birth</label>
                        <div class="col-sm-10">
                            <input type="text" name="place_og_birth" id="place_og_birth" class="form-control @error('place_og_birth') is-invalid @enderror" value="{{ old('place_og_birth') }}"  autocomplete="place_of_birth" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Date Of Birth</label>
                        <div class="col-sm-4">
                        <input type="date" name="birthday" class="form-control" id="birthday" placeholder="Date of birth">
                        </div>
                        <label class="col-sm-2 col-form-label">Country Of Birth</label>
                        <div class="col-sm-4">
                            <select name="country_of_birth" id="country_of_birth" class="form-control @error('country_of_birth') is-invalid @enderror" autofocus></select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <img id='img-upload'/>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file bg-primary text-white">
                                    Browse… <input type="file" id="imgInp">
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                            <input type="text" name="address" id="address" placeholder="Address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}"  autocomplete="address" autofocus>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Work Email</label>
                        <div class="col-sm-9">
                            <input type="work_email" name="work_email" id="work_email" placeholder="mail@example.com" class="form-control @error('work_email') is-invalid @enderror" value="{{ old('work_email') }}"  autocomplete="work_email" autofocus>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Street</label>
                        <div class="col-sm-5">
                            <input type="text" name="street1" id="street1" placeholder="street" class="form-control @error('street') is-invalid @enderror" value="{{ old('street') }}"  autocomplete="street" autofocus>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="street2" id="street2" placeholder="street 2" class="form-control @error('street2') is-invalid @enderror" value="{{ old('street2') }}"  autocomplete="street2" autofocus>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">work Mobile</label>
                        <div class="col-sm-9">
                            <input type="text" name="work_mobile" id="work_mobile" placeholder="08xxxxxxxxx" class="form-control @error('work_mobile') is-invalid @enderror" value="{{ old('work_mobile') }}"  autocomplete="work_mobile" autofocus>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Country</label>
                        <div class="col-sm-5">
                            <select id="country" name="country" class="form-control"></select>
                        </div>
                        <div class="col-sm-4">
                            <select id="state" name="state" class="form-control"></select>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">work Phone</label>
                        <div class="col-sm-9">
                            <input type="text" name="work_phone" id="work_phone" placeholder="06xxxxxxxxx" class="form-control @error('work_phone') is-invalid @enderror" value="{{ old('work_phone') }}"  autocomplete="work_phone" autofocus>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Zip Code</label>
                        <div class="col-sm-4">
                            <select id="zip" name="zip" class="form-control"></select>
                        </div>
                        <div class="col-sm-5">
                            <select id="currency_id" name="currency_id" class="form-control"></select>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Sosial Media</label>
                        <div class="col-sm-9">
                            <input type="text" name="ssnid" id="ssnid" placeholder="facebook or instagram" class="form-control @error('ssnid') is-invalid @enderror" value="{{ old('ssnid') }}"  autocomplete="ssnid" autofocus>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-3 bg-light">
                <nav class="navbar navbar-expand-lg navbar-light bg-info">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="privateinformation nav-link active" href="">
                                Private Information 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="jobsposition nav-link" href="">
                                Jobs Position
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="useraccount nav-link" href="">
                                user Account
                            </a>
                        </li>
                        </ul>
                    </div>
                </nav>
                <div class="container my-3">
                    <section id="privateinformation">
                        <div class="row">
                            <h3 class="col-sm-10 font-weight-bold text-primary">Private Information</h3>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Passport id</label>
                            <div class="col-sm-8">
                                <input type="text" name="passport_id" id="passport_id" class="form-control @error('passport_id') is-invalid @enderror" value="{{ old('passport_id') }}"  autocomplete="passport_id" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Permit no</label>
                            <div class="col-sm-8">
                                <input type="text" name="permit_no" id="permit_no" class="form-control @error('permit_no') is-invalid @enderror" value="{{ old('permit_no') }}"  autocomplete="permit_no" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">visa number</label>
                            <div class="col-sm-3">
                                <input type="text" name="visa_no" id="visa_no" class="form-control @error('visa_no') is-invalid @enderror" value="{{ old('visa_no') }}"  autocomplete="visa_no" autofocus>
                            </div>
                            <label class="col-sm-2 col-form-label">visa number</label>
                            <div class="col-sm-3">
                                <input type="date" name="visa_expire" class="form-control" id="visa_expire" placeholder="visa Expire">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">salary</label>
                            <div class="col-sm-3">
                                <input type="text" name="salary" id="salary" class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary') }}"  autocomplete="salary" autofocus>
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="col-sm-10 font-weight-bold text-primary">Study</h3>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">certificate</label>
                            <div class="col-sm-3">
                                <select type="text" name="certificate" class="form-control" id="certificate" placeholder="certificate">
                                    <option value="High_School">High School</option>
                                    <option value="Diploma">Diploma</option>
                                    <option value="Barchelor">Barchelor</option>
                                    <option value="Magister">Magister</option>
                                    <option value="Doctor">Doctor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">study field</label>
                            <div class="col-sm-3">
                                <input type="text" name="study_field" id="study_field" class="form-control @error('study_field') is-invalid @enderror" value="{{ old('study_field') }}"  autocomplete="study_field" autofocus>
                            </div>
                            <label class="col-sm-2 col-form-label">school / university</label>
                            <div class="col-sm-3">
                                <input type="text" name="study_school" id="study_school" class="form-control @error('study_school') is-invalid @enderror" value="{{ old('study_school') }}"  autocomplete="study_school" autofocus>
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="col-sm-10 font-weight-bold text-primary">Emergency</h3>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Emergency Contact</label>
                            <div class="col-sm-8">
                                <input type="text" name="emergency_contact" id="emergency_contact" class="form-control @error('emergency_contact') is-invalid @enderror" value="{{ old('emergency_contact') }}"  autocomplete="emergency_contact" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Emergency Phone</label>
                            <div class="col-sm-8">
                                <input type="text" name="emergency_phone" id="emergency_phone" class="form-control @error('emergency_phone') is-invalid @enderror" value="{{ old('emergency_phone') }}"  autocomplete="emergency_phone" autofocus>
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="col-sm-10 font-weight-bold text-primary">Bank</h3>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Bank_account_id</label>
                            <div class="col-sm-8">
                                <input type="text" name="Bank_account_id" id="Bank_account_id" class="form-control @error('Bank_account_id') is-invalid @enderror" value="{{ old('Bank_account_id') }}"  autocomplete="Bank_account_id" autofocus>
                            </div>
                        </div>
                        <br>
                    </section>
                    <section id="jobsposition">
                        <div class="row">
                            <h3 class="col-sm-10 font-weight-bold text-primary">Position</h3>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">department</label>
                            <div class="col-sm-8">
                                <select name="department" id="department" class="form-control"></select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Manager</label>
                            <div class="col-sm-8">
                            <select name="parent_id" id="parent_id" class="form-control"></select>
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="col-sm-10 font-weight-bold text-primary">Responsible</h3>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Coach</label>
                            <div class="col-sm-8">
                                <select name="coach_id" id="coach_id" class="form-control"></select>
                            </div>
                        </div>
                        <br>
                    </section>
                    <section id="useraccount">
                        <div class="row">
                            <h3 class="col-sm-10 font-weight-bold text-primary">User Password</h3>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="col-sm-10 font-weight-bold text-primary">Access</h3>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Access</label>
                            <div class="col-md-6">
                            <select type="text" name="access" class="form-control" id="access" placeholder="access"></select>
                            </div>
                        </div>
                        <br>
                    </section>
                </div>
            </div>
            <br>
        </form>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('js/employee.js')}}"></script>
@endsection
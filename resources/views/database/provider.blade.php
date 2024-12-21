@extends('layout_admin')
@section('title','Laravel | Register Datasource')
@section('content')
    <form role="form" action="/web/database/provider/register" method="post">
        @csrf

        @if($errors->has('connection'))
            <div class="alert alert-danger">
                {{ $errors->first('connection') }}
            </div>
        @endif

        <x-forms.input-field
            id="master_pwd"
            name="master_pwd"
            type="password"
            label="Master Password"
            required="true"
        />

        <x-forms.input-field
            id="host"
            name="host"
            type="text"
            label="Host"
            required="true"
        />

        <x-forms.input-field
            id="port"
            name="port"
            type="text"
            label="Port"
            required="true"
            pattern="[0-9]+"
            title="Please enter number only"
        />

        <x-forms.input-field
            id="user"
            name="user"
            type="text"
            label="Database User"
            required="true"
        />

        <x-forms.input-field
            id="password"
            name="password"
            type="password"
            label="Password"
            required="true"
        />

        <input type="submit" value="Save & Test Connection" class="btn btn-primary float-left">
    </form>
@endsection
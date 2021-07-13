@extends('web.layout_admin')
@section('title','Laravel | Register Datasource')
@section('content')
    @if ($master_passwd != false)
        <div class="alert alert-warning" role="alert">
            <div class="text-center">Warning !</div>
            Your Enterprise database is not protected. To secure it,
            We have generated the following password for it:
            <div id="laravel_master_passwd" class="text-center my-2">{{$master_passwd ?? ''}}</div>
            <div class="d-flex justify-content-end">
                <button value="copy" onclick="copyToClipboard(laravel_master_passwd)" class="btn btn-outline-danger">Copy Password</button>
            </div>
        </div>
    @endif
    <form role="form" action="{{route('SaveDatasource')}}" method="post">  
        @csrf
        <div class="form-group row">
            <label for="master_pwd" class="col-md-4 col-form-label">Master Password</label>
            <div class="col-md-8 input-group">
                <input id="master_pwd" name="master_pwd" class="form-control" required="required" autofocus="autofocus" type="password" autocomplete="current-password">
                <div class="input-group-append">
                    <span class="fa fa-eye o_little_eye input-group-text" aria-hidden="true" style="cursor: pointer;" onclick="ShowPassword('master_pwd')"></span>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="host" class="col-md-4 col-form-label">Host</label>
            <div class="col-md-8">
                <input id="host" type="text" name="host" class="form-control" required="required" autocomplete="off" >
            </div>
        </div>
        <div class="form-group row">
            <label for="port" class="col-md-4 col-form-label">Port</label>
            <div class="col-md-8">
                <input id="port" type="text" name="port" class="form-control" required="required" autocomplete="off" pattern="[0-9]+" title="please enter number only" >
            </div>
        </div>
        <div class="form-group row">
            <label for="user" class="col-md-4 col-form-label">Database User</label>
            <div class="col-md-8">
                <input id="user" type="text" name="user" class="form-control" required="required" autocomplete="off">
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label">Password</label>
            <div class="col-md-8 input-group">
                <input id="password" type="password" name="password" class="form-control" required="required" autocomplete="off">
                <div class="input-group-append">
                    <span class="fa fa-eye o_little_eye input-group-text" aria-hidden="true" style="cursor: pointer;" onclick="ShowPassword('password')"></span>
                </div>
            </div>
        </div>
        <input type="submit" value="Save & Test Connection" class="btn btn-primary float-left">
    </form>
@endsection
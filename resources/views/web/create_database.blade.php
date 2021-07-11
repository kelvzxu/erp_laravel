@extends('web.layout_admin')
@section('title','Laravel | Create Database')
@section('content')
    <form role="form" action="/web/database/create" method="post">  
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
            <label for="name" class="col-md-4 col-form-label">Database Name</label>
            <div class="col-md-8">
                <input id="dbname" type="text" name="name" class="form-control" required="required" autocomplete="off" pattern="^[a-zA-Z0-9][a-zA-Z0-9_.-]+$" title="Only alphanumerical characters, underscore, hyphen and dot are allowed">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label">Email</label>
            <div class="col-md-8">
                <input id="email" type="text" name="email" class="form-control" required="required" autocomplete="off">
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
        <div class="form-group row">
            <label for="company" class="col-md-4 col-form-label">Company Name</label>
            <div class="col-md-8">
                <input id="company" type="text" name="company" class="form-control" required="required" autocomplete="off">
            </div>
        </div>
        <div class="form-group row">
            <label for="phone" class="col-md-4 col-form-label">Phone Number</label>
            <div class="col-md-8">
                <input id="phone" type="text" name="phone" class="form-control" required="required" autocomplete="off">
            </div>
        </div>
        <input type="submit" value="Create Database" class="btn btn-primary float-left">
    </form>
@endsection
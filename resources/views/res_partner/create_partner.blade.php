@extends('layouts.admin')
@section('title','SK - New Partner')
@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
        {{ session('status') }}
        </div>
    @endif
    <!-- header -->
    <div class="row">
        <div class="col-7">
            <h3>Create Supplier</h3>
        </div>
        <div class="col-5 text-right">
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

    <div class="container bg-white mt-3">
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
                            <input type="text" class="form-control" name="name" id="name" placeholder="Supplier Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Display Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="display_name" id="display_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Parent Company</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="Parent_id" id="Parent_id">
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
                            <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" id="email" placeholder="mail@example.com">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Street</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="street1" id="street1" placeholder="street">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="street2" id="street2" placeholder="street 2">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Mobile</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="08xxxxxxxxx">
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
                        <label class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="06xxxxxxxxx">
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
                        <label class="col-sm-3 col-form-label">Website</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="website" id="website" placeholder="https://www.laravel.com">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">language</label>
                        <div class="col-sm-5">
                            <select id="lag" name="lag" class="form-control"></select>
                        </div>
                        <div class="col-sm-4">
                            <select id="tz" name="tz" class="form-control"></select>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">reference</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="website" id="website" placeholder="reference">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Bank Account</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="bank_account" id="bank_account" placeholder="800XXXXX">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">limit</label>
                        <div class="col-sm-5">
                            <input id="debit" name="debit" class="form-control" placeholder="Debit"></input>
                        </div>
                        <div class="col-sm-4">
                            <input id="credit" name="credit" class="form-control" placeholder="kredit"></input>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            is company
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Company Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="company_name" id="company_name" placeholder="PT. Example">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">commercial company name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="commercial_company_name" id="commercial_company_name">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
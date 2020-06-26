@extends('layouts.admin')
@section('title','Accounting - journal')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<form action="{{ route('journal.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="app-page-title bg-white">
        <div class="o_control_panel">
            <div>
                <ol class="breadcrumb" role="navigation">
                    <li class="breadcrumb-item" accesskey="b"><a href="{{route('journal.index')}}">Journal</a></li>
                    <li class="breadcrumb-item active">New</li>
                </ol>
            </div>
            <div>
                <div class="o_cp_left">
                    <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                        <div>
                            <button class="btn btn-primary my-2" @click="create" :disabled="isProcessing">Save</button>
                            <a href="{{route('journal.index')}}" class="btn btn-secondary mby-2">Discard</a>
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
    <div class="container bg-white my-3">
        <br>
        <div class="row">
            <div class="col-sm-6">
                <label for="">Jounal Name</label>
                    <div class="wrap-input200">
                        <input type="text" name="name" placeholder="Journal Name"
                            class="input200 {{ $errors->has('name') ? 'is-invalid':'' }}">
                    </div>
                <p class="text-danger">{{ $errors->first('name') }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <label class="col-sm-4 col-form-label">Type</label>
                    <div class="col-sm-7">
                        <div class="wrap-input200">
                            <select name="type" id="type" style="border:none"
                                    class="input200 {{ $errors->has('type') ? 'is-invalid':'' }}">
                                <option value=""></option>
                                <option value="Sales">Sales</option>
                                <option value="Purchases">Purchases</option>
                                <option value="Cash">Cash</option>
                                <option value="Bank">Bank</option>
                                <option value="Miscellaneous">Miscellaneous</option>
                            </select>
                        </div>
                        <p class="text-danger">{{ $errors->first('type') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <label class="col-sm-4 col-form-label">Company</label>
                    <div class="col-sm-7">
                        <div class="wrap-input200">
                            <select name="company_id" id="company_id" style="border:none"
                                    class="input200 {{ $errors->has('company_id') ? 'is-invalid':'' }}">
                                @foreach ($company as $row)
                                    <option value="{{ $row->id }}">{{ ucfirst($row->company_name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="text-danger">{{ $errors->first('company_id') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li class="nav-item" id="entries">
                <a class="nav-link active journal_entry" href="#">Journal Entries</a>
            </li>
            <li class="nav-item" id="bank" style="display: none">
                <a class="nav-link bank_account" href="#">Bank Account</a>
            </li>
            <li class="nav-item" id="settings">
                <a class="nav-link advance_setting" href="#">Advanced Settings</a>
            </li>
        </ul>
        <section id="JournalEntries">
            <div class="row">
                <div class="col-sm-6 mt-2">
                    <div class="row">
                        <label class="col-sm-4 col-form-label">Short Code</label>
                        <div class="col-sm-7">
                            <div class="wrap-input200">
                                <input type="text" name="code" id="code"
                                    class="input200 {{ $errors->has('code') ? 'is-invalid':'' }}" autofocus>
                            </div>
                            <p class="text-danger">{{ $errors->first('code') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-form-label">Currency</label>
                        <div class="col-sm-7">
                            <div class="wrap-input200">
                                <select name="currency_id" id="currency_id" style="border:none"
                                    class="input200 {{ $errors->has('currency_id') ? 'is-invalid':'' }}">
                                    <option value="">Select currency</option>
                                    @foreach ($currency as $row)
                                        <option value="{{ $row->id }}">{{ ucfirst($row->currency_name) }} ({{ ucfirst($row->symbol) }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="text-danger">{{ $errors->first('currency_id') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mt-2">
                    <div class="row">
                        <label class="col-sm-5 col-form-label">Default Debit Account</label>
                        <div class="col-sm-6">
                            <div class="wrap-input200">
                                <select name="default_debit_account_id" id="default_debit_account_id" style="border:none"
                                        class="input200 {{ $errors->has('default_debit_account_id') ? 'is-invalid':'' }}">
                                    <option value=""></option>
                                    @foreach ($account as $row)
                                        <option value="{{ $row->code }}">{{ ucfirst($row->name) }} | {{ ucfirst($row->code) }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="text-danger">{{ $errors->first('default_debit_account_id') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-5 col-form-label">Default Credit Account</label>
                        <div class="col-sm-6">
                            <div class="wrap-input200">
                                <select name="default_credit_account_id" id="default_credit_account_id" style="border:none"
                                        class="input200 {{ $errors->has('default_credit_account_id') ? 'is-invalid':'' }}">
                                    <option value=""></option>
                                    @foreach ($account as $row)
                                        <option value="{{ $row->code }}">{{ ucfirst($row->name) }} | {{ ucfirst($row->code) }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="text-danger">{{ $errors->first('default_credit_account_id') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="AdvanceSetting">
            <div class="row mb-3">
                <div class="col-sm-9 mt-2">
                    <section id="posting">
                        <h5 class="text-primary">Posting</h5>
                        <section id="ProfitLoss">
                            <div class="row mt-1">
                                <label class="col-sm-3 col-form-label">Profit Account</label>
                                <div class="col-sm-6">
                                    <div class="wrap-input200">
                                        <select name="profit_account_id" id="profit_account_id" style="border:none"
                                                class="input200 {{ $errors->has('profit_account_id') ? 'is-invalid':'' }}">
                                            <option value=""></option>
                                            @foreach ($account as $row)
                                                <option value="{{ $row->code }}">{{ ucfirst($row->name) }} | {{ ucfirst($row->code) }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('profit_account_id') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3 col-form-label">Loss Account</label>
                                <div class="col-sm-6">
                                    <div class="wrap-input200">
                                        <select name="loss_account_id" id="loss_account_id" style="border:none"
                                                class="input200 {{ $errors->has('loss_account_id') ? 'is-invalid':'' }}">
                                            <option value=""></option>
                                            @foreach ($account as $row)
                                                <option value="{{ $row->code }}">{{ ucfirst($row->name) }} | {{ ucfirst($row->code) }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('loss_account_id') }}</p>
                                </div>
                            </div>
                        </section>
                        <div class="row">
                            <label class="col-sm-3">Post At</label>
                            <div class="col-sm-6">
                                <div class="row ml-3">
                                    <input class="form-check-input" type="radio" id="payment" name="post_at" value="payment validation"><span>Payment Validation</span>
                                </div>
                                <div class="row ml-3">
                                    <input class="form-check-input" type="radio" id="bankreconsiliation" name="post_at" value="bank reconciliation"><span>Bank Reconciliation</span>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-9 mt-2">
                    <h5 class="text-primary">Control-Access</h5>
                    <footer class="blockquote-footer">Keep empty for no control</footer>
                    <div class="row mt-1">
                        <label class="col-sm-3 col-form-label">Account Types Allowed</label>
                        <div class="col-sm-6">
                            <div class="wrap-input200">
                                <select name="account_type_allowed" id="account_type_allowed" style="border:none"
                                        class="input200 {{ $errors->has('account_type_allowed') ? 'is-invalid':'' }}">
                                    <option value=""></option>
                                    @foreach ($account_type as $row)
                                        <option value="{{ $row->id }}">{{ ucfirst($row->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="text-danger">{{ $errors->first('account_type_allowed') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label">Account Allowed</label>
                        <div class="col-sm-6">
                            <div class="wrap-input200">
                                <select name="account_allowed" id="account_allowed" style="border:none"
                                        class="input200 {{ $errors->has('account_allowed') ? 'is-invalid':'' }}">
                                    <option value=""></option>
                                    @foreach ($account as $row)
                                        <option value="{{ $row->code }}">{{ ucfirst($row->name) }}  | {{ ucfirst($row->code) }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="text-danger">{{ $errors->first('account_allowed') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="bankaccount">
            <div class="row">
                <div class="col-sm-6 mt-2">
                    <div class="row">
                        <label class="col-sm-4 col-form-label">Bank Account</label>
                        <div class="col-sm-7">
                            <div class="wrap-input200">
                                <select name="bank_account_id" id="bank_account_id" style="border:none"
                                        class="input200 {{ $errors->has('bank_account_id') ? 'is-invalid':'' }}">
                                    <option value=""></option>
                                    @foreach ($bank_account as $row)
                                        <option value="{{ $row->id }}">{{ ucfirst($row->company_bank_name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="text-danger">{{ $errors->first('bank_account_id') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mt-2">
                    <div class="row">
                        <label class="col-sm-4 col-form-label">Bank</label>
                        <div class="col-sm-7">
                            <div class="wrap-input200">
                                <select name="bank" id="bank" style="border:none"
                                        class="input200 {{ $errors->has('bank') ? 'is-invalid':'' }}">
                                    <option value=""></option>
                                    @foreach ($bank as $row)
                                        <option value="{{ $row->id }}">{{ ucfirst($row->bank_name) }} ({{ ucfirst($row->symbol) }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="text-danger">{{ $errors->first('bank') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @slot('footer')
        
        @endslot
        <br>
    </div>
    <br>
</form>
                            
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
$('a#account-config').addClass('mm-active');
$('a#journal').addClass('mm-active');
function close (){
        const close = document.querySelectorAll("section");
        close.forEach(function (el) {
            el.style.display = 'none';
        });
    }
    function Hide(params){
        $(params).css("display", "none");
    }
    function Display(params){
        $(params).css("display", "");
    }
    function unactive(){
        $('.nav-link').removeClass('active');
    }
    function checktype(){
        var status = $("#type").val();
        if (status == "Sales"){
            Hide("#bank");
        }
        if (status == "Purchases"){
            Hide("#bank");
        }
        if (status == "Cash"){
            Hide("#bank");
            Display("section#ProfitLoss");
            Display("section#posting");
        }
        if (status == "Bank"){
            Display("#bank");
            Display("section#posting");
            Hide("section#ProfitLoss");
        }
        if (status == "Miscellaneous"){
            Hide("#bank");
        }
    }
    $("#type").change(function() {
        checktype()
    });
    close();

    $(function () {
        close();
        Display("section#JournalEntries");
        checktype()

        $("a.journal_entry").click(function( event ){
            close();
            unactive();
            checktype();
            $(this).addClass('active');
            Display("section#JournalEntries");
            event.preventDefault();
        });

        // if jobs position clicked
        $("a.bank_account").click(function( event ){
            close();
            unactive();
            checktype();
            $(this).addClass('active');
            Display("section#bankaccount");
            event.preventDefault();
        });

        // if advance setting clicked
        $("a.advance_setting").click(function( event ){
            close();
            unactive();
            checktype();
            $(this).addClass('active');
            Display("section#AdvanceSetting");
            event.preventDefault();
        });
    })
</script>
@endsection
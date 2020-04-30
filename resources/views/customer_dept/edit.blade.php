@extends('layouts.admin')
@section('title','SK - Employee')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content') 
<form action="{{ url('CustomerDebt/update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="app-page-title bg-white">
        <div class="o_control_panel">
            <div>
                <ol class="breadcrumb" role="navigation">
                    <li class="breadcrumb-item" accesskey="b"><a href="{{route('CustomerDebt')}}">Customer Debt</a></li>
                    <li class="breadcrumb-item" accesskey="c"><a href="{{ URL::previous() }}">{{$customer_debt[0]->name}}</a></li>
                    <li class="breadcrumb-item" accesskey="c">{{$customer_debt[0]->invoice_no}}</li>
                </ol>
            </div>
            <div>
                <div class="o_cp_left">
                    <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                        <div>
                            <button class="btn btn-primary my-2" id="submit">Save</button>
                            <a href="{{route('CustomerDebt')}}" class="btn btn-secondary mby-2">Discard</a>
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
    <div class="row">
        <div class="container bg-white mt-5">
            <br>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="invoice_no">Invoice No</label>
                        <input type="text" class="form-control" id="invoice_no" name="invoice_no"value="{{$customer_debt[0]->invoice_no}}" readonly>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{$customer_debt[0]->name}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="invoice_date">Invoice date</label>
                        <input type="text" class="form-control" id="invoice_date" name="invoice_date" value="{{$customer_debt[0]->invoice_date}}" readonly>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="due_date">Due Date date</label>
                        <input type="text" class="form-control" id="due_date" name="due_date" value="{{$customer_debt[0]->due_date}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="total">Total</label>
                        <input type="text" class="form-control" id="total" name="total" value="{{$customer_debt[0]->total}}" readonly>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="credit_limit">credit_limit</label>
                        <input type="text" class="form-control" id="credit_limit" name="credit_limit" value="{{$customer_debt[0]->credit_limit}}" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                <div class="form-group">
                        <label for="payment">payment</label>
                    <div class="input-group">
                        <input id="pay" name="pay" type="text" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2" required >
                            <div class="input-group-append">
                                <a class="btn btn-outline-secondary btn-primary text-white" id="hitung">Match</a>
                            </div>
                    </div>
                </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="over">over</label>
                        <input type="text" class="form-control" id="over" name="over" value="{{$customer_debt[0]->over}}" placeholer="payment" readonly required>
                    </div>
                </div>
                <input type="hidden" class="form-control" id="payments" name="payment" required>
                <input type="hidden" class="form-control" id="status" name="status" value="{{$customer_debt[0]->status}}" required>
            </div>
            <br>
        </div>
    </div>
</form>
@endsection
@section('js')
<script>
$("#submit").attr("disabled", true);
$('#hitung').click(function(){
    $('#over').val(0);
    const pay = $('#pay').val();
    if (pay != ''){
        $('#submit').removeAttr("disabled")
        const total = $('#total').val();
        const credit = $('#credit_limit').val();
        let payments = parseInt(pay)+ parseInt(credit);
        let over = parseInt(payments) - parseInt(total);
        console.log(total);
        console.log(payments);
        if (payments >= total){
            $('#payments').val(total);
            $('#over').val(over);
            $('#status').val('PAID');
        }
        else
        {
            $('#payments').val(payments);
        }
    }
});
$('a#CustomerDebt').addClass('mm-active');
$('a#payment').addClass('mm-active');
$("#key").change(function() {
    var value = $("#key").val();
    $("input[name='filter']").val(value);
});
</script>
@endsection
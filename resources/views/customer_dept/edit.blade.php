@extends('layouts.admin')
@section('title','SK - Edit Customer')
@section('content')
<div class="container">
    @if (session('error'))
        <div class="alert alert-danger">
        {{ session('error') }}
        </div>
    @endif
    <!-- header -->
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('CustomerDebt')}}">CustomerDebt</a></li>
                        <li class="breadcrumb-item" aria-current="page">Create Payment</a></li>
                    </ol>
                </nav>
            </div>
            <h3>Create Payment</h3>
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
    <form action="{{ url('CustomerDebt/update') }}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="row">
            <div class="col-4 my-3">
                <button class="btn btn-primary btn-sm" id="submit">
                    <i class="fa fa-send"></i> Save Record
                </button>
            </div>
        </div>
        <div class="container bg-white">
            <br>
            <form>
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
                            <input id="payment" name="payment" type="text" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2" required >
                                <div class="input-group-append">
                                    <a class="btn btn-outline-secondary" id="hitung">Match</a>
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
                    <input type="hidden" class="form-control" id="status" name="status" value="{{$customer_debt[0]->status}}" required>
                </div>
                <br>
            </form>
        </div>
    </form>
</div>
@endsection
@section('js')
<script>
 $("#submit").attr("disabled", true);
$('#hitung').click(function(){
    const payment = $('#payment').val();
    if (payment != ''){
        $('#submit').removeAttr("disabled")
        const total = $('#total').val();
        const credit = $('#credit_limit').val();
        let payments = parseInt(payment)+ parseInt(credit);
        let over = parseInt(payments) - parseInt(total);
        if (payments >= total){
            $('#over').val(over);
            $('#status').val('PAID');
        }
    }
});
</script>
@endsection
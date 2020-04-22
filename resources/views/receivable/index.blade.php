@extends('layouts.admin')
@section('title','SK - Employee')
@section('content')
    <div class="panel panel-default">
        <div class="row">
            <div class="col-12 col-md-7">
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('ReceivableAccount.index')}}">Receivable Account</a></li>
                        </ol>
                    </nav>
                </div>
                <h3>Receivable Account</h3>
            </div>
            <div class="col-12 col-md-5 text-right">
                <form action="" method="get" >
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <select class="input-group-text bg-primary text-white" name="filter">
                                    <option value="" selected>Filter By</option>
                                    <option value="purchase_no">Purchase No</option>
                                    <option value="receipt_no">Receipt No</option>
                                    <option value="receipt_date">Receipt Date</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" placeholder="Search...." name="value">
                        <div class="input-group-append">
                            <button class="btn btn-outline-success" type="submit"><i class="fa fa-search" aria-hidden="true"> Search</i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-3 mt-2">
            <a href="{{route('ReceivableAccount.Print')}}" class="btn btn-success"><i class="fa fa-print"></i> Print</a>
            </div>
        </div>
        <div class="panel-body mt-3">
            <div class="table-responsive-lg my-4">
                <table class="table table-striped">
                    <thead class="table table-sm">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Invoice No</th>
                            <th scope="col">Journal</th>
                            <th scope="col">account</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Debit</th>
                            <th scope="col">Credit</th>
                        </tr>
                    </thead>
                    @forelse($Receivable as $data)
                    <tbody>
                            <tr>
                                <td scope="row">{{$loop->iteration}}</td>
                                <td>{{$data->invoice_no}}</td>
                                <td>{{$data->code}}</td>
                                <td>{{$data->default_credit_account_id}}</td>
                                <td>{{$data->name}}</td>
                                <td>Rp. {{ number_format($data->total)}}</td>
                                <td>Rp. {{ number_format($data->payment)}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Receivable Account is Empty</td>
                            </tr>
                    </tbody>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
$('a#receivable').addClass('mm-active');
$('a#partner_ledger').addClass('mm-active');
    var app = <?php echo json_encode($Receivable); ?>;
    console.log(app);
</script>
@endsection
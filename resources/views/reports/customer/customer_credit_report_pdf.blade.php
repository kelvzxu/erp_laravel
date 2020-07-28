@extends('reports.layouts.report')
@section('title')
<title>Report Customer Debt - {{ date("Y/m/d")}}</title>
@endsection
@section('css')
<style>
h3 {text-align: center;}
</style>
@endsection
@section('content')
    <h3><b><u>Report Customer Debt - {{ date("Y/m/d")}}</u></b></h3>
    @if($customer->count())
    <div class="table-responsive-lg mt-3">
        <table class="table">
            <thead class="table table-sm">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">Credit</th>
                    <th scope="col">Debit</th>
                </tr>
            </thead>
            @foreach($customer as $cust)
            <tbody>
                <tr>
                    <th scope="row">{{$loop->iteration}}
                    <th >{{$cust->display_name}}</th>
                    <th >{{$cust->parent_id}}</th>
                    <th >Rp. {{ number_format($cust->credit)}}</th>
                    <th >Rp. {{ number_format($cust->debit)}}</th>
                </tr>
            </tbody>
            @endforeach
            <tfoot>
                <tr>
                    <td colspan="3"><b>Total</b> </td>
                    <td class="table-label"><b>Rp. {{number_format($credit)}}</b></td>
                    <td class="table-amount"><b>Rp. {{number_format($debit)}}</b></td>
                </tr>
            </tfoot>
        </table>
    </div>
    @else
    <div class="o_nocontent_help">
        <p class="o_view_nocontent_smiling_face">
            <img src="{{ public_path('images/icons/smiling_face.svg')}}" alt=""><br>
            Congratulation You dont Have customer debt
        </p>
    </div>
    @endif
@endsection
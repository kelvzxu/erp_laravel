@extends('reports.layouts.report')
@section('title')
<title>General Ledger</title>
@endsection
@section('css')
<style>
h3 {text-align: center;}
</style>
@endsection
@section('content')
    <h4><b><u>General ledger</u></b></h4>

    <table class="o_list_table table table-sm">
        <thead>
            <tr>
                <th data-name="date">Date</th>
                <!-- <th data-name="company_id">Company</th> -->
                <th data-name="move_id" >Journal Entry</th>
                <th data-name="partner_id">Partner</th>
                <th data-name="name">Label</th>
                <th data-name="debit">Debit</th>
                <th data-name="credit">Credit</th>
            </tr>
        </thead>
        @foreach($data as $row)
        <tbody>
            <tr id="{{$row->code}}" class="o_group_header o_group_has_content">
                <th class="o_group_name" tabindex="-1" colspan="4"><span class="fa fa-caret-right"
                        style="padding-left: 0px; padding-right: 5px;"></span>{{$row->code}} {{$row->name}} ({{ $row->move_lines->count() }})</th>
                <td class="debit o_list_number">Rp. {{ number_format($row->move_lines->sum('debit'))}}</td>
                <td class="credit o_list_number">Rp. {{ number_format($row->move_lines->sum('credit'))}}</td>
            </tr>
        </tbody>
            @foreach ($row->move_lines as $items)
            <tbody>
                <tr class="o_data_row {{$row->code}}">
                    <td>{{$items->date}}</td>
                    <!-- <td>{{$items->company->company_name}}</td> -->
                    <td>{{$items->account_move_name}}</td>
                    <td>{{$items->account_move->invoice_partner_display_name}}</td>
                    <td>{{$items->name}}</td>
                    <td>Rp. {{number_format($items->debit)}}</td>
                    <td>Rp. {{number_format($items->credit)}}</td>
                </tr>
            </tbody>
            @endforeach
        @endforeach
        <tfoot>
            <tr>
                <td class="date"></td>
                <!-- <td class="company_id"></td> -->
                <td class="move_id"></td>
                <td class="partner_id"></td>
                <td class="name"></td>
                <td class="debit o_list_number" title="Total Debit">Rp. {{ number_format($totaldebit)}}</td>
                <td class="credit o_list_number" title="Total Credit">Rp. {{ number_format($totalcredit)}}</td>
            </tr>
        </tfoot>
    </table>
@endsection

@extends('reports.layouts.report')
@section('title')
<title>Partner Ledger</title>
@endsection
@section('css')
<style>
h3 {text-align: center;}
</style>
@endsection
@section('content')
    <h4><b><u>Partner ledger ({{$type}})</u></b></h4>

    <table class="o_list_table table table-sm">
        <thead>
            <tr>
                <th data-name="date">Date</th>
                <th data-name="company_id">Company</th>
                <th data-name="move_id" >Journal Entry</th>
                <th data-name="partner_id">Account</th>
                <th data-name="name">Label</th>
                <th data-name="debit">Debit</th>
                <th data-name="credit">Credit</th>
            </tr>
        </thead>
        @foreach($data as $row)
        <tbody>
            <tr id="{{$row->id}}" class="o_group_header o_group_has_content">
            @if ($type == "customer")
                <th class="o_group_name" tabindex="-1" colspan="5"><span class="fa fa-caret-right"
                        style="padding-left: 0px; padding-right: 5px;"></span>{{$row->name}} ({{ $row->move_lines->count() }})</th>
            @else
                <th class="o_group_name" tabindex="-1" colspan="5"><span class="fa fa-caret-right"
                        style="padding-left: 0px; padding-right: 5px;"></span>{{$row->partner_name}} ({{ $row->move_lines->count() }})</th>
            @endif
                <td class="debit o_list_number">Rp. {{ number_format($row->move_lines->sum('debit'))}}</td>
                <td class="credit o_list_number">Rp. {{ number_format($row->move_lines->sum('credit'))}}</td>
            </tr>
        </tbody>
            @foreach ($row->move_lines as $items)
                <tbody>
                    <tr class="o_data_row {{$row->id}}">
                        <td>{{$items->date}}</td>
                        <td>{{$items->company->company_name}}</td>
                        <td>{{$items->account_move_name}}</td>
                        <td>{{$items->account->code}} {{$items->account->name}}</td>
                        <td>{{$items->name}}</td>
                        <td>Rp. {{number_format($items->debit)}}</td>
                        <td>Rp. {{number_format($items->credit)}}</td>
                    </tr>
                </tbody>
            @endforeach
        @endforeach
        <tfoot>
        </tfoot><i class="o_optional_columns_dropdown_toggle fa fa-ellipsis-v"></i>
    </table>
@endsection

@extends('reports.layouts.report')
@section('title')
<title>Report Listing Product</title>
@endsection
@section('css')
<style>
h3 {text-align: center;}
</style>
@endsection
@section('content')
    <h3><b><u>Product Move Report </u></b></h3>

    <table class="o_list_table table table-sm">
        <thead>
            <tr>
                <th data-name="date">Date</th>
                <th data-name="reerence">Reference</th>
                <th data-name="company">Company</th>
                <th data-name="product">Product</th>
                <th data-name="from">From</th>
                <th data-name="to">To</th>
                <th data-name="quantity" >Quantity</th>
                <th data-name="status" >Status</th>
            </tr>
        </thead>
        @foreach($data as $row)
        <tbody>
            <tr id="{{$row->code}}" class="o_group_header o_group_has_content">
                <th class="o_group_name" tabindex="-1" colspan="6"><span class="fa fa-caret-right"
                        style="padding-left: 0px; padding-right: 5px;"></span>[{{$row->code}}] {{$row->name}} ({{ $row->move->count() }})</th>
                <td class="debit o_list_number">{{$row->move->sum('quantity')}}</td>
                <td></td>
            </tr>
        </tbody>
        @foreach ($row->move as $items)
            <tbody>
                <tr class="o_data_row {{$row->code}}">
                    <td class="o_data_cell o_field_cell o_readonly_modifier">{{$items->created_at}}</td>
                    <td class="o_data_cell o_field_cell o_list_many2one o_readonly_modifier">{{$items->reference}}</td>
                    <td class="o_data_cell o_field_cell o_list_many2one o_readonly_modifier">{{$items->company->company_name}}</td>
                    <td class="o_data_cell o_field_cell o_list_many2one o_readonly_modifier">[{{$row->code}}] {{$row->name}}</td>
                    <td class="o_data_cell o_field_cell o_list_many2one o_readonly_modifier">{{$items->location_name}}</td>
                    <td class="o_data_cell o_field_cell o_list_many2one o_readonly_modifier">{{$items->location_destination_name}}</td>
                    <td class="o_data_cell o_field_cell o_list_number o_readonly_modifier">{{$items->quantity}}</td>
                    <td class="o_data_cell o_field_cell o_list_many2one o_readonly_modifier">{{$items->state}}</td>
                </tr>
            </tbody>
            @endforeach
        @endforeach
        <tfoot>
        </tfoot><i class="o_optional_columns_dropdown_toggle fa fa-ellipsis-v"></i>
    </table>
@endsection
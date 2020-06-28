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
    <h3><b><u>Inventory Valuation </u></b></h3>

    <table class="o_list_table table table-sm">
        <thead>
            <tr>
                <th data-name="date">Date</th>
                <th data-name="company">Company</th>
                <th data-name="product">Product</th>
                <th data-name="quantity" >Quantity</th>
                <th data-name="cost">Cost</th>
                <th data-name="value">Total Value</th>
            </tr>
        </thead>
        @foreach($data as $row)
        <tbody>
            <tr id="{{$row->code}}" class="o_group_header o_group_has_content">
                <th class="o_group_name" tabindex="-1" colspan="3"><span class="fa fa-caret-right"
                        style="padding-left: 0px; padding-right: 5px;"></span>[{{$row->code}}] {{$row->name}} ({{ $row->valuation->count() }})</th>
                <td class="debit o_list_number">{{$row->valuation->sum('quantity')}}</td>
                <td class="credit o_list_number">Rp. {{number_format($row->valuation->sum('unit_cost'))}}</td>
                <td class="credit o_list_number">Rp. {{number_format($row->valuation->sum('value'))}}</td>
            </tr>
        </tbody>
        @foreach ($row->valuation as $items)
            <tbody>
                <tr class="o_data_row {{$row->code}}">
                    <td class="o_data_cell o_field_cell o_readonly_modifier">{{$items->created_at}}</td>
                    <td class="o_data_cell o_field_cell o_list_many2one o_readonly_modifier">{{$items->company->company_name}}</td>
                    <td class="o_data_cell o_field_cell o_list_many2one o_readonly_modifier">[{{$row->code}}] {{$row->name}}</td>
                    <td class="o_data_cell o_field_cell o_list_number o_readonly_modifier">{{$items->quantity}}</td>
                    <td class="o_data_cell o_field_cell o_list_number o_readonly_modifier">Rp. {{number_format($items->unit_cost)}}</td>
                    <td class="o_data_cell o_field_cell o_list_number o_readonly_modifier">Rp. {{number_format($items->value)}}</td>
                </tr>
            </tbody>
            @endforeach
        @endforeach
        <tfoot>
            <tr>
                <th data-name="date"></th>
                <th data-name="company"></th>
                <th data-name="product"></th>
                <th data-name="quantity" class="o_list_number">{{$valuation->sum('quantity')}}</th>
                <th data-name="cost" class="o_list_number">Rp. {{number_format($valuation->sum('unit_cost'))}}</th>
                <th data-name="value" class="o_list_number">Rp. {{number_format($valuation->sum('value'))}}</th>
            </tr>
        </tfoot><i class="o_optional_columns_dropdown_toggle fa fa-ellipsis-v"></i>
    </table>
@endsection
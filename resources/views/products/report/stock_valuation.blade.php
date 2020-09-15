@extends('layouts.admin')
@section('title','Inventory Valuation Report')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="o_action_manager">
    <div class="o_control_panel">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item active" accesskey="b">Inventory Valuation</li>
            </ol>
            <div class="o_cp_searchview" role="search">
                <div class="o_searchview" role="search" aria-autocomplete="list">
                    <form action="" method="get" >
                        <button class="o_searchview_more fa fa-search-minus" title="Advanced Search..." role="img"
                            aria-label="Advanced Search..." type="submit"></button>

                        <div class="o_searchview_input_container">
                            <input type="text" class="o_searchview_input" accesskey="Q" placeholder="Search..."
                                role="searchbox" aria-haspopup="true" name="value">
                            <input type="hidden" class="o_searchview_input" accesskey="Q" placeholder="key"
                            role="searchbox" aria-haspopup="true" name="filter">
                            <div class="dropdown-menu o_searchview_autocomplete" role="menu"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div>
            <div class="o_cp_left">
                <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                    <div>
                        <a href="{{ route('inventory.print_valuation') }}" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                    </div>
                </div>
            </div>
            <div class="o_cp_right">
                <div class="btn-group o_search_options position-static" role="search">
                    <div>
                        <div class="btn-group o_dropdown">
                            <select
                                class=" o_filters_menu_button o_dropdown_toggler_btn btn btn-secondary dropdown-toggle "
                                data-toggle="dropdown" aria-expanded="false" tabindex="-1" data-flip="false"
                                data-boundary="viewport" name="key" id="key">
                                <option value="" data-icon="fa fa-filter">Filters</option>
                                <!-- <span class="fa fa-filter"></span> Filters -->
                            </select>
                        </div>
                    </div>
                </div>
                <nav class="o_cp_pager" role="search" aria-label="Pager">
                    <div class="o_pager o_hidden">
                        <span class="o_pager_counter">
                            <span class="o_pager_value">{{$data->total()}}</span> / <span class="o_pager_limit">{{$data->perPage()}}</span>
                        </span>
                        <span class="btn-group d-none" aria-atomic="true">
                            <button type="button" class="fa fa-chevron-left btn btn-secondary o_pager_previous"
                                accesskey="p" aria-label="Previous" title="Previous" tabindex="-1"></button>
                            <button type="button" class="fa fa-chevron-right btn btn-secondary o_pager_next"
                                accesskey="n" aria-label="Next" title="Next" tabindex="-1"></button>
                        </span>
                    </div>
                </nav>
                <nav class="btn-group o_cp_switch_buttonsnav nav" role="toolbar" aria-label="View switcher">
                    <a data-toggle="tab" disable_anchor="true" href="#notebook_page_511"
                                class="nav-link btn btn-secondary fa fa-lg fa-list-ul o_cp_switch_list active" role="tab" aria-selected="true"></a></li>
                    <a data-toggle="tab" disable_anchor="true" href="#notebook_page_521"
                                class="nav-link btn btn-secondary fa fa-lg fa-th-large o_cp_switch_kanban" role="tab"></a>
                </nav>
            </div>
        </div>
    </div>
    <div class="o_content o_controller_with_searchpanel">
        <div class="o_renderer_with_searchpanel o_list_view o_list_optional_columns">
            <div class="table-responsive">
                <table class="o_list_table table table-sm table-hover table-striped">
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
                            <tr class="o_data_row {{$row->code}}" style="display:none;">
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
            </div>
        </div>
    </div>
    <div class="row mx-4">
        {!! $data->render() !!}
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('js/asset_common/stock_valuation.js')}}"></script>
@endsection
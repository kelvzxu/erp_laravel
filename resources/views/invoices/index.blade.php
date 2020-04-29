@extends('layouts.admin')
@section('title','SK - Employee')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="app-page-title bg-white">
    <div class="o_control_panel">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('invoices')}}">Invoices</a></li>
            </ol>
            <div class="o_cp_searchview" role="search">
                <div class="o_searchview" role="search" aria-autocomplete="list">
                    <form action="{{ route('invoices.filter') }}" method="get" >
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
                        <a type="button" class="btn btn-primary o-kanban-button-new" accesskey="c" href="{{route('invoices.create')}}">
                            Create
                        </a>

                        <button type="button" class="btn btn-secondary o_button_import">
                            Import
                        </button>
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
                                <option value="invoice_no">Invoice No</option>
                                <option value="name">Name</option>
                                <option value="due_date">Due Date</option>
                                <!-- <span class="fa fa-filter"></span> Filters -->
                            </select>
                        </div>
                    </div>
                </div>
                <nav class="o_cp_pager" role="search" aria-label="Pager">
                    <div class="o_pager o_hidden">
                        <span class="o_pager_counter">
                            <span class="o_pager_value">$invoices->total()</span> / <span class="o_pager_limit">$invoices->perPage()</span>
                        </span>
                        <span class="btn-group" aria-atomic="true">
                            <button type="button" class="fa fa-chevron-left btn btn-secondary o_pager_previous"
                                accesskey="p" aria-label="Previous" title="Previous" tabindex="-1"></button>
                            <button type="button" class="fa fa-chevron-right btn btn-secondary o_pager_next"
                                accesskey="n" aria-label="Next" title="Next" tabindex="-1"></button>
                        </span>
                    </div>
                </nav>
                <nav class="btn-group o_cp_switch_buttons" role="toolbar" aria-label="View switcher">
                    <button type="button" accesskey="l" class="btn btn-secondary fa fa-lg fa-list-ul o_cp_switch_list active"
                        aria-label="View list" data-view-type="list" title="" tabindex="-1"
                        data-original-title="View list"></button>
                    <button type="button" class="btn btn-secondary fa fa-lg fa-bar-chart o_cp_switch_graph "
                        aria-label="View graph" data-view-type="graph" title="" tabindex="-1"
                        data-original-title="View graph"></button>
                </nav>
            </div>
        </div>
    </div>
    <div class="o-content">
        <div class="panel-body ml-2">
            @if($invoices->count())
            <div class="table-responsive-lg mb-4">
                <table class="table table-striped">
                    <thead class="table table-sm">
                        <tr>
                            <th scope="col">Invoice No.</th>
                            <th scope="col">Grand Total</th>
                            <th scope="col">Client</th>
                            <th scope="col">Invoice Date</th> 
                            <th scope="col">Due Date</th>
                            <th scope="col" colspan="2">Created At</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{$invoice->invoice_no}}</td>
                                <td>Rp. {{ number_format($invoice->grand_total)}}</td>
                                <td>{{$invoice->name}}</td>
                                <td>{{$invoice->invoice_date}}</td>
                                <td>{{$invoice->due_date}}</td>
                                <td>{{$invoice->created_at->diffForHumans()}}</td>
                                <td class="text-right">
                                    <a href="{{route('invoices.show', $invoice)}}" class="btn btn-primary btn-sm">View</a>
                                    <a href="{{route('invoices.edit', $invoice)}}" class="btn btn-warning btn-sm">Retur</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="o_nocontent_help">
                <p class="o_view_nocontent_smiling_face">
                    <img src="{{asset('images/icons/smiling_face.svg')}}" alt=""><br>
                    Create a customer invoice
                </p>
                <p>
                    Create invoices, register payments and keep track of the discussions with your customers.
                </p>
            </div>
            @endif
        </div>
        <!-- </div> -->
    </div>
    <div class="row mx-4">
        {!! $invoices->render() !!}
    </div>
</div>
@endsection
@section('js')
<script>
    $('a#invoices').addClass('mm-active');
    $("#key").change(function() {
    var value = $("#key").val();
    $("input[name='filter']").val(value);
});
</script>
@endsection
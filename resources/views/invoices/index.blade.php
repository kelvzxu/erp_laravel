@extends('layouts.admin')
@section('title','Customer Invoice')
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
                            <span class="o_pager_value">{{$invoices->total()}}</span> / <span class="o_pager_limit">{{$invoices->perPage()}}</span>
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
    <!-- <div class="o-content"> -->
    <div class="tab-content">
        <div class="tab-pane active" id="notebook_page_511">
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
                                <th scope="col">status</th>
                                <th scope="col" colspan="2">Created At</th>
                            </tr>
                        </thead> 
                        <tbody> 
                            @foreach($invoices as $invoice)
                                <tr class="table-row" data-href="{{route('invoices.show', $invoice)}}">
                                    <td>{{$invoice->invoice_no}}</td>
                                    @if ($invoice->partner->currency->position == "before")
                                        <td>{{$invoice->partner->currency->symbol}} {{ number_format($invoice->grand_total)}}</td>
                                    @else
                                        <td>{{ number_format($invoice->grand_total)}} {{$invoice->partner->currency->symbol}}</td>
                                    @endif
                                    <td>{{$invoice->name}}</td> 
                                    <td>{{$invoice->invoice_date}}</td>
                                    <td>{{$invoice->due_date}}</td>
                                    <td>
                                        @if($invoice->status == "Pending" ) 
                                            <div class="mb-2 mr-2 badge badge-pill badge-warning text-white">Pending...</div>
                                            <!-- <a class="btn btn-warning btn-sm text-white">Pending...</a> -->
                                        @endif
                                        @if($invoice->status == "Complete" ) 
                                            <div class="mb-2 mr-2 badge badge-pill badge-success">Complete</div>
                                            <!-- <a class="btn btn-success btn-sm text-white">Complete</a> -->
                                        @endif
                                    </td>
                                    <td>{{$invoice->created_at->diffForHumans()}}</td>
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
        </div>
        <div class="tab-pane" id="notebook_page_521">
            @if($invoices->count())
                <div class="o_kanban_view o_kanban_mobile o_kanban_ungrouped">
                @foreach($invoices as $invoice)
                    <div class="oe_kanban_card oe_kanban_global_click o_kanban_record" modifiers="{}" tabindex="0" role="article">
                        <div class="o_kanban_record_top mb16" modifiers="{}">
                            <div class="o_kanban_record_headings mt4" modifiers="{}">
                                <strong class="o_kanban_record_title" modifiers="{}"><span modifiers="{}">{{$invoice->name}}</span></strong>
                            </div>
                            @if ($invoice->partner->currency->position == "before")
                                <strong modifiers="{}"><span class="o_field_monetary o_field_number o_field_widget"
                                    name="amount_total">{{$invoice->partner->currency->symbol}}&nbsp;{{ number_format($invoice->grand_total)}}</span></strong>
                            @else
                                <strong modifiers="{}"><span class="o_field_monetary o_field_number o_field_widget"
                                    name="amount_total">{{ number_format($invoice->grand_total)}}&nbsp;{{$invoice->partner->currency->symbol}}</span></strong>
                            @endif
                        </div>
                        <a class="o_kanban_record_bottom" modifiers="{}" href="{{route('invoices.show', $invoice)}}">
                            <div class="oe_kanban_bottom_left text-muted" modifiers="{}">
                                <span modifiers="{}">{{$invoice->invoice_no}}<br>{{$invoice->created_at}}</span>
                                <div class="o_kanban_inline_block dropdown o_kanban_selection o_mail_activity o_field_widget"
                                    name="activity_ids">
                                </div>
                            </div>
                            <div class="oe_kanban_bottom_right" modifiers="{}">
                                <div name="state" class="o_field_widget badge badge-default">
                                    @if($invoice->status == "Pending" ) 
                                        <div class="mb-2 mr-2 badge badge-pill badge-warning text-white"><span style="font-size:10px;">Pending</span></div>
                                    @endif
                                    @if($invoice->status == "Complete" ) 
                                        <div class="mb-2 mr-2 badge badge-pill badge-success"><span style="font-size:10px;">Complete</span></div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                <?php 
                    $ghost=30-count($invoices);
                    for ($x = 0; $x < $ghost; $x++){
                        echo"<div class='o_kanban_record o_kanban_ghost'></div>";
                    }
                ?>
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
    </div>
    <div class="row mx-4">
        {!! $invoices->render() !!}
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('js/asset_common/invoice.js')}}"></script>
@endsection
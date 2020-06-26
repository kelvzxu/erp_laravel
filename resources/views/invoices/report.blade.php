@extends('layouts.admin')
@section('title','Report - Customer Invoice')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="app-page-title bg-white">
    <div class="o_control_panel">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('invoices.report')}}">Invoices Report</a></li>
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
                        <button type="button" class="btn btn-secondary o_button_import">
                            Import
                        </button>
                    </div>
                </div>
                <aside class="o_cp_sidebar">
                    <div class="btn-group">
                        <div class="btn-group o_dropdown">
                            <a class="o_dropdown_toggler_btn btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                Print
                            </a>
                            
                            <div class="dropdown-menu o_dropdown_menu" role="menu">
                                <a href="{{route('invoices_report.print')}}" class="dropdown-item undefined"><i class="fa fa-print"></i>&nbsp;Print Report</a>     
                            </div>
                        </div>

                        <div class="btn-group o_dropdown" style="display: none;">
                            <button class="o_dropdown_toggler_btn btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> 
                                Action
                            </button>
                            
                            <div class="dropdown-menu o_dropdown_menu" role="menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                                <button type="button" class="dropdown-item undefined" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-trash"> Delete Record</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </aside>
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
                            <span class="o_pager_value">1</span> / <span class="o_pager_limit">1</span>
                        </span>
                        <span class="btn-group d-none" aria-atomic="true">
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
    <div class="row mx-2 mt-2">
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 bg-midnight-bloom">
                <div class="widget-content text-white">
                    <div class="col-6 pull-left text-left">
                        <div class="widget-heading"><h3>Income This Month</h3></div>
                    </div>
                    <div class="col-6 pull-right text-right">
                        <div class="widget-numbers text-white"><h5>Rp. {{ number_format($income)}}</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 bg-danger">
                <div class="widget-content text-white">
                    <div class="col-7 pull-left text-left">
                        <div class="widget-heading"><h3>Unpaid Invoices  </h3></div>
                    </div>
                    <div class="col-5 pull-right text-right">
                        <div class="widget-numbers text-white"><h5>{{$unpaid}}</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 bg-warning">
                <div class="widget-content text-white">
                    <div class="col-8 pull-left text-left">
                        <div class="widget-heading"><h3>Invoice to Approved</h3></div>
                    </div>
                    <div class="col-4 pull-right text-right">
                        <div class="widget-numbers text-white"><h5>{{$notvalidate}}</h5></div>
                    </div>
                </div>
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
                            <th scope="col">Date</th>
                            <th scope="col">Invoice No</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Sales Person</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Total</th> 
                            <th scope="col">Due Amount</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead> 
                    <tbody> 
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{$invoice->invoice_date}}</td>
                                <td>{{$invoice->invoice_no}}</td>
                                <td>{{$invoice->name}}</td>
                                <td>{{$invoice->employee_name}}</td>
                                <td>Rp. {{ number_format($invoice->discount)}}</td>
                                <td>Rp. {{ number_format($invoice->grand_total)}}</td>
                                <td>Rp. {{ number_format($invoice->grand_total-$invoice->payment)}}</td>
                                <td>
                                    @if(($invoice->grand_total-$invoice->payment)==0) 
                                        <div class="mb-2 mr-2 badge badge-pill badge-success">PAID</div>
                                        <!-- <a class="btn btn-warning btn-sm text-white">Pending...</a> -->
                                    @endif
                                    @if(($invoice->grand_total-$invoice->payment)!=0) 
                                        <div class="mb-2 mr-2 badge badge-pill badge-danger">UNPAID</div>
                                        <!-- <a class="btn btn-success btn-sm text-white">Complete</a> -->
                                    @endif
                                </td>
                                <td class="text-right">
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
    <!-- <div class="o_kanban_view o_kanban_mobile o_kanban_ungrouped">
        <div class="oe_kanban_card oe_kanban_global_click o_kanban_record" modifiers="{}" tabindex="0" role="article">
            <div class="o_kanban_record_top mb16" modifiers="{}">
                <div class="o_kanban_record_headings mt4" modifiers="{}">
                    <strong class="o_kanban_record_title" modifiers="{}"><span modifiers="{}">Wilmar Consultancy Services,
                            Kelvin Leonardi</span></strong>
                </div>
                <strong modifiers="{}"><span class="o_field_monetary o_field_number o_field_widget"
                        name="amount_total">¥&nbsp;1,353.00</span></strong>
            </div>
            <div class="o_kanban_record_bottom" modifiers="{}">
                <div class="oe_kanban_bottom_left text-muted" modifiers="{}">
                    <span modifiers="{}">S00001 04/16/2020 22:24:19</span>
                    <div class="o_kanban_inline_block dropdown o_kanban_selection o_mail_activity o_field_widget"
                        name="activity_ids">
                        <a class="dropdown-toggle o-no-caret o_activity_btn" data-toggle="dropdown" role="button">

                            <span role="img" class="fa fa-lg fa-fw o_activity_color_default fa-clock-o"></span>
                        </a>
                        <div class="dropdown-menu o_activity" role="menu"></div>
                    </div>
                </div>
                <div class="oe_kanban_bottom_right" modifiers="{}">
                    <div name="state" class="o_field_widget badge badge-default">Cancelled</div>
                </div>
            </div>
        </div>
        <div class="oe_kanban_card oe_kanban_global_click o_kanban_record" modifiers="{}" tabindex="0" role="article">
            <div class="o_kanban_record_top mb16" modifiers="{}">
                <div class="o_kanban_record_headings mt4" modifiers="{}">
                    <strong class="o_kanban_record_title" modifiers="{}"><span modifiers="{}">Wilmar Consultancy Services,
                            Kelvin Leonardi</span></strong>
                </div>
                <strong modifiers="{}"><span class="o_field_monetary o_field_number o_field_widget"
                        name="amount_total">¥&nbsp;1,353.00</span></strong>
            </div>
            <div class="o_kanban_record_bottom" modifiers="{}">
                <div class="oe_kanban_bottom_left text-muted" modifiers="{}">
                    <span modifiers="{}">S00001 04/16/2020 22:24:19</span>
                    <div class="o_kanban_inline_block dropdown o_kanban_selection o_mail_activity o_field_widget"
                        name="activity_ids">
                        <a class="dropdown-toggle o-no-caret o_activity_btn" data-toggle="dropdown" role="button">

                            <span role="img" class="fa fa-lg fa-fw o_activity_color_default fa-clock-o"></span>
                        </a>
                        <div class="dropdown-menu o_activity" role="menu"></div>
                    </div>
                </div>
                <div class="oe_kanban_bottom_right" modifiers="{}">
                    <div name="state" class="o_field_widget badge badge-default">Cancelled</div>
                </div>
            </div>
        </div>
    </div> -->
</div>
@endsection
@section('js')
<script>
    $('a#accounting_reports').addClass('mm-active');
    $('a#sales_report').addClass('mm-active');
    $('#report_invoice_accounting').addClass('mm-active');
    $('#report_invoice').addClass('mm-active');
    $("#report-invoice").change(function() {
    var value = $("#key").val();
    $("input[name='filter']").val(value);
});
</script>
@endsection 
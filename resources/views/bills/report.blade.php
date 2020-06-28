@extends('layouts.admin')
@section('title','Report - Vendor Bill')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="app-page-title bg-white">
    <div class="o_control_panel">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('purchases.report')}}">Vendor Bills Report</a></li>
            </ol>
            <div class="o_cp_searchview" role="search">
                <div class="o_searchview" role="search" aria-autocomplete="list">
                    <form action="{{ route('purchases.filter') }}" method="get" >
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
                                <a href="{{route('purchases_report.print')}}" class="dropdown-item undefined"><i class="fa fa-print"></i>&nbsp;Print Report</a>     
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
                        <div class="widget-heading"><h3>expenses This Month</h3></div>
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
                        <div class="widget-heading"><h3>Unpaid <br>Bills</h3></div>
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
                        <div class="widget-heading"><h3>Bills to <br>Posted  </h3></div>
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
            @if($purchases->count())
            <div class="table-responsive-lg mb-4">
                <table class="table table-striped">
                    <thead class="table table-sm">
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Purchase No</th>
                            <th scope="col">Vendors</th>
                            <th scope="col">Merchandise</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Total</th> 
                            <th scope="col">Due Amount</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead> 
                    <tbody> 
                        @foreach($purchases as $purchase)
                            <tr>
                                <td>{{$purchase->purchase_date}}</td>
                                <td>{{$purchase->purchase_no}}</td>
                                <td>{{$purchase->partner_name}}</td>
                                <td>{{$purchase->employee_name}}</td>
                                <td>Rp. {{ number_format(- $purchase->discount)}}</td>
                                <td>Rp. {{ number_format(- $purchase->grand_total)}}</td>
                                <td>Rp. {{ number_format(- $purchase->grand_total-$purchase->payment)}}</td>
                                <td>
                                    @if(($purchase->grand_total-$purchase->payment)==0) 
                                        <div class="mb-2 mr-2 badge badge-pill badge-success">PAID</div>
                                        <!-- <a class="btn btn-warning btn-sm text-white">Pending...</a> -->
                                    @endif
                                    @if(($purchase->grand_total-$purchase->payment)!=0) 
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
                    Create a Vendors Bill
                </p>
                <p>
                    Create purchases, register payments and keep track of the discussions with your Vendors.
                </p>
            </div>
            @endif
        </div>
        <!-- </div> -->
    </div>
</div>
@endsection
@section('js')
<script>
    $('a#accounting_reports').addClass('mm-active');
    $('a#report_purchases').addClass('mm-active');
    $("#report_purchases").change(function() {
    var value = $("#key").val();
    $("input[name='filter']").val(value);
});
</script>
@endsection
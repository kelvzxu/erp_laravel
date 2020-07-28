@extends('layouts.admin')
@section('title','Report - CustomerDebt')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="app-page-title bg-white">
    <div class="o_control_panel">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('CustomerDebt.report')}}">Report Customer Debt</a></li>
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

                        <button type="button" class="btn btn-secondary">
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
                                <a href="{{route('CustomerDebt_report.print')}}" class="dropdown-item undefined"><i class="fa fa-print"></i>&nbsp;Print Report</a>     
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
                                <option value="name">Name</option>
                                <!-- <span class="fa fa-filter"></span> Filters -->
                            </select>
                        </div>
                    </div>
                </div>
                <nav class="o_cp_pager" role="search" aria-label="Pager">
                    <div class="o_pager">
                        <span class="o_pager_counter">
                            <span class="o_pager_value">{{$customer->total()}}</span> / <span class="o_pager_limit">{{$customer->perPage()}}</span>
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
                    <button type="button" accesskey="k" class="btn btn-secondary fa fa-lg fa-th-large o_cp_switch_kanban" 
                        aria-label="View kanban" data-view-type="kanban" title="" tabindex="-1" 
                        data-original-title="View kanban"></button>
                    <button type="button" class="btn btn-secondary fa fa-lg fa-bar-chart o_cp_switch_graph "
                        aria-label="View graph" data-view-type="graph" title="" tabindex="-1"
                        data-original-title="View graph"></button>
                </nav>
            </div>
        </div>
    </div>
    <div class="row mx-2 mt-2">
        <div class="col-md-6 col-xl-6">
            <div class="card mb-3 bg-success">
                <div class="widget-content text-white">
                    <div class="col-6 pull-left text-left">
                        <div class="widget-heading"><h3>Total Credit Value</h3></div>
                    </div>
                    <div class="col-6 pull-right text-right">
                        <div class="widget-numbers text-white"><h5>Rp. {{ number_format($credit)}}</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-6">
            <div class="card mb-3 bg-danger">
                <div class="widget-content text-white">
                    <div class="col-6 pull-left text-left">
                        <div class="widget-heading"><h3>Total Debit Value</h3></div>
                    </div>
                    <div class="col-6 pull-right text-right">
                        <div class="widget-numbers text-white"><h5>Rp. {{ number_format($debit)}}</h5></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="o-content">
        <div class="panel-body ml-2">
            @if($customer->count())
            <div class="table-responsive-lg mb-4">
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
                </table>
            </div>
            @else
            <div class="o_nocontent_help">
                <p class="o_view_nocontent_smiling_face">
                    <img src="{{asset('images/icons/smiling_face.svg')}}" alt=""><br>
                    Product List Is Empty
                </p>
            </div>
            @endif
        </div>
    </div>
    <div class="row mx-4">
        {!! $customer->render() !!}
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
$('a#sales_report').addClass('mm-active');
$("#key").change(function() {
    var value = $("#key").val();
    $("input[name='filter']").val(value);
});
</script>
@endsection

@extends('layouts.admin')
@section('title','Sales - Quotation')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<div id="sales" class="app-page-title bg-white">
    <div class="o_control_panel">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('sales_orders')}}">Quotation</a></li>
            </ol>
            <div class="o_cp_searchview" role="search">
                <div class="o_searchview" role="search" aria-autocomplete="list">
                    <!-- <form action="{{ route('sales_orders.filter') }}" method="get" > -->
                        <button class="o_searchview_more fa fa-search-minus" title="Advanced Search..." role="img"
                            aria-label="Advanced Search..." type="submit"></button>

                        <div class="o_searchview_input_container">
                            <input type="text" class="o_searchview_input" placeholder="Search..."
                                v-model="search" name="value">
                            <input type="hidden" class="o_searchview_input" accesskey="Q" placeholder="key"
                            role="searchbox" aria-haspopup="true" name="filter">
                            <div class="dropdown-menu o_searchview_autocomplete" role="menu"></div>
                        </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
        <div>
            <div class="o_cp_left">
                <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                    <div>
                        <a type="button" class="btn btn-primary o-kanban-button-new" accesskey="c" href="{{route('sales_orders.create')}}">
                            Create
                        </a>

                        <button type="button" class="btn btn-secondary o_button_import">
                            Import
                        </button>
                    </div>
                </div>
            </div>
            <div class="o_cp_right">
                
                <nav class="o_cp_pager" role="search" aria-label="Pager">
                    <div class="o_pager o_hidden">
                        <span class="o_pager_counter">
                            <span class="o_pager_value">@{{pagination.from}} - @{{pagination.to}}</span> / <span class="o_pager_limit">@{{pagination.total}}</span>
                        </span>

                        <span class="btn-group" aria-atomic="true">   
                            <a type="button" v-if="pagination.prevPage" @click="--pagination.currentPage"
                            class="fa fa-chevron-left btn o_pager_previous"></a>
                            <a type="button" v-else disabled
                            class="fa fa-chevron-left btn o_pager_previous"></a>
                            <a type="button" v-if="pagination.nextPage" @click="++pagination.currentPage"
                            class="fa fa-chevron-right btn o_pager_next"></a>
                            <a type="button" v-else disabled
                            class="fa fa-chevron-right btn o_pager_next"></a>
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
    <div class="tab-content">
        <div class="tab-pane active" id="notebook_page_511">
            <div class="panel-body ml-2">

                <div v-if="pagination.total != 0 " class="table-responsive-lg mb-4">
                    <table class="table table-striped">
                        <thead class="table table-sm">
                            <tr>
                                <th v-for="column in columns" :key="column.name" scope="col" @click="sortBy(column.name)"
                                :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'o_sorting_asc' : 'o_sorting_desc') : 'sorting'" style="cursor:pointer;">
                                @{{column.label}}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="row in  paginatedSales" class="table-row" @click="show(row)">
                                <td>@{{row.order_no}}</td>
                                <td>@{{row.name}}</td>
                                <td>@{{row.order_date}}</td>
                                <td>@{{row.employee_name}}</td>
                                <td v-if="row.partner.currency.position == 'before'">@{{row.partner.currency.symbol}}&nbsp;@{{row.grand_total | formatNumber}}</td>
                                <td v-if="row.partner.currency.position == 'after'">@{{row.grand_total | formatNumber}}&nbsp;@{{row.partner.currency.symbol}}</td>
                                <td>
                                    <div v-if="row.status == 'Quotation'" class="mb-2 mr-2 badge badge-pill badge-warning text-white">Quotation</div>
                                    <div v-if="row.status == 'SO'" class="mb-2 mr-2 badge badge-pill badge-success">Sales Order</div>
                                </td>
                                <td>@{{row.created_at | moment }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else class="o_nocontent_help">
                    <p class="o_view_nocontent_smiling_face">
                        <img src="{{asset('images/icons/smiling_face.svg')}}" alt=""><br>
                        Create a new quotation, the first step of a new sale!
                    </p>
                    <p>
                        Once the quotation is confirmed by the customer, it becomes a sales order.
                        You will be able to create an invoice and collect the payment.
                    </p>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="notebook_page_521">
            <div v-if="pagination.total != 0 " class="o_kanban_view o_kanban_mobile o_kanban_ungrouped">
                <div v-for="row in  paginatedSales" class="oe_kanban_card oe_kanban_global_click o_kanban_record" @click="show(row)">
                    <div class="o_kanban_record_top mb16">
                        <div class="o_kanban_record_headings mt4">
                            <strong class="o_kanban_record_title"><span>@{{row.partner.name}}</span></strong>
                        </div>
                            <strong>
                                <span v-if="row.partner.currency.position == 'before'" class="o_field_monetary o_field_number o_field_widget"
                                    name="amount_total">@{{row.partner.currency.symbol}}&nbsp;@{{row.grand_total | formatNumber}}</span>
                            </strong>
                            <strong>
                                <span v-if="row.partner.currency.position == 'after'" class="o_field_monetary o_field_number o_field_widget"
                                    name="amount_total">@{{row.grand_total | formatNumber}}&nbsp;@{{row.partner.currency.symbol}}</span>
                            </strong>
                    </div>
                    <a class="o_kanban_record_bottom">
                        <div class="oe_kanban_bottom_left text-muted">
                            <span>@{{row.purchase_no}}<br>@{{row.created_at}}</span>
                            <div class="o_kanban_inline_block dropdown o_kanban_selection o_mail_activity o_field_widget"
                                name="activity_ids">
                            </div>
                        </div>
                        <div class="oe_kanban_bottom_right">
                            <div name="state" class="o_field_widget badge badge-default">
                                <div v-if="row.status == 'Quotation'" class="mb-2 mr-2 badge badge-pill badge-warning text-white"><span style="font-size:10px;">Quotation></div>
                                <div v-if="row.status == 'SO'" class="mb-2 mr-2 badge badge-pill badge-success"><span style="font-size:10px;">Sales Order</span></div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php 
                    $ghost=30-count($orders);
                    for ($x = 0; $x < $ghost; $x++){
                        echo"<div class='o_kanban_record o_kanban_ghost'></div>";
                    }
                ?>
            </div>
            <div v-else class="o_nocontent_help">
                <p class="o_view_nocontent_smiling_face">
                    <img src="{{asset('images/icons/smiling_face.svg')}}" alt=""><br>
                    Create a new quotation, the first step of a new sale!
                </p>
                <p>
                    Once the quotation is confirmed by the customer, it becomes a sales order.
                    You will be able to create an invoice and collect the payment.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('js/asset_common/sales.js')}}"></script>

@endsection
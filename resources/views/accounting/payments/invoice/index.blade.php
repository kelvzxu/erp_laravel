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
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('payment_invoices.index')}}">Payments</a></li>
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
                        <a type="button" class="btn btn-primary o-kanban-button-new" accesskey="c" href="{{route('payment_invoices.create')}}">
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
    <div class="tab-content">
        <div class="tab-pane active" id="notebook_page_511">
            <div class="panel-body ml-2">
                @if($data->count())
                <div class="table-responsive-lg mb-4">
                    <table class="table table-striped">
                        <thead class="table table-sm">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Name</th>
                                <th scope="col">Journal</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Company</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $row)
                                <tr class="table-row" data-href="{{route('payment.view', $row)}}">
                                    <td>{{$row->payment_date}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->journal->name}}</td>
                                    <td>{{$row->payment_method_id}}</td>
                                    <td>{{$row->partner->name}}</td>
                                    <td>Rp. {{ number_format($row->amount)}}</td>
                                    <td>
                                        @if($row->state == "draft" ) 
                                            <div class="mb-2 mr-2 badge badge-pill badge-warning text-white"><span style="font-size:10px;">Pending</span></div>
                                        @endif
                                        @if($row->state == "posted" ) 
                                            <div class="mb-2 mr-2 badge badge-pill badge-success"><span style="font-size:10px;">Validate</span></div>
                                        @endif
                                    </td>
                                    <td>{{$row->company->company_name}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="o_nocontent_help">
                    <p class="o_view_nocontent_smiling_face">
                        <img src="{{asset('images/icons/smiling_face.svg')}}" alt=""><br>
                        Register a payment
                    </p>
                    <p>
                        Payments are used to register liquidity movements. You can process those payments by your <br> own means or by using installed facilities. 
                    </p>
                </div>
                @endif
            </div>
        </div>
        <div class="tab-pane" id="notebook_page_521">
            @if($data->count())
                <div class="o_kanban_view o_kanban_mobile o_kanban_ungrouped">
                @foreach($data as $row)
                    <div class="oe_kanban_card oe_kanban_global_click o_kanban_record" modifiers="{}" tabindex="0" role="article">
                        <div class="o_kanban_record_top mb16" modifiers="{}">
                            <div class="o_kanban_record_headings mt4" modifiers="{}">
                                <strong class="o_kanban_record_title" modifiers="{}"><span modifiers="{}">{{$row->name}}</span></strong>
                            </div>
                            <strong modifiers="{}"><span class="o_field_monetary o_field_number o_field_widget"
                                    name="amount_total"><i class="fa fa-clock">&nbsp;{{$row->payment_date}}</i></span></strong>
                        </div>
                        <a class="o_kanban_record_bottom" modifiers="{}" href="{{route('payment.view', $row)}}">
                            <div class="oe_kanban_bottom_left text-muted" modifiers="{}">
                                <span modifiers="{}">{{$row->partner->name}}<br>Rp. {{ number_format($row->amount)}}</span>
                                <div class="o_kanban_inline_block dropdown o_kanban_selection o_mail_activity o_field_widget"
                                    name="activity_ids">
                                </div>
                            </div>
                            <div class="oe_kanban_bottom_right" modifiers="{}">
                                <div name="state" class="o_field_widget badge badge-default">
                                    @if($row->state == "draft" ) 
                                        <div class="mb-2 mr-2 badge badge-pill badge-warning text-white"><span style="font-size:10px;">Pending</span></div>
                                    @endif
                                    @if($row->state == "posted" ) 
                                        <div class="mb-2 mr-2 badge badge-pill badge-success"><span style="font-size:10px;">Validate</span></div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                <?php 
                    $ghost=30-count($data);
                    for ($x = 0; $x < $ghost; $x++){
                        echo"<div class='o_kanban_record o_kanban_ghost'></div>";
                    }
                ?>
                </div>
            @else
                <div class="o_nocontent_help">
                    <p class="o_view_nocontent_smiling_face">
                        <img src="{{asset('images/icons/smiling_face.svg')}}" alt=""><br>
                        Register a payment
                    </p>
                    <p>
                        Payments are used to register liquidity movements. You can process those payments by your <br> own means or by using installed facilities. 
                    </p>
                </div>
            @endif
        </div>
    </div>
    <div class="row mx-4">
        {!! $data->render() !!}
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('js/asset_common/payment.js')}}"></script>
@endsection
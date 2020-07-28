@extends('layouts.admin')
@section('title','Partner - Vendors')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="app-page-title bg-white">
    <div class="o_control_panel">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('partner')}}">Vendors</a></li>
            </ol>
            <div class="o_cp_searchview" role="search">
                <div class="o_searchview" role="search" aria-autocomplete="list">
                    <form action="{{ route('partner.filter') }}" method="get" >
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
                        <a type="button" class="btn btn-primary o-kanban-button-new" accesskey="c" href="{{route('partner.new')}}">
                            Create
                        </a>

                        <button type="button" class="btn btn-secondary">
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
                                <option value="display_name">Name</option>
                                <option value="parent_id">Company Name</option>
                                <option value="city">City</option>
                                <option value="country_name">Country</option>
                                <!-- <span class="fa fa-filter"></span> Filters -->
                            </select>
                        </div>
                    </div>
                </div>
                <nav class="o_cp_pager" role="search" aria-label="Pager">
                    <div class="o_pager">
                        <span class="o_pager_counter">
                            <span class="o_pager_value">{{$partner->total()}}</span> / <span class="o_pager_limit">{{$partner->perPage()}}</span>
                        </span>
                        <span class="btn-group d-none" aria-atomic="true">
                            <button type="button" class="fa fa-chevron-left btn btn-secondary o_pager_previous"
                                accesskey="p" aria-label="Previous" title="Previous" tabindex="-1"></button>
                            <button type="button" class="fa fa-chevron-right btn btn-secondary o_pager_next"
                                accesskey="n" aria-label="Next" title="Next" tabindex="-1"></button>
                        </span>
                    </div>
                </nav>
                <nav class="btn-group o_cp_switch_buttons nav" role="toolbar" aria-label="View switcher">
                    <a data-toggle="tab" disable_anchor="true" href="#notebook_page_511"
                                class="nav-link btn btn-secondary fa fa-lg fa-th-large o_cp_switch_kanban active" role="tab"></a>
                    <a data-toggle="tab" disable_anchor="true" href="#notebook_page_521"
                                class="nav-link btn btn-secondary fa fa-lg fa-list-ul o_cp_switch_list" role="tab" aria-selected="true"></a></li>
                </nav>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="notebook_page_511">
            @if($partner->count())
                <div class="o_kanban_view o_res_partner_kanban o_kanban_ungrouped">
                    @foreach($partner as $row)
                    <a class="oe_kanban_global_click o_kanban_record_has_image_fill o_res_partner_kanban o_kanban_record" modifiers="{}"
                        tabindex="0" role="article" style="color: black;text-decoration: none;" href="{{ route('partner.show', $row->id) }}">
                        @if (!empty($row->logo))
                        <div class="o_kanban_image_fill_left o_kanban_image_full"
                            style="background-image: url('{{asset('uploads/Partners/'.$row->logo)}}')"
                            role="img" modifiers="{}"></div>
                        @else
                        <div class="o_kanban_image_fill_left o_kanban_image_full"  
                            style="background-image: url('images/icons/company_image.png')"
                            role="img" modifiers="{}"></div>
                        @endif
                        <div class="oe_kanban_details" modifiers="{}">
                            <strong class="o_kanban_record_title oe_partner_heading" modifiers="{}"><span>{{$row->display_name}}</span></strong>
                            <div class="o_kanban_tags_section oe_kanban_partner_categories" modifiers="{}">
                                <span class="oe_kanban_list_many2many" modifiers="{}">
                                    @if (!empty($row->parent_id))
                                        <div class="o_field_many2manytags o_field_widget o_kanban_tags" name="category_id"><span
                                            class="o_tag o_tag_color_7"><span></span>{{$row->parent_id}}</span></div>
                                    @else
                                        <div class="o_field_many2manytags o_field_widget o_kanban_tags" name="category_id"><span
                                            class="o_tag o_tag_color_7"><span></span>individual</span></div>
                                    @endif
                                </span>
                            </div>
                            <ul modifiers="{}">
                                <li modifiers="{}"><span>{{$row->city}}</span>, <span>{{$row->country_name}}</span></li>
                                <li class="o_text_overflow" modifiers="{}"><span>{{$row->email}}</span></li>
                            </ul>
                            <div class="oe_kanban_partner_links" modifiers="{}">
                                <span class="badge badge-pill" modifiers="{}"><i class="fa fa-fw fa-star" aria-label="Favorites" role="img"
                                        title="Favorites" modifiers="{}"></i>3</span>
                                <span class="badge badge-pill" modifiers="{}"><i class="fa fa-fw fa-usd" role="img" aria-label="Sale orders"
                                        title="Sales orders" modifiers="{}"></i>{{ number_format($row->debit)}}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    <?php 
                        $ghost=30-count($partner);
                        for ($x = 0; $x < $ghost; $x++){
                            echo"<div class='o_kanban_record o_kanban_ghost'></div>";
                        }
                    ?>
                </div>
            @else
                <div class="o_nocontent_help">
                    <p class="o_view_nocontent_smiling_face">
                        <img src="{{asset('images/icons/smiling_face.svg')}}" alt=""><br>
                        Create a new customer in your address book
                    </p>
                    <p>
                        We helps you easily track all activities related to a customer.
                    </p>
                </div>
            @endif
        </div>
        <div class="tab-pane" id="notebook_page_521">
            <div class="panel-body ml-2">
                @if($partner->count())
                <div class="table-responsive-lg mb-4">
                    <table class="table">
                        <thead class="table table-sm">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">city</th>
                                <th scope="col">Phone</th>
                                <th scope="col">country</th>
                                <th scope="col">website</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        @foreach($partner as $row)
                        <tbody>
                            <tr >
                            <tr class="table-row"data-href="{{ route('partner.show', $row->id) }}">
                                <td scope="row">{{$loop->iteration}}</td>
                                <td >{{$row->display_name}}</td>
                                <td >
                                    @if (!empty($row->parent_id))
                                        {{$row->display_name}}
                                    @else 
                                        <div>Individual</div>
                                    @endif
                                </td>
                                <td >{{$row->phone}}</td>
                                <td >{{$row->city}}</td>
                                <td >{{$row->country_name}}</td>
                                <td ><a href="https://{{$row->website}}">{{$row->website}}</a></td>
                                <td >{{$row->email}}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
                @else
                <div class="o_nocontent_help">
                    <p class="o_view_nocontent_smiling_face">
                        <img src="{{asset('images/icons/smiling_face.svg')}}" alt=""><br>
                        Create a new Vendors in your address book
                    </p>
                    <p>
                        We helps you easily track all activities related to a Vendors.
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row mx-4">
        {!! $partner->render() !!}
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('js/asset_common/vendor.js')}}"></script>
@endsection
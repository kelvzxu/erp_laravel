@extends('layouts.admin')
@section('title','Apps')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="app-page-title bg-white">
    <div class="o_control_panel">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('Apps.index')}}">Apps</a></li>
            </ol>
            <div class="o_cp_searchview" role="search">
                <div class="o_searchview" role="search" aria-autocomplete="list">
                    <form action="{{ route('product.filter') }}" method="get" >
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
                                <option value="name">Name</option>
                                <!-- <span class="fa fa-filter"></span> Filters -->
                            </select>
                        </div>
                    </div>
                </div>
                <nav class="o_cp_pager" role="search" aria-label="Pager">
                    <div class="o_pager">
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
            <div class="o_kanban_view o_kanban_ungrouped">
                @if($data->count())
                    @foreach ($data as $row)
                    <div class="oe_module_vignette o_kanban_record" modifiers="{}" tabindex="0" role="article"> 
                        <div class="o_dropdown_kanban dropdown" tabindex="-1" modifiers="{}">
                            <a class="dropdown-toggle o-no-caret btn" data-toggle="dropdown" data-display="static" href="#" role="button" aria-label="Dropdown menu" title="Dropdown menu" modifiers="{}">
                                <span class="fa fa-ellipsis-v" modifiers="{}"></span>
                            </a>
                            <div class="dropdown-menu" role="menu" aria-labelledby="dLabel" modifiers="{}">
                                <a class="dropdown-item oe_kanban_action oe_kanban_action_a" modifiers="{}" data-type="edit" href="#">Module Info</a>
                                @if ($row->instalation == false)
                                    <a href="{{route('Apps.install',$row->id)}}" class="dropdown-item oe_kanban_action oe_kanban_action_a">Install</a>
                                @else
                                <a href="" class="dropdown-item oe_kanban_action oe_kanban_action_a">Uninstall</a>
                                @endif
                            </div>
                        </div>
                        <img src="{{asset('images/apps/' . $row->icon)}}" class="oe_module_icon" alt="Icon" modifiers="{}">
                        <div class="oe_module_desc" title="{{$row->name}}" modifiers="{}">
                          <h3 class="o_kanban_record_title" modifiers="{}">
                            <span>{{$row->name}}</span>&nbsp;
                          </h3>
                          <p class="oe_module_name" modifiers="{}">
                            <span><small>{{$row->info}}</small></span>                      
                          </p>
                          <div class="oe_module_action" modifiers="{}">
                            @if ($row->instalation == false)
                                <a href="{{route('Apps.install',$row->model)}}" class="btn btn-sm btn-primary float-right" role="button" >Install</a>
                            @else
                                <div class="text-muted float-right" modifiers="{}">Installed</div>
                            @endif
                            <a class="btn btn-secondary btn-sm " data-states="uninstalled" type="button">Learn More</a>         
                          </div>
                        </div>
                      </div>
                    @endforeach
                    <?php 
                    $ghost=30-count($data);
                    for ($x = 0; $x < $ghost; $x++){
                        echo"<div class='o_kanban_record o_kanban_ghost'></div>";
                    }
                ?>
                @else
                <div class="o_nocontent_help">
                    <p class="o_view_nocontent_smiling_face">
                        <img src="{{asset('images/icons/smiling_face.svg')}}" alt=""><br>
                        Create a new Products and Start your trading
                    </p>
                    <p>
                        You must define a product for everything you sell or purchase,
                        whether it's a storable product, a consumable or a service.
                    </p>
                </div>
                @endif
            </div>
        </div>
        <div class="tab-pane" id="notebook_page_521">
            <div class="panel-body ml-2">
                @if($data->count())
                <div class="table-responsive mb-3">
                    <table class="table table-hover">
                        <thead class="table table-sm">
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">On Hands</th>
                                <th scope="col">Price</th>
                                <th scope="col">Category</th>
                                <th scope="col">Last Update</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                            <tr>
                                <td>
                                    @if (!empty($row->photo))
                                        <img src="{{ asset('uploads/product/' . $row->photo) }}" 
                                            alt="{{ $row->name }}" width="50px" height="50px">
                                    @else
                                        <img src="http://via.placeholder.com/50x50" alt="{{ $row->name }}">
                                    @endif
                                </td>
                                <td>
                                    <sup class="label label-success">({{ $row->code }})</sup>
                                    <strong>{{ ucfirst($row->name) }}</strong>
                                </td>
                                <td>{{ $row->stock }}</td>
                                <td>Rp {{ number_format($row->price) }}</td>
                                <td>{{ $row->category }}</td>
                                <td>{{ $row->updated_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="o_nocontent_help">
                    <p class="o_view_nocontent_smiling_face">
                        <img src="{{asset('images/icons/smiling_face.svg')}}" alt=""><br>
                        Create a new Products and Start your trading
                    </p>
                    <p>
                        You must define a product for everything you sell or purchase,
                        whether it's a storable product, a consumable or a service.
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row mx-4">
        {!! $data->render() !!}
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
$('a#product').addClass('mm-active');
$("#key").change(function() {
    var value = $("#key").val();
    $("input[name='filter']").val(value);
});
</script>
@endsection
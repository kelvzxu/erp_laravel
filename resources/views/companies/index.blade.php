@extends('layouts.admin')
@section('title','Companies')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="app-page-title bg-white">
    <div class="o_control_panel">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="companies.index">Companies</a></li>
            </ol>
            <div class="o_cp_searchview" role="search">
                <div class="o_searchview" role="search" aria-autocomplete="list">

                    <button class="o_searchview_more fa fa-search-minus" title="Advanced Search..." role="img"
                        aria-label="Advanced Search..."></button>

                    <div class="o_searchview_input_container">
                        <input type="text" class="o_searchview_input" accesskey="Q" placeholder="Search..."
                            role="searchbox" aria-haspopup="true">
                        <div class="dropdown-menu o_searchview_autocomplete" role="menu"></div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="o_cp_left">
                <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                    <div>
                        <a type="button" class="btn btn-primary o-kanban-button-new" accesskey="c" href="{{route('companies.create')}}">
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
                                data-boundary="viewport" name="filter">
                                <option value="" data-icon="fa fa-filter">Filters</option>
                                <!-- <span class="fa fa-filter"></span> Filters -->
                            </select>
                        </div>
                    </div>
                </div>
                <nav class="o_cp_pager" role="search" aria-label="Pager">
                    <div class="o_pager o_hidden">
                        <span class="o_pager_counter">
                            <span class="o_pager_value">1</span> / <span class="o_pager_limit">5</span>
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
                </nav>
            </div>
        </div>
    </div>
    <div class="o-content">
        <div class="panel-body ml-2">
            @if($companies->count())
            <div class="table-responsive-lg mb-4">
                <table class="table">
                    <thead class="table table-sm">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Company Name</th>
                            <th scope="col">Partner</th>
                        </tr>
                    </thead>
                    @foreach($companies as $data)
                    <tbody>
                        <tr class="table-row"data-href="{{ route ('companies.show',$data->id)}}">
                            <th scope="row">{{$loop->iteration}}
                            <th >{{$data->company_name}}</th>
                            @if ($data->parent_id == "")
                            <th >{{$data->company_name}}</th>
                            @else
                            <th >{{$data->email}}</th>
                            @endif
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            @else
            <div class="o_nocontent_help">
                <p class="o_view_nocontent_smiling_face">
                    <img src="{{asset('images/icons/smiling_face.svg')}}" alt=""><br>
                    Company Is Empty
                </p>
            </div>
            @endif
        </div>
    </div>
    <div class="row mx-4">
        {!! $companies->render() !!}
    </div>
</div>

@endsection
@section('js')
<script>
    $(document).ready(function($) {
        $(".table-row").click(function() {
            window.document.location = $(this).data("href");
        });
    });
</script>
@endsection
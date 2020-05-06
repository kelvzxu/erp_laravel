@extends('layouts.admin')
@section('title','Attendance Log')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="app-page-title bg-white">
    <div class="o_control_panel">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('attendance')}}">Attendance Log</a></li>
            </ol>
            <div class="o_cp_searchview" role="search">
                <div class="o_searchview" role="search" aria-autocomplete="list">
                    <form action="{{ route('attendance.filter') }}" method="get" >
                        <button class="o_searchview_more fa fa-search-minus" title="Advanced Search..." role="img"
                            aria-label="Advanced Search..." type="submit"></button>

                        <div class="o_searchview_input_container">
                            <input type="text" class="o_searchview_input" accesskey="Q" placeholder="Search..."
                                role="searchbox" aria-haspopup="true" name="value">
                            <div class="dropdown-menu o_searchview_autocomplete" role="menu"></div>
                        </div>
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
            </div>
            <div class="o_cp_right">
                <div class="btn-group o_search_options position-static" role="search">
                    <div>
                        <div class="btn-group o_dropdown d-none">
                            <select
                                class=" o_filters_menu_button o_dropdown_toggler_btn btn btn-secondary dropdown-toggle "
                                data-toggle="dropdown" aria-expanded="false" tabindex="-1" data-flip="false"
                                data-boundary="viewport" name="key" id="key">
                                <option value="" data-icon="fa fa-filter">Filters</option>
                                <option value="employee_name">Name</option>
                                <option value="leave_type">Leave Type</option>
                                <!-- <span class="fa fa-filter"></span> Filters -->
                            </select>
                        </div>
                        <button class="o_dropdown_toggler_btn btn btn-secondary dropdown-toggle " data-toggle="dropdown" aria-expanded="true" tabindex="-1" data-flip="false" data-boundary="viewport">
                            <span class="fa fa-filter"></span> Filter 
                        </button>
                        <form action="{{ route('attendance.filter') }}" method="get" >
                            <div class="dropdown-menu o_dropdown_menu o_group_by_menu" role="menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(814px, 75px, 0px);">
                                    <div role="separator" class="dropdown-divider" data-removable="1"></div>
                                    <div class="o_menu_item">
                                        <label for="date_from" class="dropdown-item">Start Date</label>
                                    </div> 
                                    <div class="o_menu_item wrap-input200">
                                        <input class="input200 dropdown-item" type="date" name="start">
                                        </input>
                                    </div>
                                    <div class="o_menu_item">
                                        <label for="date_from" class="dropdown-item">End Date</label>
                                    </div> 
                                    <div class="o_menu_item wrap-input200">
                                        <input class="input200 dropdown-item" type="date" name="end">
                                        </input>
                                    </div>
                                <div role="separator" class="dropdown-divider o_generator_menu"></div>
                                <button type="submit" class="dropdown-item o_generator_menu o_add_custom_group" aria-expanded="false"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <nav class="o_cp_pager" role="search" aria-label="Pager">
                    <div class="o_pager o_hidden">
                        <span class="o_pager_counter">
                            <span class="o_pager_value">{{$attendance->total()}}</span> / <span class="o_pager_limit">{{$attendance->perPage()}}</span>
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
                </nav>
            </div>
        </div>
    </div>
    <div class="o-content">
        <div class="panel-body ml-2">
            @if($attendance->count())
            <div class="table-responsive-lg mb-4">
                <table class="table table-striped">
                    <thead class="table table-sm">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">date</th>
                            <th scope="col">Check In</th>
                            <th scope="col">Check Out</th>
                        </tr>
                    </thead>
                    @foreach($attendance as $data)
                    <tbody>
                        <tr>
                            <th scope="row">{{$loop->iteration}}
                            <th >{{$data->name}}</th>
                            <th >{{$data->date}}</th>
                            <th >{{$data->check_in}}</th>
                            <th >{{$data->check_out}}</th>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            @else
            <div class="o_nocontent_help">
                <p class="o_view_nocontent_smiling_face">
                    <img src="{{asset('images/icons/smiling_face.svg')}}" alt=""><br>
                    Attendance List Is Empty
                </p>
            </div>
            @endif
        </div>
    </div>
    <div class="row mx-4">
        {!! $attendance->render() !!}
    </div>
</div>
@endsection
@section('js')
<script>
$('a#attendance').addClass('mm-active');
$('a#payroll').addClass('mm-active');
$("#key").change(function() {
    var value = $("#key").val();
    $("input[name='filter']").val(value);
});
</script>
@endsection


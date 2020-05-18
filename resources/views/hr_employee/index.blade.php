@extends('layouts.admin')
@section('title','Employees')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="app-page-title bg-white">
    <div class="o_control_panel">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('employee')}}">Employee</a></li>
            </ol>
            <div class="o_cp_searchview" role="search">
                <div class="o_searchview" role="search" aria-autocomplete="list">
                    <form action="{{ route('employee.filter') }}" method="get" >
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
                        <a type="button" class="btn btn-primary o-kanban-button-new" accesskey="c" href="{{route('employee.create')}}">
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
                                <option value="employee_name">Name</option>
                                <option value="department_name">Department</option>
                                <option value="jobs_name">Jobs</option>
                                <option value="city">City</option>
                                <!-- <span class="fa fa-filter"></span> Filters -->
                            </select>
                        </div>
                    </div>
                </div>
                <nav class="o_cp_pager" role="search" aria-label="Pager">
                    <div class="o_pager o_hidden">
                        <span class="o_pager_counter">
                            <span class="o_pager_value">{{$employee->total()}}</span> / <span class="o_pager_limit">{{$employee->perPage()}}</span>
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
            <div class="o_kanban_view o_hr_employee_kanban o_renderer_with_searchpanel o_kanban_ungrouped">
            @if($employee->count())
                @foreach($employee as $data)
                <a class="oe_kanban_global_click o_kanban_record_has_image_fill o_hr_kanban_record o_kanban_record" modifiers="{}"
                    tabindex="0" role="article" style="color: black;text-decoration: none;" href="{{route('employee.edit',$data->id)}}">
                    <div class="o_field_image o_field_widget o_kanban_image_fill_left o_hr_rounded_circle" aria-atomic="true"
                        name="image_128" data-zoom="1"
                        data-zoom-image="{{asset('uploads/Employees/'.$data->photo)}}"
                        style="background-image: url('{{asset('uploads/Employees/'.$data->photo)}}');">
                    </div>
                    <div class="oe_kanban_details" modifiers="{}">
                        <div class="o_kanban_record_top" modifiers="{}">
                            <div class="o_kanban_record_headings" modifiers="{}">
                                <strong class="o_kanban_record_title" modifiers="{}">
                                    <div class="float-right" modifiers="{}">
                                        <span class="fa fa-circle text-success" role="img" aria-label="Absent" title="Absent"
                                            name="presence_absent" modifiers="{}"></span>
                                    </div>
                                    <span>{{$data->employee_name}}</span>
                                </strong>
                                <span class="o_kanban_record_subtitle" modifiers="{}"><span>{{$data->jobs_name}}</span></span>
                            </div>
                            <!-- <i class="fa fa-exclamation-triangle text-danger" role="img"
                                title="There is something wrong with the contract. Either there is no running contract for this employee or employee's contract is about to expire."
                                aria-label="There is something wrong with the contract. Either there is no running contract for this employee or employee's contract is about to expire."
                                modifiers="{}"></i> -->
                        </div>
                        <div class="o_field_many2manytags o_field_widget o_kanban_tags" name="category_ids"><span class="o_tag o_tag_color_2"><span></span>{{$data->department_name}}</span><span class="o_tag o_tag_color_6"><span></span>Employee</span></div>
                        <ul modifiers="{}">
                            <li id="last_login" modifiers="{}">
                            </li>
                            <li class="o_text_overflow" modifiers="{}"><span>{{$data->work_email}}</span></li>
                            <li modifiers="{}"><span>{{$data->work_phone}}</span></li>
                        </ul>
                    </div>
                </a>
                @endforeach
                <?php 
                    $ghost=30-count($employee);
                    for ($x = 0; $x < $ghost; $x++){
                        echo"<div class='o_kanban_record o_kanban_ghost'></div>";
                    }
                ?>
            @else
            <div class="o_nocontent_help">
                <p class="o_view_nocontent_smiling_face">
                    <img src="{{asset('images/icons/smiling_face.svg')}}" alt=""><br>
                    Create Your Employee and Start Your Business
                </p>
            </div>
            @endif
            </div>
        </div>
        <div class="tab-pane" id="notebook_page_521">
            <div class="panel-body ml-2">
                @if($employee->count())
                <div class="table-responsive-lg mb-4">
                    <table class="table table-striped">
                        <thead class="table table-sm">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Employee Name</th>
                                <th scope="col">City</th>
                                <th scope="col">Country</th>
                                <th scope="col">Department</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        @foreach($employee as $data)
                        <tbody>
                            <tr>
                                <td scope="row">{{$loop->iteration}}
                                <td ><img src="{{asset('uploads/Employees/'.$data->photo)}}" width="50px" height="60px"></td>
                                <td >{{$data->employee_name}}</td>
                                <td >{{$data->city}}</td>
                                <td >{{$data->country_name}}</td>
                                <td >{{$data->department_name}}</td>
                                <td >
                                    <a href="{{route('employee.edit',$data->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit">  Edit</i></a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
                @else
                <div class="o_nocontent_help">
                    <p class="o_view_nocontent_smiling_face">
                        <img src="{{asset('images/icons/smiling_face.svg')}}" alt=""><br>
                        Create Your Employee and Start Your Business
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row mx-4">
        {!! $employee->render() !!}
    </div>
</div>
@endsection
@section('js')
<script>
$('a#employee').addClass('mm-active');
$("#key").change(function() {
    var value = $("#key").val();
    $("input[name='filter']").val(value);
});
</script>
@endsection

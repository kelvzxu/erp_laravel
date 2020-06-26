@extends('layouts.admin')
@section('title','Employee - Leave Request')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="app-page-title bg-white">
    <div class="o_control_panel">
        <div>
            <ol class="breadcrumb" role="navigation">
                <li class="breadcrumb-item" accesskey="b"><a href="{{route('leave')}}">Leave Request</a></li>
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
                                <option value="leave_type">Leave Type</option>
                                <!-- <span class="fa fa-filter"></span> Filters -->
                            </select>
                        </div>
                    </div>
                </div>
                <nav class="o_cp_pager" role="search" aria-label="Pager">
                    <div class="o_pager o_hidden">
                        <span class="o_pager_counter">
                            <span class="o_pager_value">{{$leaves->total()}}</span> / <span class="o_pager_limit">{{$leaves->perPage()}}</span>
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
            @if($leaves->count())
            <div class="table-responsive-lg mb-4">
                <table class="table table-striped">
                    <thead class="table table-sm">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Employee name</th>
                            <th scope="col">Leave type</th>
                            <th scope="col">Date from</th>
                            <th scope="col">Date to</th>
                            <th scope="col">No. of days</th>
                            <th scope="col">Reason</th>
                            <th scope="col">Leave type offer</th>
                            <th scope="col">Approve</th>
                        </tr>
                    </thead>
                    @foreach($leaves as $data)
                    <tbody>
                        <tr>
                            <td>{{$loop -> index+1 }}</td>
                            <td>{{$data->name }}</td>
                            <td>{{$data->leave_type}}</td>
                            <td>{{$data->date_from}}</td>
                            <td>{{$data->date_to}}</td>
                            <td>{{$data->days}}</td>
                            <td>{{$data->reason}}</td>
                            <td class="text-center">
                                @if($data->leave_type_offer==0)
                                    <form id="{{$data->id}}" action="{{route('leave.paid',$data->id)}}" method="POST">
                                        @csrf
                                        <button type="submit" onclick="return confirm('Are you sure want to paid for leave?')" class="btn btn-sm btn-success font-weight-bold" name="paid" value="1"><i class="fa fa-money"> Paid</i></button>
                                    </form>
                                @elseif($data->leave_type_offer==1)

                                    <form action="{{route('leave.paid',$data->id)}}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-danger font-weight-bold" onclick="return confirm('Are you sure want to unpaid for leave?')" type="submit" name="paid" value="2">Unpaid</button>
                                    </form>
                                @else
                                    <form action="{{route('leave.paid',$data->id)}}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-success font-weight-bold" onclick="return confirm('Are you sure want to piad for leave?')" type="submit" name="paid" value="1"><i class="fa fa-money"> Paid</i></button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                @if($data->is_approved==0)
                                    <form id="approve-leave-{{$data->id}}" action="{{route('leave.approve',$data->id)}}" method="POST">
                                        @csrf
                                        <button type="submit" onclick="return confirm('Are you sure want to approve leave?')" class="btn btn-sm btn-success" name="approve" value="1">Approve</button>
                                    </form>
                                @elseif($data->is_approved==1)

                                    <form action="{{route('leave.approve',$data->id)}}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to reject leave?')" type="submit" name="approve" value="0">Reject</button>
                                    </form>
                                @else
                                    <form action="{{route('leave.approve',$data->id)}}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-success" onclick="return confirm('Are you sure want to approve leave?')" type="submit" name="approve" value="1">Approve</button>
                                    </form>
                                @endif
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
                    Employee Leave Is Empty
                </p>
            </div>
            @endif
        </div>
    </div>
    <div class="row mx-4">
        {!! $leaves->render() !!}
    </div>
</div>
@endsection
@section('js')
<script>
$('a#leave').addClass('mm-active');
$('a#leave-mgmt').addClass('mm-active');
$("#key").change(function() {
    var value = $("#key").val();
    $("input[name='filter']").val(value);
});
</script>
@endsection

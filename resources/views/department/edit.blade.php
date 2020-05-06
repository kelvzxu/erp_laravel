@extends('layouts.admin')
@section('title','SK - Employee')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<form action="{{ route('department.update',$department->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="app-page-title bg-white">
        <div class="o_control_panel">
            <div>
                <ol class="breadcrumb" role="navigation">
                    <li class="breadcrumb-item" accesskey="b"><a href="{{route('department')}}">HR Department</a></li>
                    <li class="breadcrumb-item active">{{$department->department_name}}</li>
                </ol>
            </div>
            <div>
                <div class="o_cp_left">
                    <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                        <div>
                            <button class="btn btn-primary my-2" @click="create" :disabled="isProcessing">Save</button>
                            <a href="{{route('department')}}" class="btn btn-secondary mby-2">Discard</a>
                        </div>
                    </div>
                </div>
                <div class="o_cp_right">
                    <div class="btn-group o_search_options position-static" role="search"></div>
                    <nav class="o_cp_pager" role="search" aria-label="Pager">
                        <div class="o_pager">
                            <span class="o_pager_counter">
                                <span class="o_pager_value">1</span> / <span class="o_pager_limit">1</span>
                            </span>
                            <span class="btn-group" aria-atomic="true">
                                <button type="button" class="fa fa-chevron-left btn btn-secondary o_pager_previous"
                                    accesskey="p" aria-label="Previous" title="Previous" tabindex="-1" disabled=""></button>
                                <button type="button" class="fa fa-chevron-right btn btn-secondary o_pager_next"
                                    accesskey="n" aria-label="Next" title="Next" tabindex="-1" disabled=""></button>
                            </span>
                        </div>
                    </nav>
                    <nav class="btn-group o_cp_switch_buttons" role="toolbar" aria-label="View switcher"></nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Department Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="department_name" class="form-control" id="fname" placeholder="Enter a department name" value="{{$department->department_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Complete Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="complete_name" class="form-control" id="fname" placeholder="Enter a department Complete name" value="{{$department->complete_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Parent Department</label>
                            <div class="col-sm-3">
                                <select id="parent_id" name="parent_id" class="form-control">
                                    <option value="">Parent Dept</option>
                                    @foreach ($departments as $row)
                                        <option value="{{ $row->id }}" {{ $row->id == $department -> parent_id ? 'selected':'' }}>
                                            {{ ucfirst($row->department_name) }}
                                        </option>
                                    @endforeach
                                </select>                                        
                            </div>
                            <label for="fname" class="col-sm-2 text-right control-label col-form-label">Manager Name</label>
                            <div class="col-sm-4">
                                <select id="manager_id" name="manager_id" class="form-control">
                                    <option value="">manager</option>
                                    @foreach ($employee as $row)
                                        <option value="{{ $row->id }}" {{ $row->id == $department -> manager_id ? 'selected':'' }}>
                                            {{ ucfirst($row->employee_name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fname" class="col-sm-3 text-right control-label col-form-label">Description</label>
                            <div class="col-sm-9">
                                <input type="text" name="note" class="form-control" id="fname" placeholder="Description" value="{{$department->note}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('js')
<script>
$('a#department').addClass('mm-active');
$('a#hr-management').addClass('mm-active');
</script>
@endsection
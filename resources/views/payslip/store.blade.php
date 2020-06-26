@extends('layouts.admin')
@section('title','Employees - Payslip')
@section('css')
<link href="{{asset('css/web.assets_common.css')}}" rel="stylesheet">
<link href="{{asset('css/web.assets_backend.css')}}" rel="stylesheet">
@endsection
@section('content')
<form action="{{ route('payslip.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="app-page-title bg-white">
        <div class="o_control_panel">
            <div>
                <ol class="breadcrumb" role="navigation">
                    <li class="breadcrumb-item" accesskey="b"><a href="{{route('payslip')}}">PaySlip</a></li>
                    <li class="breadcrumb-item"><a href="{{route('payslip.create')}}">Create Payslip</a></li>
                    <li class="breadcrumb-item active">{{$employee->employee_name}}</li>

                </ol>
            </div>
            <div>
                <div class="o_cp_left">
                    <div class="o_cp_buttons" role="toolbar" aria-label="Control panel toolbar">
                        <div>
                            <button class="btn btn-primary my-2" @click="create" :disabled="isProcessing">Save</button>
                            <a href="{{route('payslip')}}" class="btn btn-secondary mby-2">Discard</a>
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
                </div>
            </div>
        </div>
    </div>
    <div class="container my-4 bg-white">
        <br>
        @csrf
        <div class="row">
            <div class="col-sm-9">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Employee Name</label>
                    <div class="col-sm-9">
                        <input type="hidden" name="id" id="id" class="form-control" value="{{$employee->id}}" readonly>
                        <input type="text" name="name" id="name" class="form-control" value="{{$employee->employee_name}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Identification No</label>
                    <div class="col-sm-9">
                        <input type="text" name="identification_id" id="identification_id" class="form-control" value="{{$employee->identification_id}}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Gender</label>
                    <div class="col-sm-4">
                        <input type="text" name="gender" id="gender" class="form-control" value="{{$employee->gender}}" readonly>
                    </div>
                    <label class="col-sm-1 col-form-label">Marital</label>
                    <div class="col-sm-4">
                        <input type="text" name="marital" id="marital" class="form-control" value="{{$employee->marital}}" readonly>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 text-center d-none d-md-block ">
                <img src="{{asset('uploads/Employees/'.$employee->photo)}}" width=120px>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">department</label>
                    <div class="col-sm-4">
                        <input type="text" name="department" id="department" class="form-control" value="{{$employee->department_name}}" readonly>
                    </div>
                    <label class="col-sm-1 col-form-label">Designation</label>
                    <div class="col-sm-4">
                    <input type="text" name="jobs" id="jobs" class="form-control" value="{{$employee->jobs_name}}" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Date From</label>
                    <div class="col-sm-4">
                        <input type="date" name="from" id="from" class="form-control">
                    </div>
                    <label class="col-sm-1 col-form-label">To</label>
                    <div class="col-sm-4">
                    <input type="date" name="to" id="to" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-sm-3 text-center d-sm-none d-md-block ">
                <a class="btn btn-outline-success btn-primary text-white" id="calculate">Calculate</a>
            </div>
        </div>
        <hr>
        <div id="salarydetail" style="display: none">
            <div class="row">
                <h3 class="col-10 font-weight-bold text-primary">Salary Detail</h3>
            </div>
            <div class="row">
                <label class="col-3">employee salary</label>
                <div class="col-7">
                    <input type="text" style="border:none" name="salary" id="salary" value="{{$employee->salary}}" readonly>
                </div>
            </div>
            <div class="row">
                <label class="col-3">employee attendance</label>
                <div class="col-1">
                    <input type="text" style="border:none" name="attendance" id="attendancelog" value="0" readonly>
                </div>
                <label class="col-7">Days</label>
            </div>
            <div class="row">
                <label class="col-3">employee leave</label>
                <div class="col-1">
                    <input type="text" style="border:none" name="leave" id="leaves" value="0" readonly>
                </div>
                <label class="col-7">Days</label>
            </div>
            <div class="row">
                <label class="col-3">Tax</label>
                <div class="col-7">
                    <input type="text" style="border:none" name="tax" id="tax" readonly>
                </div>
            </div>
            <div class="row">
                <label class="col-3">Grand Total</label>
                <div class="col-7">
                    <input type="text" style="border:none" name="total" id="total" readonly>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-3">
                <button class="btn btn-primary btn-sm">
                        <i class="fa fa-send"></i> save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('js')
<script>
$('a#payslip').addClass('mm-active');
$('a#payroll').addClass('mm-active');
function SHOW_ELEMENTS(element){
    $(element).css( "display", "" );
}
function GET_ATD_COUNT(){
    $.ajax  ({
        url: "{{asset('api/atd-count')}}",
        type: 'post',
        dataType: 'json',
        data :{
            'id': "{{$employee->user_id}}",
            'start': $('#from').val(),
            'end':$('#to').val()
        },
        success: function (result) {
            $('#attendancelog').val(result.data);
            console.log(result.data);
        }
    })
}
function GET_LEAVE_COUNT(){
    $.ajax  ({
        url: "{{asset('api/leave')}}",
        type: 'post',
        dataType: 'json',
        data :{
            'id': "{{$employee->user_id}}",
            'start': $('#from').val(),
            'end':$('#to').val()
        },
        success: function leave(result) {
            var value =[];
            let leave = result.data;
            const total_salary=$('#salary').val();
            $.each(leave, function (i) {
                value.push(leave[i].days)
            }); 
            if (leave.length==0){
                let count="0"
                $('#leaves').val(count);
                const per_day_amount=total_salary/30;
                const leave_day=count;
                const leave_amount= per_day_amount*leave_day;
                if (total_salary > 4500000){
                    const tax_percentage=5;
                    const tax_amount=total_salary*tax_percentage/100;
                    const grand_total=total_salary-leave_amount-tax_amount;
                    $('#tax').val(tax_amount);
                    $('#total').val(grand_total);
                }else{
                    const tax_percentage=0;
                    const tax_amount=total_salary*tax_percentage/100;
                    const grand_total=total_salary-leave_amount-tax_amount;
                    $('#tax').val(tax_amount);
                    $('#total').val(grand_total);
                }
            }
            else{
                let count = value.reduce((accumulator,currentValue)=>accumulator+currentValue);
                $('#leaves').val(count);
                const total_salary=$('#salary').val();
                const per_day_amount=total_salary/30;
                const leave_day=count;
                const leave_amount= per_day_amount*leave_day;
                if (total_salary > 4500000){
                    const tax_percentage=5;
                    const tax_amount=total_salary*tax_percentage/100;
                    const grand_total=total_salary-leave_amount-tax_amount;
                    $('#tax').val(tax_amount);
                    $('#total').val(grand_total);
                }else{
                    const tax_percentage=0;
                    const tax_amount=total_salary*tax_percentage/100;
                    const grand_total=total_salary-leave_amount-tax_amount;
                    $('#tax').val(tax_amount);
                    $('#total').val(grand_total);
                }
            }
        }
    })
}
$('#calculate').click(function(){
    GET_LEAVE_COUNT();
    GET_ATD_COUNT();
    SHOW_ELEMENTS('#salarydetail');
});
</script>
@endsection
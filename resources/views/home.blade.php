@extends('layouts.admin')
@section('title','SK - Home')
@section('content')
<div class="row">
<div class="col-12 col-md-8 bg-primary mt-0">
</div>
<div class="col-12 col-md-4 bg-white">
    <div id="attendance">
    @if (session('success'))
        <div class="alert alert-success mt-2">
        {{ session('success') }}
        </div>
    @endif
    </div>
    <hr>
    <div class="row">
        <div class="col-md-10 container">
            <form action="{{route('leave.store')}}" method="post" class="form-horizontal">
                @csrf
                <h4 class="card-title">Apply Leave</h4>
                <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-md-right control-label col-form-label">Leave type</label>
                    <div class="col-sm-9">
                        <input type="text" name="leave_type" class="form-control" id="fname" placeholder="Leave type">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lname" class="col-sm-3 text-md-right control-label col-form-label">Date from</label>
                    <div class="col-sm-9">
                        <input type="date" min="{{date('Y-m-d')}}" name="date_from" class="form-control" id="FromDate">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lname" class="col-sm-3 text-md-right control-label col-form-label">Date To</label>
                    <div class="col-sm-9">
                        <input type="date" name="date_to" class="form-control" id="ToDate">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-md-right control-label col-form-label">Days</label>
                    <div class="col-sm-9">
                        <input type="text" name="days" class="form-control" id="TotalDays" placeholder="Number of leave days">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-md-right control-label col-form-label">Reason</label>
                    <div class="col-sm-9">
                        <textarea type="text" name="reason" class="form-control" placeholder="Reason">
                        </textarea>
                    </div>
                </div>
                <div class="border-top">
                    <button type="submit" class="btn btn-dark my-2"><i class="fa fa-send"> Apply</i></button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
<script src="{{asset('/js/transaksi/vue-resource.min.js')}}"></script>
<script type="text/javascript">
    $('a#home').addClass('mm-active');
    function jam() {
    var time = new Date(),
        hours = time.getHours(),
        minutes = time.getMinutes(),
        seconds = time.getSeconds();
    // document.querySelectorAll('.jam')[0].innerHTML = harold(hours) + ":" + harold(minutes) + ":" + harold(seconds);
    var time = harold(hours) + ":" + harold(minutes) + ":" + harold(seconds);
    // // document.getElementById('#jam')[0].value = time
    $('#jam').val(time);
    function harold(standIn) {
        if (standIn < 10) {
          standIn = '0' + standIn
        }
        return standIn;
        }
    }
    setInterval(jam, 1000);

    $("#ToDate").change(function () {
        var start = new Date($('#FromDate').val());
        var end = new Date($('#ToDate').val());

        var diff = new Date(end - start);
        var days=1;
        days = diff / 1000 / 60 / 60 / 24;

        // $('#TotalDays').val(days);
        if (days == NaN) {
            $('#TotalDays').val(0);
        } else {
            $('#TotalDays').val(days+1);
        }
    })

    $("#FromDate").change(function () {
        var start = new Date($('#FromDate').val());
        var end = new Date($('#ToDate').val());

        var diff = new Date(end - start);
        var days=1;
        days = diff / 1000 / 60 / 60 / 24;

        // $('#TotalDays').val(days);
        if (days == NaN) {
            $('#TotalDays').val(0);
        } else {
            $('#TotalDays').val(days+1);
        }
    })

    $.ajax  ({
            url: "{{asset('api/attendance')}}",
            type: 'get',
            dataType: 'json',
            data :{
            'id': "{{ Auth::user()->id}}"
            },
            success: function (result) {
                console.log(result)
                if (result.status == 'success') {
                    $('#attendance').append(`
                        <form action="{{route('checkout',Auth::user()->id)}}" method="post">
                        @csrf
                            <div class="row text-center">
                                <div class="container bg-white rounded">
                                    <h5 class="mt-3"><p><small>Attendance</small></p></h5>
                                    <div class="row">
                                        <div class="col-6">
                                        Date : 
                                        <input style="border:none" type="text" class="bg-white" name="clock" size=7 value="{{$ldate = date('Y-m-d')}}" readonly>
                                        </div>
                                        <div class="col-6">
                                        Time :  <input id="jam" style="border:none" type="text" class="bg-white" name="time" size=7 readonly ></input>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                        <h5 class="mt-2 text-primary"><small>{{ Auth::user()->name }}</small></h5>
                                        </div>
                                    </div>
                                    <button class="mt-2"><img src="{{asset('images/icons/checkout.png')}}" width="60px" height="60px"></button>
                                    <footer class="blockquote-footer mt-2 mb-3">Click to <cite title="Source Title">Check Out</cite> -</footer>
                                </div>
                            </div>
                        </form>
                    `);
                }else{
                    $('#attendance').append(`
                        <form action="{{route('checkin',Auth::user()->id)}}" method="post">
                        @csrf
                            <div class="row text-center">
                                <div class="container bg-white rounded">
                                    <h5 class="mt-3"><p><small>Attendance</small></p></h5>
                                    <div class="row">
                                        <div class="col-6">
                                        Date : 
                                        <input style="border:none" type="text" class="bg-white" name="clock" size=7 value="{{$ldate = date('Y-m-d')}}" readonly>
                                        </div>
                                        <div class="col-6">
                                        Time : <input id="jam" style="border:none" type="text" class="bg-white" name="time" size=7 readonly ></input>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                        <h5 class="mt-2 text-primary"><small>Welcome {{ Auth::user()->name }}</small></h5>
                                        </div>
                                    </div>
                                    <button class="mt-2"><img src="{{asset('images/icons/checkin.png')}}" width="60px" height="60px"></button>
                                    <footer class="blockquote-footer mt-2 mb-3">Click to <cite title="Source Title">Check in</cite> -</footer>
                                </div>
                            </div>
                        </form>
                    `);
                }
            }
        })
</script>
@endsection

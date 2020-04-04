@extends('layouts.admin')
@section('title','SK - Home')
@section('content')
<div class="row">
<div class="col-8 bg-primary mt-0">
</div>
<div class="col-4 bg-white">
    <div id="attendance">
    </div>
    <div class="row">
    </div>
</div>
</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
<script src="{{asset('/js/transaksi/vue-resource.min.js')}}"></script>
<script type="text/javascript">
    function jam() {
    var time = new Date(),
        hours = time.getHours(),
        minutes = time.getMinutes(),
        seconds = time.getSeconds();
    // document.querySelectorAll('.jam')[0].innerHTML = harold(hours) + ":" + harold(minutes) + ":" + harold(seconds);
    var time = harold(hours) + ":" + harold(minutes) + ":" + harold(seconds);
    // document.getElementById('#jam')[0].value = time
    $('#jam').val(time);
    function harold(standIn) {
        if (standIn < 10) {
          standIn = '0' + standIn
        }
        return standIn;
        }
    }
    setInterval(jam, 1000);

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
                                        Time : <input id="jam" style="border:none" type="text" class="bg-white" name="time" size=7 readonly ></input>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                        <h5 class="mt-2 text-primary"><small>{{ Auth::user()->name }}</small></h5>
                                        </div>
                                    </div>
                                    <button class="mt-2"><img src="{{asset('images/icons/checkout.png')}}" width="60px" height="60px"></button>
                                    <footer class="blockquote-footer mt-2 mb-5">Click to <cite title="Source Title">Check Out</cite> -</footer>
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
                                    <footer class="blockquote-footer mt-2 mb-5">Click to <cite title="Source Title">Check in</cite> -</footer>
                                </div>
                            </div>
                        </form>
                    `);
                }
            }
        })
</script>
@endsection

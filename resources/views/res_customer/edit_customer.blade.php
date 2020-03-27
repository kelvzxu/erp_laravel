@extends('layouts.admin')
@section('title','SK - New Customer')
@section('css')
<!--  Maps CSS & JS -->
<script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' />
<script src="https://api.mapbox.com/mapbox-gl-js/v1.6.0/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v1.6.0/mapbox-gl.css" rel="stylesheet" />
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.min.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.2/mapbox-gl-geocoder.css' type='text/css' />
<style>
    #map { top: 0; bottom: 0; width: 100%; }
    .mapBox {
        height: 420px;
        margin-bottom: 80px;
    }
</style>
<!--  End Maps CSS & JS -->
@endsection
@section('content')
<div class="container">
    @if (session('error'))
        <div class="alert alert-danger">
        {{ session('error') }}
        </div>
    @endif
    <!-- header -->
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('customer')}}">Customer</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('customer.show', $res_customer->id)}}">View Detail</a></li>
                    </ol>
                </nav>
            </div>
            <h3>Update Customer</h3>
        </div>
        <div class="col-12 col-md-5 text-right">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search...." aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </div>
        </div>
    </div>
    <!-- header button -->
    <form action="{{ url('customer/update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{$res_customer -> id}}">
    <div class="row">
        <div class="col-4">
            <button class="btn btn-primary btn-sm">
                <i class="fa fa-send"></i> Save Record
            </button>
            <a href="{{ route('customer.destroy', $res_customer -> id) }}" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"> Delete Record</i></a>
        </div>
    </div>

    <div class="container bg-white my-4">
        <br>
            <div class="row">
                <div class="col-sm-9">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            active
                        </label>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="name" placeholder="Customer Name" class="form-control @error('name') is-invalid @enderror" value="{{ $res_customer -> customer_name }}"  autocomplete="name" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Display Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="display_name" id="display_name" class="form-control @error('display_name') is-invalid @enderror" value="{{ $res_customer -> display_name }}"  autocomplete="display_name" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Parent Company</label>
                        <div class="col-sm-10">
                            <input type="text" name="Parent_id" id="Parent_id" class="form-control @error('Parent_id') is-invalid @enderror" value="{{ $res_customer -> parent_id }}"  autocomplete="Parent_id" autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Industry</label>
                        <div class="col-sm-10">
                            <select name="industry_id" id="industry_id" class="form-control @error('industry_id') is-invalid @enderror" autofocus>
                            @foreach ($industry as $row)
                                <option value="{{ $row->id }}" {{ $row->id == $res_customer -> industry_id ? 'selected':'' }}>
                                    {{ ucfirst($row->industry_name) }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <img id='img-upload'/>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file bg-primary text-white">
                                    Browse… <input type="file" id="imgInp" name="image">
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                            <input type="text" name="address" id="address" placeholder="Address" class="form-control @error('address') is-invalid @enderror" value="{{ $res_customer -> address  }}"  autocomplete="address" autofocus>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" name="email" id="email" placeholder="mail@example.com" class="form-control @error('email') is-invalid @enderror" value="{{ $res_customer -> email  }}"  autocomplete="email" autofocus>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Street</label>
                        <div class="col-sm-5">
                            <input type="text" name="street1" id="street1" placeholder="street" class="form-control @error('street') is-invalid @enderror" value="{{ $res_customer -> street }}"  autocomplete="street" autofocus>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="street2" id="street2" placeholder="City" class="form-control @error('street2') is-invalid @enderror" value="{{ $res_customer -> city }}"  autocomplete="street2" autofocus>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Mobile</label>
                        <div class="col-sm-9">
                            <input type="text" name="mobile" id="mobile" placeholder="08xxxxxxxxx" class="form-control @error('mobile') is-invalid @enderror" value="{{ $res_customer -> mobile }}"  autocomplete="mobile" autofocus>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Country</label>
                        <div class="col-sm-5">
                            <select id="country" name="country" class="form-control @error('country') is-invalid @enderror">
                            @foreach ($country as $row)
                                <option value="{{ $row->id }}" {{ $row->id == $res_customer -> country_id ? 'selected':'' }}>
                                    {{ ucfirst($row->country_name) }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select id="state" name="state" class="form-control @error('state') is-invalid @enderror">
                            @foreach ($state as $row)
                                <option value="{{ $row->id }}" {{ $row->id == $res_customer -> state_id ? 'selected':'' }}>
                                    {{ ucfirst($row->state_name) }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-9">
                            <input type="text" name="phone" id="phone" placeholder="06xxxxxxxxx" class="form-control @error('phone') is-invalid @enderror" value="{{ $res_customer -> phone }}"  autocomplete="phone" autofocus>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Zip Code</label>
                        <div class="col-sm-4">
                            <input type="text" id="zip" name="zip" class="form-control @error('zip') is-invalid @enderror" value="{{$res_customer -> zip}}"></input>
                        </div>
                        <div class="col-sm-5">
                            <select id="currency_id" name="currency_id" class="form-control @error('currency_id') is-invalid @enderror">
                            @foreach ($currency as $row)
                                <option value="{{ $row->id }}" {{ $row->id == $res_customer -> currency_id ? 'selected':'' }}>
                                    {{ ucfirst($row->currency_name) }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Website</label>
                        <div class="col-sm-9">
                            <input type="text" name="website" id="website" placeholder="https://www.laravel.com" class="form-control @error('website') is-invalid @enderror" value="{{ $res_customer -> website }}"  autocomplete="website" autofocus>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">language</label>
                        <div class="col-sm-5">
                            <select id="lag" name="lag" class="form-control @error('lag') is-invalid @enderror">
                            @foreach ($lang as $row)
                                <option value="{{ $row->id }}" {{ $row->id == $res_customer -> lag ? 'selected':'' }}>
                                    {{ ucfirst($row->lang_name) }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select id="tz" name="tz" class="form-control @error('tz') is-invalid @enderror">
                            @foreach ($tz as $row)
                                <option value="{{ $row->timezone }}" {{ $row->timezone == $res_customer -> tz ? 'selected':'' }}>
                                    {{ ucfirst($row->timezone) }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">reference</label>
                        <div class="col-sm-9">
                            <input type="text" name="reference" id="reference" placeholder="reference" class="form-control @error('reference') is-invalid @enderror" value="{{ $res_customer -> ref }}"  autocomplete="reference" autofocus>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Bank Account</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="bank_account" id="bank_account" placeholder="800XXXXX" value="{{$res_customer -> bank_account}}">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">limit</label>
                        <div class="col-sm-5">
                            <input id="debit" name="debit" class="form-control" placeholder="Debit" value="{{$res_customer -> debit_limit}}"></input>
                        </div>
                        <div class="col-sm-4">
                            <input id="credit" name="credit" class="form-control" placeholder="kredit" value="{{$res_customer -> credit_limit}}"></input>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">latitude</label>
                        <div class="col-sm-9">
                            <input id="partner_latitude" type="text" class="form-control @error('partner_latitude') is-invalid @enderror" name="partner_latitude" value="{{ $res_customer -> partner_latitude }}"  autocomplete="partner_latitude" autofocus>   
                        </div>
                    </div>
                </div>
                <div class="col-6 ">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">longitude</label>
                        <div class="col-sm-9">
                            <input id="partner_longitude" type="text" class="form-control @error('partner_longitude') is-invalid @enderror" name="partner_longitude" value="{{ $res_customer -> partner_longitude }}"  autocomplete="partner_longitude" autofocus>   
                        </div>
                    </div>
                </div>              
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="container">
                        <div id='map'class="mapBox border border-primary rounded mx-0">
                            <script>
                                mapboxgl.accessToken = 'pk.eyJ1Ijoia2Vsdmluenh1IiwiYSI6ImNrM2xxcXdnODBuYWozZ25tcGs0eGkzNmwifQ.34XILF-xBBsu2b3YCKn4qw';
                                var map
                                function loadmaps(lng,lat){
                                    // load maps
                                    map = new mapboxgl.Map({
                                    container: 'map',
                                    style: 'mapbox://styles/kelvinzxu/ck3mphl0h346k1cmwnqpmnf2i',
                                    center: [lng,lat],
                                    zoom: 15
                                    });
                                    console.log("ok")
                                    // zoom Control
                                    map.addControl(new MapboxGeocoder({
                                        accessToken: mapboxgl.accessToken,
                                        mapboxgl: mapboxgl
                                    }));
                                    // Search Box Control
                                    map.addControl(new mapboxgl.NavigationControl('mapbox.places'));
                                    
                                    // add marker
                                    map.on('click', function(e) {
                                    let coordinate=e.lngLat.wrap();
                                    let lat=coordinate.lat;
                                    let lng=coordinate.lng;
                                    $("#partner_latitude").val(lat);
                                    $("#partner_longitude").val(lng);
                                    map.remove();
                                    loadmaps(lng,lat); 
                                    var marker = new mapboxgl.Marker();
                                    marker.setLngLat([lng,lat]);
                                    marker.addTo(map);
                                    });
                                }
                                loadmaps(98.679096,3.595421);
                            </script>
                        </div>
                    </div>
                </div>
            </div>         
    </div>
    </form>
</div>
@endsection
@section('js')
@include('api.api')
@endsection
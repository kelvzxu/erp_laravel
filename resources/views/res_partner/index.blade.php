@extends('layouts.admin')
@section('title','SK - New Partner')
@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
        {{ session('status') }}
        </div>
    @endif
    <!-- header -->
    <div class="row">
        <div class="col-12 col-md-7">
            <h3>Vendors List</h3>
        </div>
        <div class="col-12 col-md-5 text-right">
            <form action="{{ route('partner.filter') }}" method="get" >
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <select class="input-group-text bg-primary text-white" name="filter">
                                <option value="" selected>Filter By</option>
                                <option value="display_name">Display Name</option>
                                <option value="parent_id">Company Name</option>
                                <option value="city">City</option>
                                <option value="country_name">Country</option>
                        </select>
                    </div>
                    <input type="text" class="form-control" placeholder="Search...." name="value">
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit"><i class="fa fa-search" aria-hidden="true"> Search</i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- header button -->
    <div class="row">
        <div class="col-3">
            <a href="{{url('/partner/new')}}" class="btn btn-primary">Create</a>
        </div>
    </div>

    <div class="table-responsive-lg my-4">
        <table class="table">
        <caption>Vendors List</caption>
            <thead class="table table-sm">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">logo</th>
                    <th scope="col">Name</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">city</th>
                    <th scope="col">country</th>
                    <th scope="col">website</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            @forelse($partner as $part)
            <tbody>
                <tr>
                    <th scope="row">{{$loop->iteration}}
                    <th ><img src="{{asset('uploads/Partners/'.$part->logo)}}" width=100px></th>
                    <th >{{$part->display_name}}</th>
                    <th >{{$part->parent_id}}</th>
                    <th >{{$part->city}}</th>
                    <th >{{$part->country_name}}</th>
                    <th ><a href="https://{{$part->website}}">{{$part->website}}</a></th>
                    <th >
                        <a href="{{ route('partner.show', $part->id) }}" class="btn btn-success btn-sm">
                        <i class="fa fa-edit"> View Detail</i></a>
                    </th>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Partner List is Empty</td>
                </tr>
            </tbody>
            @endforelse
        </table>
    </div>
</div>
@endsection

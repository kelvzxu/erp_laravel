@extends('layouts.admin')
@section('title','SK - Product Managements')
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
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{route('customer')}}">Customer</a></li>
                    </ol>
                </nav>
            </div>
            <h3>Product Managements</h3>
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
    <div class="row">
        <div class="col-3">
            <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-edit"></i> create
            </a>
        </div>
    </div>

    
    <div class="table-responsive my-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama product</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Last Update</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $row)
                <tr>
                    <td>
                        @if (!empty($row->photo))
                            <img src="{{ asset('uploads/product/' . $row->photo) }}" 
                                alt="{{ $row->name }}" width="50px" height="50px">
                        @else
                            <img src="http://via.placeholder.com/50x50" alt="{{ $row->name }}">
                        @endif
                    </td>
                    <td>
                        <sup class="label label-success">({{ $row->code }})</sup>
                        <strong>{{ ucfirst($row->name) }}</strong>
                    </td>
                    <td>{{ $row->stock }}</td>
                    <td>Rp {{ number_format($row->price) }}</td>
                    <td>{{ $row->category->name }}</td>
                    <td>{{ $row->updated_at }}</td>
                    <td>
                        <form id="delete-form-{{ $row->id }}" action="{{route('product.destroy', $row->id)}}" method="put">
                            @csrf
                            @method('DELETE')
                                <a href="{{route('product.edit', $row->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit">  Edit</i></a>
                            <button type="button" onclick="deletePost({{ $row->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash">  Delete</i></button>
                            {{--onclick="return confirm('Are you sure?')"--}}
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Product is Empty</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
    function deletePost(id)

    {
        const swalWithBootstrapButtons = swal.mixin({
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
        })

        swalWithBootstrapButtons({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-'+id).submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons(
                    'Cancelled',
                    'Your file is safe :)',
                    'error'
                )
            }
        })
    }

</script>
@endsection
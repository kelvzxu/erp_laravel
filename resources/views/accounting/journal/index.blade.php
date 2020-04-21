@extends('layouts.admin')
@section('title','SK - Employee')
@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
        {{ session('success') }}
        </div>
    @endif
    <!-- header -->
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('journal.index')}}">Journal</a></li>
                    </ol>
                </nav>
            </div>
            <h3>Journal</h3>
        </div>
        <div class="col-12 col-md-5 text-right">
            <form action="{{ route('journal.filter') }}" method="get" >
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <select class="input-group-text bg-primary text-white" name="filter">
                                <option value="" selected>Filter By</option>
                                <option value="name">Name</option>
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
        <div class="col-3 mt-2">
            <a href="{{route('journal.create')}}" class="btn btn-primary">Create</a>
        </div>
    </div>

    <div class="table-responsive-lg my-4">
        <table class="table">
        <caption>Entry data : {{ $journal->total() }}/{{ $journal->perPage() }}</caption>
            <thead class="table table-sm">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">code</th>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">company</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            @forelse($journal as $data)
            <tbody>
                <tr> 
                    <th scope="row">{{$loop->iteration}}</th>
                    <th >{{$data->code}}</th>
                    <th >{{$data->name}}</th>
                    <th >{{$data->type}}</th>
                    <th >{{$data->company->company_name}}</th>
                    <th >
                        <a href="{{route('journal.edit',$data->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit">  Edit</i></a>
                    </th>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Journal is Empty</td>
                </tr>
            </tbody>
            @endforelse
        </table>
        {{ $journal->links() }}
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

@extends('layouts.admin')
@section('title','SK - Employee')
@section('content')
<div id="main-wrapper">
    @if (session('success'))
        <div class="alert alert-success">
        {{ session('success') }}
        </div>
    @endif
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">System Management</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('department')}}">department</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-2 my-3">
                        <a class="btn btn-lg btn-primary" href="{{route('department.create')}}">Add department</a>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Department List</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Department name</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($departments as $department)
                                        <tr>
                                            <td>{{$loop -> index+1 }}</td>
                                            <td>{{$department->department_name}}</td>
                                            <td>
                                                <form id="delete-form-{{ $department->id }}" action="{{route('department.delete',$department->id)}}" method="put">
                                                    @csrf
                                                    @method('DELETE')
                                                       <a href="{{route('department.edit',$department->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit">  Edit</i></a>
                                                    <button type="button" onclick="deletePost({{ $department->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash">  Delete</i></button>
                                                    {{--onclick="return confirm('Are you sure?')"--}}
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Department is Empty</td>
                                        </tr>
                                        </tbody>
                                        @endforelse
                                    </table>
                                    {{ $departments->links() }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
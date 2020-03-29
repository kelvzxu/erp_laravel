@extends('layouts.admin')
@section('title','SK - Employee')
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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('employee')}}">Employee</a></li>
                    </ol>
                </nav>
            </div>
            <h3>Employee List</h3>
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
            <a href="{{route('employee.new')}}" class="btn btn-primary">Create</a>
        </div>
    </div>

    <div class="table-responsive-lg my-4">
        <table class="table">
        <caption>Employee List</caption>
            <thead class="table table-sm">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col">City</th>
                    <th scope="col">Country</th>
                    <th scope="col">Department</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            @forelse($employee as $emp)
            <tbody>
                <tr> 
                    <th scope="row">{{$loop->iteration}}
                    <th ><img src="{{asset('uploads/Employees/'.$emp->photo)}}" width=50px></th>
                    <th >{{$emp->employee_name}}</th>
                    <th >{{$emp->city}}</th>
                    <th >{{$emp->country_name}}</th>
                    <th >{{$emp->department_name}}</th>
                    <th >
                        <form id="delete-form-{{ $emp->id }}" action="{{route('employee.delete',$emp->id)}}" method="put">
                            @csrf
                            @method('DELETE')
                                <a href="{{route('employee.edit',$emp->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit">  Edit</i></a>
                            <button type="button" onclick="deletePost({{ $emp->id }})" class="btn btn-sm btn-danger"><i class="fa fa-trash">  Delete</i></button>
                            {{--onclick="return confirm('Are you sure?')"--}}
                        </form>
                    </th>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Jobs is Empty</td>
                </tr>
            </tbody>
            @endforelse
            {{ $employee->links() }}
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

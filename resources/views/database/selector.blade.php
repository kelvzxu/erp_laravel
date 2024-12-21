@extends('layout_admin')

@section('title', 'Laravel | Create Database')

@section('content')
    <div class="list-group">
        @foreach($databases as $database)
            <div class="list-group-item d-flex align-items-center">
                <a class="d-block flex-grow-1" href="/web?db={{ $database }}">
                    {{ $database }}
                </a>
                <div class="btn-group btn-group-sm float-end">
                    <button type="button" class="o_database_action btn btn-primary">
                        <i class="fa fa-floppy-o fa-fw"></i> Backup
                    </button>
                    <button type="button" class="o_database_action btn btn-secondary">
                        <i class="fa fa-files-o fa-fw"></i> Duplicate
                    </button>
                    <button type="button" class="o_database_action btn btn-danger">
                        <i class="fa fa-trash-o fa-fw"></i> Delete
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex mt-2">
        <button type="button" class="btn btn-primary flex-grow-1" data-bs-toggle="modal" data-bs-target="#databaseManagerModal">Create Database</button>
        <button type="button" class="btn btn-primary flex-grow-1 ms-2">Restore Database</button>
        <button type="button" class="btn btn-primary flex-grow-1 ms-2">Set Master Password</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="databaseManagerModal" tabindex="-1" aria-labelledby="databaseManagerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="databaseManagerModalLabel">Database Manager</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form akan dimuat dengan AJAX -->
                    <iframe src="{{ route('database.create') }}" style="width:100%; border:none;" onload="resizeIframe(this)"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection

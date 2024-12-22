@extends('layout_admin')

@section('title', 'Laravel | Create Database')

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif
    <div class="list-group">
        @foreach($databases as $database)
            <div class="list-group-item d-flex align-items-center">
                <a class="d-block flex-grow-1" href="/web/database/setup?db={{ $database }}">
                    {{ $database }}
                </a>
                <div class="btn-group btn-group-sm float-end">
                    <button type="button" class="o_database_action btn btn-primary">
                        <i class="fas fa-save"></i> Backup
                    </button>
                    <button type="button" class="o_database_action btn btn-secondary">
                        <i class="fas fa-copy"></i> Duplicate
                    </button>
                    <div class="btn-group btn-group-sm float-end">
                        <button type="button" class="o_database_action btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteDatabaseModal" data-database="{{ $database }}">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex mt-2">
        <button type="button" class="btn btn-primary flex-grow-1" data-bs-toggle="modal" data-bs-target="#databaseManagerModal">Create Database</button>
        <button type="button" class="btn btn-primary flex-grow-1 ms-2">Restore Database</button>
        <button type="button" class="btn btn-primary flex-grow-1 ms-2" data-bs-toggle="modal" data-bs-target="#setMasterPasswordModal">Set Master Password</button>

    </div>

    <!-- Create Database Modal -->
    <div class="modal fade" id="databaseManagerModal" tabindex="-1" aria-labelledby="databaseManagerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="databaseManagerModalLabel">Database Manager</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <x-database-form />
                </div>
            </div>
        </div>
    </div>

    <!-- Set Master Password Modal -->
    <div class="modal fade" id="setMasterPasswordModal" tabindex="-1" aria-labelledby="setMasterPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="setMasterPasswordModalLabel">Set Master Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="setMasterPasswordForm" action="{{ route('database.password') }}" method="POST">
                        @csrf

                        <!-- New Master Password -->
                        <x-forms.input-field
                            id="master_password"
                            name="master_password"
                            type="password"
                            label="New Master Password"
                            required="true"
                        />

                        <!-- Confirm Master Password -->
                        <x-forms.input-field
                            id="confirm_master_password"
                            name="confirm_master_password"
                            type="password"
                            label="Confirm Master Password"
                            required="true"
                        />

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Set Master Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Database Modal -->
    <div class="modal fade" id="deleteDatabaseModal" tabindex="-1" aria-labelledby="deleteDatabaseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteDatabaseModalLabel">Delete Database</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Warning and Confirmation -->
                    <div class="alert alert-danger">
                        <strong>Warning!</strong> <br/>Deleting a database is an irreversible action. 
                        <p>All data within the database <span id="confirmDatabaseName" class="fw-bold"></span> will be permanently lost. 
                        <br/>Please confirm your action and provide the master password to proceed.</p>
                    </div>
                    <form id="deleteDatabaseForm" action="{{ route('database.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <input type="hidden" name="db" id="deleteDatabaseName">

                        <x-forms.input-field
                            id="master_password"
                            name="master_password"
                            type="password"
                            label="Master Password"
                            required="true"
                        />

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger">Delete Database</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteModal = document.getElementById('deleteDatabaseModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var databaseName = button.getAttribute('data-database'); 
            var input = deleteModal.querySelector('#deleteDatabaseName');
            input.value = databaseName; 
        });
    });
    function ShowPassword(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>
@endsection

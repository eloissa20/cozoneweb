@extends('admin_side.side')

@section('content')
<style>
    .card{
        border: 1px solid #000000;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="card shadow-xl">
    <div class="card-header d-flex flex-row justify-content-between align-items-center">
        <div>
            <h5 class="card-title">Users Table</h5>
            <h6 class="card-subtitle text-muted">List of users in the database</h6>
        </div>
        <div>
            <a class='btn btn-outline-dark btn-sm me-2' href="{{ route('user.create') }}">Create User</a>
        </div>
    </div>
    <div class="card-body">
        <table id="data-table" class="table table-hover" style="width: 100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Contact</th>
                    <th>Birthdate</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th class='d-flex justify-content-center'>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal for Viewing Space Details -->
<div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body">
                <div class="p-3">
                  <div class="d-flex flex-row">
                    <div class="col">
                      <h4 class="fw-bold mb-3" id="userName"></h3>
                    </div>
                    <div class="col d-flex justify-content-end">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                  </div>
                  <div class="d-flex flex-row">
                    <div class="col">
                      <div class="row">
                        <p class="m-0">Email</p>
                        <p class="" id="userEmail"></p>
                      </div>
                      <p class="m-0">Contact Number</p>
                      <p id="userContact"></p>
                      <p class="m-0">Birthdate</p>
                      <p id="userBirthday"></p>
                    </div>
                    <div class="col">
                      <p class="m-0">Gender</p>
                      <p id="userGender"></p>
                      <p class="m-0">Address</p>
                      <p id="userAddress"></p>
                      <p class="m-0">Role</p>
                      <p id="userRole"></p>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        loadtableData();
    })
    const loadtableData = () => {
        $('#data-table').DataTable({
            'scrollX': true,
            'serverSide': true,
            'ajax': {
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'url': './deactivated_users',
                'type': 'GET',
            },
            order: [
                [0, "asc"],
            ],
            'columns': [
                { 
                    data: null, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1; // Calculate row count
                    }
                },
                {data: 'name'},
                {data: 'email'},
                {
                    data: 'user_type',
                    render: function(data) {
                        switch (data) {
                            case 1:
                                return 'Client';
                            case 2:
                                return 'Co Worker';
                            case 3:
                                return 'Admin';
                            default:
                                return 'Unknown';
                        }
                    }
                },
                {data: 'contact'},
                {data: 'birthday'},
                {data: 'gender'},
                {data: 'address'},
                {data: 'actions'},
            ]
        });
    }
</script>

@endsection

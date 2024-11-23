@extends('admin_side.side')

@section('content')
<style>
    .card {
        border: 1px solid #000000;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="card shadow-xl">
    <div class="card-header">
        <h5 class="card-title">Clients Table</h5>
        <h6 class="card-subtitle text-muted">List of clients in the database</h6>
    </div>
    <div class="card-body">
        <table id="clients-table" class="table table-hover" style="width: 100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        loadtableData();
    })
    const loadtableData = () => {
        $('#clients-table').DataTable({
            'scrollX': true,

            'serverSide': true,
            'ajax': {
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'url': './clients',
                'type': 'GET',
            },
            order: [
                [0, "asc"],
            ],
            'columns': [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'address'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'updated_at'
                }
            ]
        });
    }
</script>

@endsection
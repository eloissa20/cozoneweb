@extends('coworker_side.side')

@section('content')
<style>
    .card{
        border: 1px solid #000000;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="card shadow-xl">
    <div class="card-header">
        <h5 class="card-title">Space Table</h5>
        <h6 class="card-subtitle text-muted">List of spaces in the database</h6>
    </div>
    <div class="card-body">
        <table id="data-table" class="table table-responsive" style="width: 100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Space Name</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
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
                    'url': './myCoworkingSpace',
                    'type': 'GET',
                },
                order: [
                    [0, "asc"],
                ],
                'columns': [
                    {data: 'id'},
                    {data: 'space_name'},
                    {data: 'city'},
                    {data: 'actions'}
                    
                ]
            });
        }
</script>

@endsection
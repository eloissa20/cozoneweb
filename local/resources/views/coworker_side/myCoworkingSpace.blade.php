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
        <table id="data-table" class="table table-hover" style="width: 100%;">
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

<!-- Modal for Viewing Space Details -->
<div class="modal fade" id="viewSpaceModal" tabindex="-1" aria-labelledby="viewSpaceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewSpaceModalLabel">Space Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="headerImage" src="" class="img-fluid rounded me-3" alt="Space image" style="width: 60%; object-fit: cover;">
                <h5 id="spaceName"></h5>
                <p id="spaceCity"></p>
                <p id="spaceDescription"></p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script>

 // Load DataTables
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

      // View Space
      function viewSpaceDetails(id) {
    // console.log('Fetching details for space ID:', id);
        $.ajax({
            url: './viewSpaceDetails/' + id,
            type: 'GET',
            success: function (response) {
                // console.log(response);
                $('#spaceName').text(response.space_name);
                $('#spaceCity').text(response.city);
                $('#spaceDescription').text(response.description);
                $('#headerImage').attr('src', response.header_image);
                $('#viewSpaceModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching space details:', xhr.responseText);
                alert('Failed to fetch space details. Please try again later.');
            }
        });
    }

      //Delete space
      function deleteSpace(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: './deleteSpace/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        );
                        $('#data-table').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        console.error('Error deleting space:', xhr.responseText);
                        Swal.fire(
                            'Error!',
                            'Failed to delete space. Please try again later.',
                            'error'
                        );
                    }
                });
            }
        });
    }
    
</script>

@endsection
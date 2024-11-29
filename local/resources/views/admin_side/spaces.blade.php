@extends('admin_side.side')

@section('content')
<style>
    .card{
        border: 1px solid #000000;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="card shadow-xl">
    <div class="card-header">
        <h5 class="card-title">Transactions Table</h5>
        <h6 class="card-subtitle text-muted">List of transactions in the database</h6>
    </div>
    <div class="card-body">
        <table id="spaces-table" class="table table-hover" style="width: 100%;">
            <thead>
                <tr>
                    <th>Space Name</th>
                    <th>Address</th>
                    <th>Available Days</th>
                    <th>Operating Hours</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="viewSpaceModal" tabindex="-1" aria-labelledby="viewSpaceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body">
                <div class="p-3">
                  <div class="d-flex flex-row">
                    <div class="col">
                      <h4 class="fw-bold mb-3" id="space"></h3>
                    </div>
                    <div class="col d-flex justify-content-end">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                  </div>
                  <div class="d-flex flex-row">
                    <div class="col">
                        <p class="m-0">Space Name</p>
                        <p class="m-0" id="space"></p>
                      <p class="m-0">Address</p>
                      <p id="address"></p>
                      <p class="m-0">Operating Days</p>
                      <p id="days"></p>
                      <p class="m-0">Close At</p>
                      <p id="close"></p>
                      <p class="m-0">Operating Hours</p>
                      <p id="hours"></p>
                      <p class="m-0">Email</p>
                      <p id="email"></p>
                      <p class="m-0">Phone</p>
                      <p id="phone"></p>
                    </div>
                    <div class="col">
                      <p class="m-0">Instagram</p>
                      <p id="ig"></p>
                      <p class="m-0">Facebook</p>
                      <p id="fb"></p>
                      <p class="m-0">Contact Number</p>
                      <p id="contact"></p>
                      <p class="m-0">Description</p>
                      <p id="desc"></p>
                      <p class="m-0">Created At</p>
                      <p id="created_at"></p>
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
            $('#spaces-table').DataTable({
                'scrollX': true,
            
                'serverSide': true,
                'ajax': {
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    'url': './spaces',
                    'type': 'GET',
                },
                order: [
                    [0, "asc"],
                ],
                'columns': [
                    {data: 'space_name'},
                    {data: 'coworking_space_address'},
                    {
                        data: null,
                        render: function (data, type, row) {
                            return `${row.available_days_from} - ${row.available_days_to}`;
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return `${row.operating_hours_from} - ${row.operating_hours_to}`;
                        }
                    },
                    {data: 'email'},
                    {data: 'phone'},
                    {data: 'actions'},
                ]
            });
        }

        function viewSpaceDetails(id) {
        $.ajax({
            url: './viewSpaceDetails/' + id,
            type: 'GET',
            success: function (response) {

                const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
                const formatDate = (dateString) => {
                    return new Date(dateString).toLocaleDateString(undefined, options);
                };

                $('#space').text(response.coworking_space_name);
                $('#adress').text(response.coworking_space_location);
                $('#type').text(response.type_of_space);
                $('#days').text(response.available_days_from + " - " + response.available_days_to);
                $('#hours').text(response.operating_hours_from + " - " + response.operating_hours_to);
                $('#email').text(response.email);
                $('#ig').text(response.instagram);
                $('#close').text(response.exceptions);
                $('#fb').text(response.facebook);
                $('#contact').text(response.contact_no);
                $('#desc').text(response.description);
                $('#created_at').text(formatDate(response.created_at));
                $('#viewSpaceModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching space details:', xhr.responseText);
                alert('Failed to fetch space details. Please try again later.');
            }
        });
    }
</script>

@endsection

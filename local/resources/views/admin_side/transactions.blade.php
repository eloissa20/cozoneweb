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
        <table id="transactions-table" class="table table-hover" style="width: 100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Space</th>
                    <th>Reservation Date</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="viewTransactionModal" tabindex="-1" aria-labelledby="viewTransactionModalLabel" aria-hidden="true">
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
                      <div class="row">
                        <p class="m-0">Name</p>
                        <p class="" id="name"></p>
                      </div>
                      <p class="m-0">Reservation Date</p>
                      <p id="reservation_date"></p>
                      <p class="m-0">Hours</p>
                      <p id="hours"></p>
                      <p class="m-0">Number of Guest</p>
                      <p id="guests"></p>
                      <p class="m-0">Email</p>
                      <p id="email"></p>
                      <p class="m-0">Contact</p>
                      <p id="contact"></p>
                      <p class="m-0">Time of Arrival</p>
                      <p id="arrival_time"></p>
                    </div>
                    <div class="col">
                      <p class="m-0">Payment Method</p>
                      <p id="payment_method"></p>
                      <p class="m-0">Amount</p>
                      <p id="amount"></p>
                      <p class="m-0">Status</p>
                      <p id="status"></p>
                      <p class="m-0">Company</p>
                      <p id="company"></p>
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
            $('#transactions-table').DataTable({
                'scrollX': true,
            
                'serverSide': true,
                'ajax': {
                    'headers': {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    'url': './transactions',
                    'type': 'GET',
                },
                order: [
                    [0, "asc"],
                ],
                'columns': [
                    {data: null, // No direct data source for this column
                    render: function (data, type, row, meta) {
                        return meta.row + 1 + meta.settings._iDisplayStart; // Dynamic row number
                        }
                    },
                    {data: 'name'},
                    {data: 'cowork.coworking_space_name'},
                    {data: 'reservation_date'},
                    {data: 'created_at'},
                    {data: 'actions'},
                ]
            });
        }

        function viewTransactionDetails(id) {
        $.ajax({
            url: './viewTransactionDetails/' + id,
            type: 'GET',
            success: function (response) {

                const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
                const formatDate = (dateString) => {
                    return new Date(dateString).toLocaleDateString(undefined, options);
                };

                const timeOptions = { hour: '2-digit', minute: '2-digit' };
                const formatTime = (timeString) => {
                    return new Date('1970-01-01T' + timeString).toLocaleTimeString(undefined, timeOptions);
                };
                $('#space').text(response.cowork.coworking_space_name);
                $('#name').text(response.name);
                $('#reservation_date').text(formatDate(response.reservation_date));
                $('#hours').text(response.hours);
                $('#guests').text(response.guests);
                $('#email').text(response.email);
                $('#contact').text(response.contact);
                $('#arrival_time').text(formatTime(response.arrival_time));
                $('#payment_method').text(response.payment_method  || 'Unknown');
                $('#status').text(response.status);
                $('#amount').text(response.amount || 'Unknown');
                $('#company').text(response.company || 'Unknown');
                $('#created_at').text(formatDate(response.created_at));
                $('#viewTransactionModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching space details:', xhr.responseText);
                alert('Failed to fetch space details. Please try again later.');
            }
        });
    }
</script>

@endsection

@extends('coworker_side.side')

@section('content')

Reservation
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
                    <th>User ID</th>
                    <th>Space ID</th>
                    <th>Reservation Date</th>
                    <th>Hours</th>
                    <th>Guest</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th>Contact</th>
                    <th>Arrival Time</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Created at</th>
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
    });

    const loadtableData = () => {
        $('#data-table').DataTable({
            'scrollX': true,
            'serverSide': true,
            'ajax': {
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'url': './reservations',
                'type': 'GET',
            },
            order: [
                [0, "asc"],
            ],
            'columns': [
                { data: 'id' },
                { data: 'user_id' },
                { data: 'space_id' },
                { data: 'reservation_date' },
                { data: 'hours' },
                { data: 'guests' },
                { data: 'name' },
                { data: 'email' },
                { data: 'company' },
                { data: 'contact' },
                { data: 'arrival_time' },
                { data: 'amount' },
                { data: 'payment_method' },
                { data: 'status' },
                { data: 'created_at' },
                { data: 'actions' },
            ]
        });
    };

    $(document).on('click', '.status-btn', function () {
        const transactionId = $(this).data('id');
        const newStatus = $(this).data('status');
        const button = $(this);

        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to change the status to ${newStatus}.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ url("/coworker_side/update-status") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        transaction_id: transactionId,
                        status: newStatus
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#data-table').DataTable().ajax.reload();
                            Swal.fire('Updated!', response.message, 'success');
                        } else {
                            Swal.fire('Failed!', response.message, 'error');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error:', error);
                        Swal.fire('Error!', 'An error occurred while updating the status.', 'error');
                    }
                });
            }
        });
    });
</script>

@endsection
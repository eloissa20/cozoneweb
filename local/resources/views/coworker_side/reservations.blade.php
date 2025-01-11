@extends('coworker_side.side')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="card shadow-xl">
    <div class="card-header">
        <h5 class="card-title">Reservations</h5>
        <h6 class="card-subtitle text-muted">Manage reservations by status</h6>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="reservationTabs" role="tablist">
            @foreach (['ALL', 'PENDING', 'CONFIRMED', 'COMPLETED', 'FAILED', ] as $status)
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ strtolower($status) }}" 
                            data-bs-toggle="tab" data-bs-target="#table-{{ strtolower($status) }}" 
                            type="button" role="tab" aria-controls="table-{{ strtolower($status) }}" 
                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                        {{ ucfirst(strtolower($status)) }}
                    </button>
                </li>
            @endforeach
        </ul>

        <div class="tab-content mt-3">
            @foreach (['ALL', 'PENDING', 'CONFIRMED', 'COMPLETED', 'FAILED', ] as $status)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="table-{{ strtolower($status) }}" role="tabpanel">
                    <table id="data-table-{{ strtolower($status) }}" class="table table-hover" style="width: 100%;">
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
            @endforeach
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        const statuses = ['ALL', 'PENDING', 'CONFIRMED', 'COMPLETED', 'FAILED', ];
        const dataTables = {};

        const initializeTable = (status) => {
            const tableId = `data-table-${status.toLowerCase()}`;
            dataTables[status] = $(`#${tableId}`).DataTable({
                scrollX: true,
                serverSide: true,
                ajax: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: './reservations',
                    type: 'GET',
                    data: { status: status },
                },
                order: [[0, 'asc']],
                columns: [
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
                ],
            });
        };

        statuses.forEach((status) => {
            initializeTable(status);
        });

        $(document).on('change', '.change-status', function () {
            const transactionId = $(this).data('id');
            const newStatus = $(this).val();

            if (!newStatus) return;

            Swal.fire({
                title: 'Are you sure?',
                text: `Change status to ${newStatus}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, update it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url("/coworker_side/update-status") }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            transaction_id: transactionId,
                            status: newStatus,
                        },
                        success: (response) => {
                            if (response.success) {
                                Swal.fire('Updated!', response.message, 'success');

                                statuses.forEach((status) => {
                                    if (newStatus.toUpperCase() === status || status === 'ALL') {
                                        dataTables[status].ajax.reload(null, false);
                                    }
                                });
                            } else {
                                Swal.fire('Error!', response.message, 'error');
                            }
                        },
                        error: (xhr) => {
                            console.error(xhr.responseText);
                            Swal.fire('Error!', 'An error occurred.', 'error');
                        },
                    });
                }
            });
        });
    });

</script>

@endsection
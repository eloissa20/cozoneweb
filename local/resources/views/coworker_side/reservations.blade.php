@extends('coworker_side.side')

@section('content')
<style>
    .dropdown-hover:hover .dropdown-menu {
        display: block;
        position: fixed;
        z-index: 1055;
        top: auto;
        left: auto;
        transform: translate(0, 0);
    }


    .dataTables_wrapper {
        overflow: visible !important;
    }

    .dropdown-menu {
        will-change: transform;
        margin: 0;
        padding: 0.5rem;
    }
</style>

<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="card shadow-xl">
    <div class="card-header">
        <h5 class="card-title">Reservations</h5>
        <h6 class="card-subtitle text-muted">Manage reservations by status</h6>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="reservationTabs" role="tablist">
            @foreach (['ALL', 'PENDING', 'CONFIRMED', 'COMPLETED', 'FAILED', 'REFUNDED'] as $status)
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
            @foreach (['ALL', 'PENDING', 'CONFIRMED', 'COMPLETED', 'FAILED', 'REFUNDED'] as $status)
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
    $(document).ready(function() {
        const statuses = ['ALL', 'PENDING', 'CONFIRMED', 'COMPLETED', 'FAILED', 'REFUNDED'];
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
                    data: {
                        status: status
                    },
                },
                order: [
                    [0, 'asc']
                ],
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'user_id'
                    },
                    {
                        data: 'space_id'
                    },
                    {
                        data: 'reservation_date'
                    },
                    {
                        data: 'hours'
                    },
                    {
                        data: 'guests'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'company'
                    },
                    {
                        data: 'contact'
                    },
                    {
                        data: 'arrival_time'
                    },
                    {
                        data: 'amount'
                    },
                    {
                        data: 'payment_method'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'actions'
                    },
                ],
            });
        };

        statuses.forEach((status) => {
            initializeTable(status);
        });

        $(document).on('click', '.status-btn', function() {
            const transactionId = $(this).data('id');
            const newStatus = $(this).data('status');

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to change the status to ${newStatus}.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url("/coworker_side/update-status") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            transaction_id: transactionId,
                            status: newStatus,
                        },
                        success: function(response) {
                            if (response.success) {
                                statuses.forEach((status) => {
                                    if (dataTables[status]) {
                                        dataTables[status].ajax.reload(null, false);
                                    }
                                });
                                Swal.fire('Updated!', response.message, 'success');
                            } else {
                                Swal.fire('Failed!', response.message, 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', error);
                            Swal.fire('Error!', 'An error occurred while updating the status.', 'error');
                        },
                    });
                }
            });
        });
    });
</script>

@endsection
@extends('coworker_side.side')

@section('content')

<style>
    .separator-line {
        border: none;
        height: 2px;
        background-color: #1f1f1f;
        margin: 10px 0;
    }

    .status-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        font-size: 1rem;
    }

    .status-color {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 8px;
    }

    .status-label {
        flex: 1;
    }

    .status-count {
        font-weight: bold;
    }

    .doughnut-center-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.5rem;
        font-weight: bold;
    }

    .doughnut-center-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.5rem;
        font-weight: bold;
    }

    label {
        font-size: 0.9rem;
        margin-bottom: 5px;
    }

    input[type="checkbox"] {
        margin-right: 5px;
    }
</style>
<div class="mb-3">
    {{-- <h4>Admin : {{ Auth::user()->name }}</h4> --}}
    <h2><strong>COWORKING SPACE ACTIVITY</strong></h2>
    <hr class="separator-line" />
</div>
{{-- <div class="row">
    <div class="col-12 col-md-6 d-flex">
        <div class="card flex-fill border-0 illustration">
            <div class="card-body p-0 d-flex flex-fill">
                <div class="row g-0 w-100">
                    <div class="col">
                        <div class="p-3 m-1">
                            <h4>Welcome Back, {{ Auth::user()->name }}</h4>
<p class="mb-0">Admin Dashboard</p>
</div>
</div>
<div class="col-6 align-self-end text-end">
    <img src="{{ asset('img/poster.jpg') }}" class="img-fluid illustration-img"
        alt="">
</div>
</div>
</div>
</div>
</div>
<div class="col-12 col-md-6 d-flex">
    <div class="card flex-fill border-0">
        <div class="card-body py-4">
            <div class="d-flex align-items-start">
                <div class="flex-grow-1">
                    <h4 class="mb-2">
                        {{ $data['total_users'] }}
                    </h4>
                    <p class="mb-2">
                        Total Users
                    </p>
                    <div class="mb-0">
                        <span class="badge text-success me-2">
                            {{ $data['percentage_change'] > 0 ? '+' : '' }}{{ $data['percentage_change'] }}%
                        </span>
                        <span class="text-muted">
                            Since Last Month
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div> --}}

{{-- <div class="card border-0">
    <div class="card-header">
        <h5 class="card-title">Users Table</h5>
        <h6 class="card-subtitle text-muted">List of registered users</h6>
    </div>
    <div class="card-body">
        <table id="users-table" class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['users'] as $user)
                <tr>
                    <td>{{ $user->id }}</td>
<td>{{ $user->name }}</td>
<td>{{ $user->email }}</td>
<td>{{ $user->created_at }}</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div> --}}


<div class="row g-3 mt-2">
    <div class="col-12 col-md-6">
        <div class="row g-3">
            <div class="col-12">
                <div class="rounded-4 border p-4 mb-2 shadow" style="background-color: #ffffff; min-height: 200px;">
                    <h5 class="fw-bold mb-0">Reservation Transactions</h5>
                    <hr style="border: 0.5px solid #ddd; width: 100%; margin: 8px auto;" />
                    <div class="d-flex justify-content-around align-items-center">
                        <div class="text-center position-relative">
                            <canvas id="transactionChart" style="max-width: 100%; max-height: 245px;"></canvas>
                            <div class="doughnut-center-text">
                                <span id="alltransacCount" class="fs-2 fw-bold">0</span>
                            </div>
                        </div>
                        <div class="ms-3" id="statusLegend">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="rounded-4 border shadow text-center m-auto p-3" style="background-color: #ffffff; min-height: 100px;">
                    <h2 id="freePassCount" style="font-weight: bold; font-size: 36px; margin: 0;">0</h2>
                    <hr style="border: 0.5px solid #ddd; width: 100%; margin: 8px auto;" />
                    <p style="font-size: 14px; font-weight: bold; color: #333; margin: 0;">Free Day Passes</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="rounded-4 border p-4 mb-3 shadow" style="background-color: #ffffff; min-height: 320px;">
            <h5 class="fw-bold mb-0">Reservation Type</h5>
            <hr style="border: 0.5px solid #ddd; width: 100%; margin: 8px auto;" />
            <div class="d-flex justify-content-center align-items-center">
                <canvas id="reservationTypeChart" style="max-width: 100%; height: 315px;"></canvas>
            </div>
            <div class="d-flex justify-content-between mt-3">
                <div>
                    <label>{{-- <input type="radio" name="statusFilter" value="Meeting Rooms" /> --}} Meeting Rooms <b id="meetingRoomsCount">0</b></label><br>
                    <label>{{-- <input type="radio" name="statusFilter" value="Virtual Offices" /> --}} Virtual Offices <b id="virtualOfficesCount">0</b></label><br>
                </div>
                <div>
                    <label>{{-- <input type="radio" name="statusFilter" value="All" /> --}} All <b id="alltypeCount">0</b></label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="rounded-4 border mb-3 p-4 shadow" style="background-color: #ffffff; min-height: 300px;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Current Occupancy</h5>
                <span class="text-muted" id="currentDate">Wed May 23, 2024</span>
            </div>
            <hr style="border: 0.5px solid #ddd;" />
            <div class="d-flex justify-content-around align-items-center mt-3">
                <!-- Doughnut Chart -->
                <div class="text-center position-relative">
                    <canvas id="occupancyChart" style="width: 100px; height: 100px;"></canvas>
                    <div class="doughnut-center-text">
                        <span id="occupancyPercentage" class="fs-4 fw-bold">60%</span>
                    </div>
                </div>
                <!-- Occupancy Count -->
                <div class="text-center">
                    <h2 class="fw-bold" id="currentOccupancy">12</h2>
                </div>
            </div>
            <div class="text-center mt-3">
                <p class="mb-1">Max Occupancy <span class="fw-bold" id="maxOccupancy">20</span></p>
                <div class="d-flex justify-content-center flex-wrap">
                    <label class="me-3"><input type="checkbox" id="deskFilter" checked /> Desk</label>
                    <label class="me-3"><input type="checkbox" id="meetingRoomFilter" /> Meeting Room</label>
                    <label class="me-3"><input type="checkbox" id="virtualOfficeFilter" /> Virtual Offices</label>
                    <label><input type="checkbox" id="allFilter" /> All</label>
                </div>
            </div>
            <div class="text-center text-muted mt-3" id="lastUpdated">
                Last Updated on Wed May 23, 2024 14:27
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="rounded-4 border mb-3 p-4 shadow" style="background-color: #ffffff; min-height: 300px;">
            Total Revenue
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="border rounded-4 p-2">
                        <h5>Today's Money</h5>
                        <div class="flex-grow-1">
                            <h4 class="mb-2">
                                ₱{{ number_format($todaysMoney, 2) }}
                            </h4>
                            <div class="mb-0">
                                <span class="badge text-{{ $moneyChangeYesterday >= 0 ? 'success' : 'danger' }} me-2">
                                    {{ number_format($moneyChangeYesterday, 2) }}%
                                </span>
                                <span class="text-muted">
                                    than yesterday
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded-4 p-2">
                        <h5>Today's Clients</h5>
                        <div class="flex-grow-1">
                            <h4 class="mb-2">
                                {{ $todaysClients }}
                            </h4>
                            <div class="mb-0">
                                <span class="badge text-{{ $clientsChangeYesterday >= 0 ? 'success' : 'danger' }} me-2">
                                    {{ number_format($clientsChangeYesterday, 2) }}%
                                </span>
                                <span class="text-muted">
                                    than yesterday
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="border rounded-4 p-2">
                        <h5>Total Sales</h5>
                        <div class="flex-grow-1">
                            <h4 class="mb-2">
                                ₱{{ $totalSales }}
                            </h4>
                            <div class="mb-0">
                                <span class="badge text-{{ $salesChangeLastWeek >= 0 ? 'success' : 'danger' }} me-2">
                                    {{ number_format($salesChangeLastWeek, 2) }}%
                                </span>
                                <span class="text-muted">
                                    than last week
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded-4 p-2">
                        <h5>New Clients</h5>
                        <div class="flex-grow-1">
                            <h4 class="mb-2">
                                {{ $todaysNewClients }}
                            </h4>
                            <div class="mb-0">
                                <span class="badge text-{{ $newClientsChangeLastWeek >= 0 ? 'success' : 'danger' }} me-2">
                                    {{ number_format($newClientsChangeLastWeek, 2) }}%
                                </span>
                                <span class="text-muted">
                                    than last week
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="rounded-4 border p-4" style="background-color: #ffffff; min-height: 150px;">
            <div class="col border rounded-4 p-2 mt-3">
                <h5>Daily Sales</h5>
                <canvas id="dailySalesChart" style="max-width: 100%; max-height: 300px;"></canvas>
            </div>
        </div>
    </div>

</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready(function() {
        $('#users-table').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        function getFreePassCount() {
            $.ajax({
                url: "{{ route('countFreePass') }}",
                type: 'GET',
                success: function(response) {
                    $('#freePassCount').text(`${response.free_pass_count}`);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching free pass count:', error);
                    $('#freePassCount').text('Error loading data.');
                }
            });
        }

        getFreePassCount();
    });


    $(document).ready(function() {
        let transactionChart = null;

        $.ajax({
            url: "{{ route('reservationTransactions') }}",
            type: 'GET',
            success: function(statuses) {
                const statusLabels = Object.keys(statuses);
                const statusCounts = Object.values(statuses);
                const totalCount = statusCounts.reduce((sum, count) => sum + count, 0);

                // Update total transaction count
                $('#alltransacCount').text(totalCount);

                // Define colors for each status
                const colors = {
                    PENDING: '#FFC107',
                    CONFIRMED: '#4CAF50',
                    COMPLETED: '#2196F3',
                    FAILED: '#F44336',
                    REFUNDED: '#9E9E9E',
                };

                const legendContainer = $('#statusLegend');
                legendContainer.empty();
                statusLabels.forEach((label, index) => {
                    const color = colors[label] || '#000';
                    const count = statusCounts[index];

                    const legendItem = `
                    <div class="status-item">
                        <div class="status-color" style="background-color: ${color};"></div>
                        <div class="status-label">${label}=</div>
                        <div class="status-count">${count}</div>
                    </div>
                `;
                    legendContainer.append(legendItem);
                });

                const ctx = document.getElementById('transactionChart').getContext('2d');
                if (transactionChart instanceof Chart) {
                    transactionChart.destroy();
                }
                transactionChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: statusLabels,
                        datasets: [{
                            data: statusCounts,
                            backgroundColor: statusLabels.map(label => colors[label] || '#000'),
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                        },
                        cutout: '75%'
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching reservation transactions:', error);
            }
        });
    });



    $(document).ready(function() {
        $.ajax({
            url: "{{ url('/reservation-type-counts') }}",
            type: 'GET',
            success: function(data) {
                const meetingRoomsCount = data.meetingRoomsCount;
                const virtualOfficesCount = data.virtualOfficesCount;
                const totalCount = meetingRoomsCount + virtualOfficesCount;

                $('#meetingRoomsCount').text(meetingRoomsCount);
                $('#virtualOfficesCount').text(virtualOfficesCount);
                $('#alltypeCount').text(totalCount);

                const ctx = document.getElementById('reservationTypeChart').getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        // labels: ['Meeting Rooms', 'Virtual Offices'],
                        datasets: [{
                            data: [meetingRoomsCount, virtualOfficesCount],
                            backgroundColor: ['#4CAF50', '#FFC107'],
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        const label = tooltipItem.label;
                                        const value = tooltipItem.raw;
                                        const type = label === 'Meeting Rooms' ? 'Meeting Room' : 'Virtual Office';
                                        return `${type}: ${value}`;
                                    }
                                }
                            }
                        },
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching reservation type counts:', error);
            }
        });
    });

    fetch('{{ url(' / daily - sales - chart - data ') }}')
        .then(response => response.json())
        .then(data => {
            const dailySalesData = data.dailySales;
            const labels = data.labels;

            const ctx = document.getElementById('dailySalesChart').getContext('2d');
            const dailySalesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Daily Sales',
                        data: dailySalesData,
                        fill: false,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Sales Amount'
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching the daily sales data:', error));

    $(document).ready(function() {
        // Initialize date and time
        const currentDate = new Date().toLocaleString('en-US', {
            weekday: 'short',
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
        const currentTime = new Date().toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit'
        });
        $('#currentDate').text(currentDate);
        $('#lastUpdated').text(`Last Updated on ${currentDate} ${currentTime}`);

        // Dummy data
        const maxOccupancy = 20;
        const currentOccupancy = 12;

        // Update occupancy data
        $('#currentOccupancy').text(currentOccupancy);
        $('#maxOccupancy').text(maxOccupancy);
        const percentage = Math.round((currentOccupancy / maxOccupancy) * 100);
        $('#occupancyPercentage').text(`${percentage}%`);

        // Doughnut chart
        const ctx = document.getElementById('occupancyChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Occupied', 'Available'],
                datasets: [{
                    data: [currentOccupancy, maxOccupancy - currentOccupancy],
                    backgroundColor: ['#4CAF50', '#E0E0E0'], // Colors for occupied and available
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%', // Creates the hollow center
                plugins: {
                    legend: {
                        display: false
                    },
                },
            },
        });
    });
</script>
@endsection
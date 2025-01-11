@extends('coworker_side.side')

@section('content')

<style>
    .separator-line {
        border: none;
        height: 2px;
        background-color: #1f1f1f;
        margin: 10px 0;
    }
    .rounded-container {
        background-color: #ffffff;
        min-height: 200px;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #ddd;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .status-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        font-size: 1rem;
    }
    .status-color {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        margin-right: 8px;
    }
    .doughnut-center-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.25rem;
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

<div class="container">
    <h2><strong>COWORKING SPACE ACTIVITY</strong></h2>
    <a href="{{ url('/export-transactions') }}" class="btn btn-dark">Download Transactions</a>
    <hr class="separator-line" />
    
    <div class="row g-2">
        <div class="col-12">
            <div class="rounded-container mb-4">
                <h5 class="fw-bold">Reservation Transactions</h5>
                <div id="lastUpdated" class="text-muted">
                    Last Updated on <span id="currentDate"></span>
                </div>
                <hr />
                <div class="row align-items-center">
                    <div class="col-lg-6 text-center position-relative">
                        <canvas id="transactionChart" class="w-100" style="max-height: 250px;"></canvas>
                        <div class="doughnut-center-text">
                            <span id="alltransacCount">0</span>
                        </div>
                    </div>
                    <div class="col-lg-6" id="statusLegend"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="rounded-container">
                <h5>Today's Money</h5>
                <h4>₱{{ number_format($todaysMoney, 2) }}</h4>
                <span class="badge text-{{ $moneyChangeYesterday >= 0 ? 'success' : 'danger' }}">
                    {{ number_format($moneyChangeYesterday, 2) }}%
                </span> than yesterday
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="rounded-container">
                <h5>Today's Clients</h5>
                <h4>{{ $todaysClients }}</h4>
                <span class="badge text-{{ $clientsChangeYesterday >= 0 ? 'success' : 'danger' }}">
                    {{ number_format($clientsChangeYesterday, 2) }}%
                </span> than yesterday
            </div>
        </div>

        <div class="col-lg-6">
            <div class="rounded-container">
                <h5>Total Sales</h5>
                <h4>₱{{ $totalSales }}</h4>
                <span class="badge text-{{ $salesChangeLastWeek >= 0 ? 'success' : 'danger' }}">
                    {{ number_format($salesChangeLastWeek, 2) }}%
                </span> than last week
            </div>
        </div>

        <div class="col-lg-6">
            <div class="rounded-container">
                <h5>New Clients</h5>
                <h4>{{ $todaysNewClients }}</h4>
                <span class="badge text-{{ $newClientsChangeLastWeek >= 0 ? 'success' : 'danger' }}">
                    {{ number_format($newClientsChangeLastWeek, 2) }}%
                </span> than last week
            </div>
        </div>

        <div class="col-12">
            <div class="rounded-container">
                <h5>Daily Sales</h5>
                <canvas id="dailySalesChart" class="w-100" style="max-height: 300px;"></canvas>
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

    
    $(document).ready(function () {
    let transactionChart = null;

        $.ajax({
            url: "{{ route('reservationTransactions') }}",
            type: 'GET',
            success: function (statuses) {
                const statusLabels = Object.keys(statuses);
                const statusCounts = Object.values(statuses);
                const totalCount = statusCounts.reduce((sum, count) => sum + count, 0);

                $('#alltransacCount').text(totalCount);

                const colors = {
                    PENDING: '#FFC107',
                    CONFIRMED: '#4CAF50',
                    COMPLETED: '#2196F3',
                    FAILED: '#F44336',
                };

                const legendContainer = $('#statusLegend');
                legendContainer.empty();
                statusLabels.forEach((label, index) => {
                    const color = colors[label] || '#000';
                    const count = statusCounts[index];

                    const legendItem = `
                        <div class="status-item">
                            <div class="status-color" style="background-color: ${color};"></div>
                            <div class="status-label">${label}     </span>
                            <div class="status-count">${count}   </div>
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
                            legend: { display: false },
                        },
                        cutout: '75%'
                    }
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching reservation transactions:', error);
            }
        });
    });



    $(document).ready(function () {
    $.ajax({
        url: "{{ url('/reservation-type-counts') }}",
        type: 'GET',
        success: function (data) {
            const deskCount = data.deskCount;
            const occupiedDeskCount = data.occupiedDeskCount;
            const meetingCount = data.meetingCount;
            const occupiedMeetingCount = data.occupiedMeetingCount;
            const virtualOfficesCount = data.virtualOfficesCount;
            const occupiedVirtualOfficesCount = data.occupiedVirtualOfficesCount;

            const totalCount = deskCount + meetingCount + virtualOfficesCount;
            const totalOccupiedCount = occupiedDeskCount + occupiedMeetingCount + occupiedVirtualOfficesCount;

            // Update counts on the page
            $('#deskCount').text(deskCount);
            $('#occupiedDeskCount').text(occupiedDeskCount);
            $('#meetingCount').text(meetingCount);
            $('#occupiedMeetingCount').text(occupiedMeetingCount);
            $('#virtualOfficesCount').text(virtualOfficesCount);
            $('#occupiedVirtualOfficesCount').text(occupiedVirtualOfficesCount);
            $('#totalCount').text(totalCount);
            $('#totalOccupiedCount').text(totalOccupiedCount);

            // Update the chart
            const ctx = document.getElementById('reservationTypeChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Desk Fields'],
                    datasets: [{
                        data: [deskCount],
                        backgroundColor: ['#e9ecef'],
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
                                label: function (tooltipItem) {
                                    const label = tooltipItem.label;
                                    const value = tooltipItem.raw;
                                    return `${label}: ${value}`;
                                }
                            }
                        }
                    },
                }
            });
        },
        error: function (xhr, status, error) {
            console.error('Error fetching reservation type counts:', error);
        }
    });
});


    fetch('{{ url('/daily-sales-chart-data') }}')
        .then(response => response.json())
        .then(data => {
            console.log(data);

            if (!Array.isArray(data.dailySales) || !Array.isArray(data.labels)) {
                console.error('Invalid data format:', data);
                return;
            }

            const dailySalesData = data.dailySales;
            const labels = data.labels;

            const ctx = document.getElementById('dailySalesChart').getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Daily Sales',
                        data: dailySalesData,
                        fill: false,
                        borderColor: '#404040',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            // position: 'top',
                            display: false,
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


    $(document).ready(function () {
        const currentDate = new Date().toLocaleString('en-US', {
            weekday: 'short',
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
        const currentTime = new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
        $('#currentDate').text(currentDate);
        $('#lastUpdated').text(`Last Updated on ${currentDate} ${currentTime}`);

        const maxOccupancy = 20;
        const currentOccupancy = 12;

        $('#currentOccupancy').text(currentOccupancy);
        $('#maxOccupancy').text(maxOccupancy);
        const percentage = Math.round((currentOccupancy / maxOccupancy) * 100);
        $('#occupancyPercentage').text(`${percentage}%`);

        const ctx = document.getElementById('occupancyChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Occupied', 'Available'],
                datasets: [
                    {
                        data: [currentOccupancy, maxOccupancy - currentOccupancy],
                        backgroundColor: ['#4CAF50', '#E0E0E0'],
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: { display: false },
                },
            },
        });
    });

</script>
@endsection

@extends('layouts.client_header')
@section('title', 'Reservation Details')
@section('content')
    <style>
        .reservation-confirmation {
            padding: 20px;
        }

        .reservation-confirmation h2 {
            margin-bottom: 30px;
        }

        .box {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
        }

        .address-details {
            height: 250px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
        }


        .coworking-space img {
            width: 100%;
            height: 100%;
        }

        .map-placeholder {
            background: #eaeaea;
            width: 100%;
            height: 100%;
        }

        .help-section a {
            display: block;
            margin-top: 5px;
        }

        .back-button {
            margin-bottom: 20px;
        }

        .table td,
        .table th {
            padding: 10px;
        }
    </style>
    <div class="container reservation-confirmation page">
        <a href="{{ route('client_side.profile.transactions') }}" class="back-button text-decoration-none">
            <i class="bi bi-arrow-left"></i> My Reserved Space
        </a>
        <h2>Your reservation is {{ $transaction->status }}!</h2>
        <div class="row">
            <div class="col-lg-6">
                <div class="box">
                    <h4>Reservation details</h4>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <p><strong>Booked:</strong></p>
                                    <p>{{ $transaction->created_at->format('D, M d, Y') }}</p>
                                </td>
                                <td>
                                    <p><strong>ID Invoice</strong></p>
                                    <p>#00000{{ $transaction->id }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><strong>Full Name</strong></p>
                                    <p>{{ $transaction->name }}</p>
                                </td>
                                <td>
                                    <p><strong>Email Address</strong></p>
                                    <p>{{ $transaction->email }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><strong>Number of Hours</strong></p>
                                    <p>{{ $transaction->hours }}</p>
                                </td>
                                <td>
                                    <p><strong>Contact No.</strong></p>
                                    <p>{{ $transaction->contact }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><strong>Number of Guest</strong></p>
                                    <p>{{ $transaction->guests }} guest(s)</p>
                                </td>
                                <td>
                                    <p><strong>Company/University/Name</strong></p>
                                    <p>{{ $transaction->company ? $transaction->company : 'Not available' }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><strong>Arrival Time</strong></p>
                                    <p>{{ \Carbon\Carbon::parse($transaction->arrival_time)->format('h:i A') }}</p>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="box address-details">
                    <div id="map" class="map-placeholder">

                    </div>
                    <div>
                        <p>{{ $space->unit }}, {{ $space->city }}, {{ $space->location }}, {{ $space->country }},</p>
                    </div>
                </div>

                <div class="box">
                    <h4>Total cost</h4>
                    <p style="text-transform: capitalize"><strong>Payment Method:</strong> {{ $transaction->payment_method }}</p>
                    <p><strong>Coworking Space Cost:</strong> ₱ {{ $transaction->amount / $transaction->guests }}</p>
                    <p><strong>Discount:</strong> ₱ 0.00</p>
                    <p><strong>Total:</strong> ₱ {{ $transaction->amount }}</p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="box coworking-space">
                    <img class="mb-2" src="{{ asset($space->header_image) }}" alt="">
                    <div class="">
                        <div class="flex">
                            <h4>{{ $space->coworking_space_name }}</h4>
                            <p>{{ $space->coworking_space_address }}</p>
                            <p>{{ $space->operating_hours_from }} - {{ $space->operating_hours_to }}</p>
                        </div>
                        <div>

                            @if ($space->averageRating !== 0 || $space->averageRating !== null)
                                <span>Rating: </span>
                                @php
                                    $fullStars = floor($space->averageRating);
                                    $halfStar = $space->averageRating - $fullStars >= 0.5 ? 1 : 0;
                                    $emptyStars = 5 - ($fullStars + $halfStar);
                                @endphp
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <span style="color: gold;" class="fs-5">★</span>
                                @endfor
                                @if ($halfStar)
                                    <span style="color: gold;" class="fs-5">☆</span>
                                @endif
                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <span style="color: lightgray;" class="fs-5">☆</span>
                                @endfor
                            @else
                                <p class="text-muted">☆☆☆☆☆ 0 Reviews</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- <div class="box help-section">
                    <h4>How can we help?</h4>
                    <p>Our team is available 24/7 to assist you. 24 hours a day, 7 days a week.</p>
                    <a href="#"><i class="fas fa-question-circle"></i> Go to HOW TO</a>
                    <a href="#"><i class="fas fa-comment"></i> Text us</a>
                    <a href="#"><i class="fas fa-phone"></i> Call us</a>
                    <a href="#"><i class="fas fa-envelope"></i> Email us</a>
                </div> -->
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        const latitude = {{ $space->latitude }};
        const longitude = {{ $space->longitude }};

        const map = L.map('map').setView([latitude, longitude], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        L.marker([latitude, longitude]).addTo(map)
            .bindPopup('{{ $space->coworking_space_name }}')
            .openPopup();
    </script>
@endsection

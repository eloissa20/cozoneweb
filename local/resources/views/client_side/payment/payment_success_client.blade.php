@extends('layouts.client_header')
@section('title', 'Payment Success')
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


        .coworking-space img{
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
        <a href="{{ route('client_side.home') }}" class="back-button text-decoration-none">
            <i class="bi bi-arrow-left"></i> My Reserved Space
        </a>
        <h2>Your reservation is confirmed!</h2>
        <div class="row">
            <div class="col-lg-6">
                <div class="box">
                    <h4>Reservation details</h4>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <p><strong>Booked:</strong></p>
                                    <p> 09/20/2024</p>
                                </td>
                                <td>
                                    <p><strong>ID Invoice</strong></p>
                                    <p>#00000000</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><strong>Full Name</strong></p>
                                    <p>Maria Eloisa M. Andal</p>
                                </td>
                                <td>
                                    <p><strong>Email Address</strong></p>
                                    <p>andal@gmail.com</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><strong>Number of Hours</strong></p>
                                    <p>1-3 hours</p>
                                </td>
                                <td>
                                    <p><strong>Contact No.</strong></p>
                                    <p>096737826344</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><strong>Number of Guest</strong></p>
                                    <p>1 guest(s)</p>
                                </td>
                                <td>
                                    <p><strong>Company/University/Name</strong></p>
                                    <p>TUP</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><strong>Arrival Time</strong></p>
                                    <p>10:30 AM PH</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="box address-details">
                    <div id="map" class="map-placeholder">

                    </div>
                    <div>
                        <p>{{ $space->unit }}, {{ $space->city }}, {{ $space->location }}, {{ $space->country }},</p>
                        <button class="btn btn-secondary">Get Directions</button>
                    </div>
                </div>

                <div class="box">
                    <h4>Total cost</h4>
                    <p><strong>Payment Method:</strong> Visa **** **** 6520</p>
                    <p><strong>Coworking Space Cost:</strong> ₱80.00</p>
                    <p><strong>Discount:</strong> ₱0.00</p>
                    <p><strong>Total:</strong> ₱0.00</p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="box coworking-space">
                    <img class="mb-2" src="{{ asset($space->header_image) }}"
                        alt="">
                    <div class="">
                        <div class="flex">
                            <h4>{{ $space->coworking_space_name }}</h4>
                            <p>{{ $space->coworking_space_address }}</p>
                            <p>{{ $space->operating_hours_from }} - {{ $space->operating_hours_to }}</p>
                        </div>
                        <div>
                            <p>★★★★★</p>
                        </div>
                    </div>
                </div>

                <div class="box help-section">
                    <h4>How can we help?</h4>
                    <p>Our team is available 24/7 to assist you. 24 hours a day, 7 days a week.</p>
                    <a href="#"><i class="fas fa-question-circle"></i> Go to HOW TO</a>
                    <a href="#"><i class="fas fa-comment"></i> Text us</a>
                    <a href="#"><i class="fas fa-phone"></i> Call us</a>
                    <a href="#"><i class="fas fa-envelope"></i> Email us</a>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        const latitude = 15.3072;
        const longitude = 120.9464;

        const map = L.map('map').setView([latitude, longitude], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        L.marker([latitude, longitude]).addTo(map)
            .bindPopup('{{ $space->coworking_space_name }}')
            .openPopup();
    </script>
@endsection
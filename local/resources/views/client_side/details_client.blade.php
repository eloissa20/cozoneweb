@extends('layouts.client_header')
@section('title', 'Details')
@section('content')
    <style>
        .map-placeholder {
            background: #eaeaea;
            height: 300px;
        }

        .review-placeholder,
        .image-placeholder {
            background: #f0f0f0;
            height: 150px;
            margin-bottom: 10px;
        }
    </style>
    <div class="container page">
        <div class="row">
            <div class="col">
                <h1>{{ $space->coworking_space_name }}</h1>
                <p>★★★★★</p>
            </div>
            <div class="col text-end">
                <h2>{{ $space->coworking_space_address }}</h2>
            </div>
        </div>

        <div id="map" class="map-placeholder mb-4"></div>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">Space Overview</div>
                    <div class="card-body">
                        <p>Welcome to {{ $space->coworking_space_name }}, a vibrant coworking space located at
                            {{ $space->unit }}, {{ $space->city }}, {{ $space->location }}, {{ $space->country }},
                            offering a dynamic environment for freelancers, startups,
                            and established businesses.
                            Our facility features various workspace types, including private offices and meeting rooms, with
                            a seating capacity of {{ $space->capacity }}. We are open from {{ $space->available_days_from }}
                            to {{ $space->available_days_to }} (except on {{ $space->exceptions }}),
                            operating between {{ $space->operating_hours_from }} and {{ $space->operating_hours_to }}.
                            Enjoy amenities such as {{ $space->basics }} {{ $space->seats }} {{ $space->equipment }}
                            {{ $space->facilities }}. Membership options include short-term
                            and long-term plans at competitive prices, with various payment methods accepted. For inquiries,
                            reach us at {{ $space->email }} or {{ $space->contact_no }} / {{ $space->phone }}, and
                            connect with us on Instagram ({{ $space->instagram }}) and Facebook ({{ $space->facebook }}).
                        </p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Space Amenities & Facilities</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li> <i class="bi bi-wifi"></i> WiFi</li>
                                    <li> <i class="bi bi-air-conditioner"></i> Air Conditioned</li>
                                    <li> <i class="bi bi-kitchen"></i> Kitchen</li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li> <i class="bi bi-cup-hot"></i> Free Coffee</li>
                                    <li> <i class="bi bi-cup-hot-fill"></i> Free Tea</li>
                                    <li> <i class="bi bi-cup-straw"></i> Snacks Available for Purchase</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Space Pricing</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1 - 3 Hours</td>
                                        <td>₱80</td>
                                    </tr>
                                    <tr>
                                        <td>4 - 5 Hours</td>
                                        <td>₱120</td>
                                    </tr>
                                    <tr>
                                        <td>6 - 7 Hours</td>
                                        <td>₱180</td>
                                    </tr>
                                    <tr>
                                        <td>8 - 10 Hours</td>
                                        <td>₱210</td>
                                    </tr>
                                    <tr>
                                        <td>11 - 12 Hours</td>
                                        <td>₱260</td>
                                    </tr>
                                    <tr>
                                        <td>13 - 15 Hours</td>
                                        <td>₱310</td>
                                    </tr>
                                    <tr>
                                        <td>16 - 17 Hours</td>
                                        <td>₱370</td>
                                    </tr>
                                    <tr>
                                        <td>18 - 21 Hours</td>
                                        <td>₱430</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Space Reviews</div>
                    <div class="card-body">
                        <div class="review-placeholder mb-3">Client Review 1</div>
                        <div class="review-placeholder">Client Review 2</div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">Your Reservation Details</div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('client_side.payment', ['id' => $space->id]) }}">
                            <div class="mb-3">
                                <label for="date" class="form-label">Select Date</label>
                                <input type="date" class="form-control" id="date">
                            </div>
                            <div class="mb-3">
                                <label for="hours" class="form-label">Full Hours</label>
                                <select class="form-control" id="hours">
                                    <option>1 - 3 Hours</option>
                                    <option>4 - 5 Hours</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="guests" class="form-label">Number of Guests</label>
                                <input type="number" class="form-control" id="guests" value="1">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                            <div class="mb-3">
                                <label for="company" class="form-label">Company Name</label>
                                <input type="text" class="form-control" id="company">
                            </div>
                            <div class="mb-3">
                                <label for="contact" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="contact">
                            </div>
                            <div class="mb-3">
                                <label for="arrival" class="form-label">Estimated Arrival Time</label>
                                <input type="time" class="form-control" id="arrival">
                            </div>
                            <button type="submit" class="btn btn-primary">Pay Now</button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <img class="image-placeholder" src="{{ asset($space->header_image) }}"/>
                    </div>
                    <div class="col-6">
                        @if($space->additional_images)
                            <img class="image-placeholder" src="{{ asset($space->additional_images) }}" alt="Coworking Space Image"/>
                        @else
                            <img class="image-placeholder" src=""/>
                        @endif
                    </div>
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
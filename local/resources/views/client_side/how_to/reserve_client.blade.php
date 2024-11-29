@extends('layouts.client_header')
@section('title', 'Reserve')
@section('content')
    <style>
        .placeholder-box {
            background-color: #e0e0e0;
            height: 200px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .map-box {
            background-color: #e0e0e0;
            height: 300px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .map-box p {
            font-weight: bold;
            font-size: 24px;
            margin: 0;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-2 border-end">
                <ul class="list-unstyled p-3 text-center">
                    <li><a href="{{ route('client_side.how.reserve') }}" class="active_sidebar">How to Reserve a Seat...</a></li>
                    <li><a href="{{ route('client_side.how.find') }}">Find Office Space by Type</a></li>
                    <li><a href="{{ route('client_side.how.faqs') }}">FAQs</a></li>
                </ul>
            </nav>

            <main class="col-md-7 page main_with_sidebar">
                <div class="container-fluid bg-light text-center p-5">
                    <h1 class="display-5 fw-bold">How to Reserve a Seat in a Coworking Space</h1>
                    <a class="btn btn-dark mt-4" href="{{ route('client_side.lists') }}">Reserve a Seat</a>
                </div>

                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Find a Coworking Space</h2>
                            <img class="placeholder-box mb-4" src="{{ asset('assets/img/sample_room.jpg') }}"/>
                            <img class="placeholder-box mb-4" src="{{ asset('assets/img/sample_room.jpg') }}"/>
                        </div>

                        <div class="col-md-6">
                            <h2>Reserve a Seat</h2>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search for a coworking space"
                                    aria-label="Search">
                                <button class="btn btn-outline-secondary" type="button">Search</button>
                            </div>
                            <div id="map" class="map-box">
                            </div>
                        </div>
                    </div>
                </div>

            </main>

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
            .openPopup();
    </script>
@endsection

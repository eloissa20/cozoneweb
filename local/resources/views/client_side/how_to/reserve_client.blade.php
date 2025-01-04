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
            width: 100%;
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
                    <li><a href="{{ route('client_side.how.reserve') }}" class="active_sidebar">How to Reserve a Seat...</a>
                    </li>
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
                            <h5>Latest Coworks</h5>
                            @foreach ($coworkingSpaces->take(2) as $space)
                                <a href="{{ route('client_side.details', ['id' => $space->id]) }}">
                                    <img class="placeholder-box mb-4 w-100 object-fit-cover"
                                        src="{{ asset($space->header_image) }}" alt="{{ $space->name }}" />
                                </a>
                            @endforeach
                        </div>

                        <div class="col-md-6">
                            <h2>Reserve a Seat</h2>
                            <div class="input-group mb-3">
                                <input id="searchBox" type="text" class="form-control"
                                    placeholder="Search for a coworking space" aria-label="Search">
                                <button id="searchButton" class="btn btn-outline-secondary" type="button">Search</button>
                            </div>
                            <div id="map" class="map-box"></div>
                        </div>
                    </div>
                </div>

            </main>

        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // Assuming coworkingSpaces is available from PHP
        const coworkingSpaces = @json($coworkingSpaces);

        const latitude = coworkingSpaces[0].latitude;
        const longitude = coworkingSpaces[0].longitude;

        const map = L.map('map').setView([latitude, longitude], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        L.marker([latitude, longitude]).addTo(map)
            .openPopup();

        coworkingSpaces.forEach(space => {
            const detailsRouteBase = "{{ url('client_side/details') }}";
            L.marker([space.latitude, space.longitude]).addTo(map)
                .bindPopup(
                    `
                    <a href="${detailsRouteBase}/${space.id}" style="color:#000;">
                        <b>${space.coworking_space_name}</b><br>${space.unit}, ${space.city}, ${space.location}, ${space.country}<br>
                        <img style="height: 100px; width: 100px; object-fit: cover;"
                             src="{{ asset('${space.header_image}') }}"
                             alt="${space.coworking_space_name}" />
                    </a>`
                );
        });
    </script>

    <script>
        document.getElementById('searchButton').addEventListener('click', () => {
            const query = document.getElementById('searchBox').value.trim().toLowerCase();

            // Clear the map
            map.eachLayer(layer => {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }
            });

            // Filter coworking spaces by the query
            const filteredSpaces = coworkingSpaces.filter(space =>
                space.coworking_space_name.toLowerCase().includes(query) ||
                space.city.toLowerCase().includes(query) ||
                space.location.toLowerCase().includes(query)
            );

            if (filteredSpaces.length > 0) {
                const bounds = [];
                const detailsRouteBase = "{{ url('client_side/details') }}";
                filteredSpaces.forEach(space => {
                    bounds.push([space.latitude, space.longitude]);

                    L.marker([space.latitude, space.longitude]).addTo(map)
                        .bindPopup(
                            `<a href="${detailsRouteBase}/${space.id}" style="color:#000;">
                        <b>${space.coworking_space_name}</b><br>${space.unit}, ${space.city}, ${space.location}, ${space.country}<br>
                        <img style="height: 100px; width: 100px; object-fit: cover;"
                             src="{{ asset('${space.header_image}') }}"
                             alt="${space.coworking_space_name}" />
                    </a>`
                        ).openPopup();
                });

                // Adjust the map to fit all markers
                map.fitBounds(bounds);
            } else {
                alert('No coworking spaces found.');
            }
        });
    </script>
@endsection

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
            <h1>Coworking Space Name</h1>
            <p>★★★★★</p>
        </div>
        <div class="col text-end">
            <h2>Location</h2>
        </div>
    </div>

    <div class="map-placeholder mb-4">MAP</div>

    <div class="row">
        <div class="col-md-8">
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
                <div class="card-header">Space Overview</div>
                <div class="card-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ut neque dolor. Phasellus
                        imperdiet.</p>
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
                    <form>
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
                    <div class="image-placeholder"></div>
                </div>
                <div class="col-6">
                    <div class="image-placeholder"></div>
                </div>
                <div class="col-6">
                    <div class="image-placeholder"></div>
                </div>
                <div class="col-6">
                    <div class="image-placeholder">+4</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
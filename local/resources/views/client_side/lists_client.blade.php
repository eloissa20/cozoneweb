@extends('layouts.client_header')
@section('title', 'Cowork List')
@section('content')
<style>
    .filter-section {
        background-color: #f9f9f9;
        padding: 15px;
        border-radius: 5px;
        border: 1px solid #eaeaea;
    }

    .filter-title {
        font-weight: bold;
        font-size: 18px;
    }

    .coworking-card {
        border: 1px solid #eaeaea;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 15px;
    }

    .coworking-card img {
        width: 100%;
        height: auto;
        background-color: #f0f0f0;
    }

    .favorite-heart {
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 18px;
    }

    .coworking-card .rating {
        color: #ffc107;
    }

    .price-tag {
        font-weight: bold;
        color: #333;
    }

    .search-bar input {
        border-radius: 50px;
        padding: 10px 20px;
        border: 1px solid #ced4da;
    }
</style>
<div class="container-fluid page">
    <div class="row">
        <div class="col-md-3">
            <div class="filter-section">
                <p class="filter-title">Price (₱)</p>
                <div class="mb-3">
                    <label for="minPrice" class="form-label">Min</label>
                    <input type="text" class="form-control" id="minPrice" placeholder="₱">
                </div>
                <div class="mb-3">
                    <label for="maxPrice" class="form-label">Max</label>
                    <input type="text" class="form-control" id="maxPrice" placeholder="₱">
                </div>
                <div class="mb-3">
                    <label for="duration" class="form-label">Duration</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="duration1">
                        <label class="form-check-label" for="duration1">
                            1 hour - 2 hours
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="duration2">
                        <label class="form-check-label" for="duration2">
                            3 hours - 5 hours
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="duration3">
                        <label class="form-check-label" for="duration3">
                            6 hours - 8 hours
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="duration4">
                        <label class="form-check-label" for="duration4">
                            9 hours - 12 hours
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Coworking Spaces List -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="col-md-4">
                    <div class="search-bar">
                        <input type="text" class="form-control" placeholder="Search location" value="Manila">
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-select">
                        <option value="">Select Type</option>
                        <option>Coworking</option>
                    </select>
                </div>
                <div>
                    <button class="btn btn-outline-secondary">Recommended</button>
                    <button class="btn btn-outline-secondary">Map</button>
                </div>
            </div>

            <div class="row">
                <!-- Coworking Space Card -->
                <div class="col-md-4">
                    <div class="coworking-card position-relative">
                        <img src="https://th.bing.com/th/id/OIP.b8JbnTkGXa76-JNi757qCwHaFj?rs=1&pid=ImgDetMain" alt="Coworking Space Image" class="img-fluid">
                        <i class="favorite-heart bi bi-heart"></i>
                        <h6 class="mt-2">Coworking Space Name</h6>
                        <p class="text-muted">Location</p>
                        <p><span class="rating">★★★★★</span> <small>(21)</small></p>
                        <p class="price-tag">Starts at ₱70/hr per person</p>
                        <button class="btn btn-outline-primary btn-sm">View Details</button>
                    </div>
                </div>

                <!-- Repeat for multiple coworking spaces -->
                <div class="col-md-4">
                    <div class="coworking-card position-relative">
                        <img src="https://th.bing.com/th/id/OIP.b8JbnTkGXa76-JNi757qCwHaFj?rs=1&pid=ImgDetMain" alt="Coworking Space Image" class="img-fluid">
                        <i class="favorite-heart bi bi-heart"></i>
                        <h6 class="mt-2">Coworking Space Name</h6>
                        <p class="text-muted">Location</p>
                        <p><span class="rating">★★★★★</span> <small>(12)</small></p>
                        <p class="price-tag">Starts at ₱60/hr per person</p>
                        <button class="btn btn-outline-primary btn-sm">View Details</button>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="coworking-card position-relative">
                        <img src="https://th.bing.com/th/id/OIP.b8JbnTkGXa76-JNi757qCwHaFj?rs=1&pid=ImgDetMain " alt="Coworking Space Image" class="img-fluid">
                        <i class="favorite-heart bi bi-heart"></i>
                        <h6 class="mt-2">Coworking Space Name</h6>
                        <p class="text-muted">Location</p>
                        <p><span class="rating">★★★★★</span> <small>(9)</small></p>
                        <p class="price-tag">Starts at ₱80/hr per person</p>
                        <button class="btn btn-outline-primary btn-sm">View Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
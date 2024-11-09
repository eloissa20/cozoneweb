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
                <button class="btn btn-primary mt-4">Reserve a Seat</button>
            </div>

            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Find a Coworking Space</h2>
                        <div class="placeholder-box mb-4"></div>
                        <div class="placeholder-box"></div>
                    </div>

                    <div class="col-md-6">
                        <h2>Reserve a Seat</h2>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search for a coworking space"
                                aria-label="Search">
                            <button class="btn btn-outline-secondary" type="button">Search</button>
                        </div>
                        <div class="map-box">
                            <p class="text-center">MAP</p>
                        </div>
                    </div>
                </div>
            </div>

        </main>

    </div>
</div>
@endsection
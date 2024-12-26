@extends('layouts.client_header')
@section('title', 'Find')
@section('content')
    <style>
        .find-space-section {
            text-align: center;
            padding: 50px;
            background-color: #f8f9fa;
        }

        .find-space-section h1 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .find-space-section button {
            margin-top: 20px;
        }

        .explore-section {
            text-align: center;
            padding: 50px 0;
        }

        .explore-section h2 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .explore-section .sub-heading {
            font-weight: bold;
            margin-bottom: 40px;
        }

        .explore-card {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            background-color: #f8f9fa;
            text-align: center;
            transition: 0.3s ease;
        }

        .explore-card:hover {
            background-color: #e9ecef;
            transform: scale(1.05);
        }

        .explore-card h5 {
            font-weight: bold;
        }

        .explore-card p {
            color: #666;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-2 border-end">
                <ul class="list-unstyled p-3 text-center">
                    <li><a href="{{ route('client_side.how.reserve') }}">How to Reserve a Seat...</a></li>
                    <li><a href="{{ route('client_side.how.find') }}" class="active_sidebar">Find Office Space by Type</a></li>
                    <li><a href="{{ route('client_side.how.faqs') }}">FAQs</a></li>
                </ul>
            </nav>

            <main class="col-md-7 page main_with_sidebar">
                <div class="find-space-section">
                    <h1>Find Office Space by Type</h1>
                    <button class="btn btn-outline-dark">Find Space</button>
                </div>

                <!-- Explore the Different Types of Space Section -->
                <div class="container explore-section">
                    <h2>EXPLORE THE DIFFERENT TYPES OF SPACE</h2>
                    <p class="sub-heading">What Are the Different Types of Space?</p>

                    <!-- Explore Cards -->
                    <div class="row">
                        <!-- Card 1 -->
                        <div class="col-md-4 mb-4">
                            <div class="explore-card">
                                <h5>Coworking Space</h5>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="col-md-4 mb-4">
                            <div class="explore-card">
                                <h5>Meeting Rooms</h5>
                            </div>
                        </div>
                        <!-- Card 3 -->
                        <div class="col-md-4 mb-4">
                            <div class="explore-card">
                                <h5>Virtual Offices</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>
@endsection

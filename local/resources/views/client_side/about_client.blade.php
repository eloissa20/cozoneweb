@extends('layouts.client_header')
@section('title', 'About')
@section('content')
    <style>
        .logo {
            font-size: 3rem;
            font-weight: bold;
        }

        .management-team img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #eaeaea;
        }

        .info-section {
            padding: 2rem 0;
        }

        .contact-box {
            background-color: #eaeaea;
            padding: 1rem;
            border-radius: 8px;
        }

        .send-btn {
            background-color: black;
            color: white;
        }

        .social-icons a {
            margin: 0 10px;
            color: black;
        }
    </style>
    <main class="page container">
        <section class="text-center mt-5 d-flex justify-content-center align-items-center gap-5">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" style="height: 300px; width: 300px;">
            <p class="ms-5 p-5 h-20 bg-light">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore
                magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
        </section>
        <section class="management-team text-center mt-5">
            <h2>Management Team</h2>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-2">
                        <img src="{{ asset('assets/img/profile.png') }}" alt="Team Member 1">
                        <p>John Doe</p>
                    </div>
                    <div class="col-2">
                        <img src="{{ asset('assets/img/profile.png') }}" alt="Team Member 2">
                        <p>John Doe</p>
                    </div>
                    <div class="col-2">
                        <img src="{{ asset('assets/img/profile.png') }}" alt="Team Member 3">
                        <p>John Doe</p>
                    </div>
                    <div class="col-2">
                        <img src="{{ asset('assets/img/profile.png') }}" alt="Team Member 4">
                        <p>John Doe</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="info-section text-center mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-box">
                            <h3>Our Mission</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-box">
                            <h3>Our Values</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Us Section -->
        <section class="contact-section mt-5">
            <div class="container text-center">
                <h2>Contact Us</h2>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <form method="POST" action="{{ route('client_side.about.contact') }}">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" name="fullname" placeholder="Full Name">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" placeholder="E-mail">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="4" name="message" placeholder="Type your message here..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-dark send-btn w-100">SEND</button>
                        </form>
                    </div>
                    <div class="col-md-4 text-start mt-4">
                        <h5>Contact</h5>
                        <p>cozoneest24@gmail.com
                        </p>
                        <h5>Based In</h5>
                        <p>Manila, Metro Manila, PH</p>
                        <div class="social-icons">
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
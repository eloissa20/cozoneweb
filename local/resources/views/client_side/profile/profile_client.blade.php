@extends('layouts.client_header')
@section('title', 'Profile')
@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <nav id="sidebar" class="col-md-2 border-end">
            <div class="p-3">
                <ul class="list-unstyled text-center">
                    <li><a href="{{ route('client_side.profile') }}" class="active_sidebar">Personal Information</a></li>
                    <li><a href="{{ route('client_side.profile.transactions') }}">Transaction Details</a></li>
                    <li><a href="{{ route('client_side.profile.favorites') }}">Favorites / Wishlist</a></li>
                </ul>
                <button class="btn btn-dark w-100 align-bottom"> <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                        {{ __('LOG OUT') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </button>
            </div>
        </nav>

        <main class="col-md-7 page main_with_sidebar">
            <div class="container">
                <h2>My Profile</h2>
                <div class="profile-container">
                    <form class="w-75">
                        <div class="form-group mb-3">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" placeholder="First Name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" placeholder="Last Name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="form-group mb-3">
                            <label for="contactNo">Contact No.</label>
                            <input type="text" class="form-control" id="contactNo" placeholder="Contact No.">
                        </div>
                        <div class="form-group mb-3">
                            <label for="birthday">Birthday</label>
                            <input type="date" class="form-control" id="birthday">
                        </div>
                        <div class="form-group mb-3">
                            <label for="gender">Gender</label>
                            <select class="form-control" id="gender">
                                <option>Select Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="Address">
                        </div>
                    </form>
                </div>
            </div>
        </main>

    </div>
</div>
@endsection
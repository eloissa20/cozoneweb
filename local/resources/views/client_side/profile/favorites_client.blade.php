@extends('layouts.client_header')
@section('title', 'Profile')
@section('content')
<style>
    .coworking-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 10px;
        position: relative;
    }

    .coworking-card img {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .coworking-card h5 {
        margin-top: 10px;
        font-weight: bold;
    }

    .coworking-card p {
        margin-bottom: 0;
        color: #666;
    }

    .heart-icon {
        position: absolute;
        bottom: 10px;
        right: 10px;
        color: #888;
        font-size: 1.5rem;
    }

    .heart-icon:hover {
        color: #ff4d4d;
    }

    .filter-container {
        text-align: right;
        margin-bottom: 20px;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }
</style>
<div class="container-fluid mt-4">
    <div class="row">
        <nav id="sidebar" class="col-md-2 border-end">
            <div class="p-3">
                <ul class="list-unstyled text-center">
                    <li><a href="{{ route('client_side.profile') }}">Personal Information</a></li>
                    <li><a href="{{ route('client_side.profile.transactions') }}">Transaction Details</a></li>
                    <li><a href="{{ route('client_side.profile.favorites') }}" class="active_sidebar">Favorites /
                            Wishlist</a></li>
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

        <main class="col-md page main_with_sidebar">
            <div class="container">
                <!-- Title and Filter -->
                <div class="d-flex justify-content-between align-items-center">
                    <h2>My Favorites Coworking List</h2>
                    <div class="filter-container">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Filter Date
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Newest</a></li>
                            <li><a class="dropdown-item" href="#">Oldest</a></li>
                        </ul>
                    </div>
                </div>

                <div class="grid-container">
                    <div class="coworking-card">
                        <img src="https://th.bing.com/th/id/OIP.b8JbnTkGXa76-JNi757qCwHaFj?rs=1&pid=ImgDetMain"
                            alt="Coworking Space">
                        <h5>Coworking Space Name</h5>
                        <p>Location</p>
                        <i class="bi bi-heart heart-icon"></i>
                    </div>
                    <div class="coworking-card">
                        <img src="https://th.bing.com/th/id/OIP.b8JbnTkGXa76-JNi757qCwHaFj?rs=1&pid=ImgDetMain"
                            alt="Coworking Space">
                        <h5>Coworking Space Name</h5>
                        <p>Location</p>
                        <i class="bi bi-heart heart-icon"></i>
                    </div>
                    <div class="coworking-card">
                        <img src="https://th.bing.com/th/id/OIP.b8JbnTkGXa76-JNi757qCwHaFj?rs=1&pid=ImgDetMain"
                            alt="Coworking Space">
                        <h5>Coworking Space Name</h5>
                        <p>Location</p>
                        <i class="bi bi-heart heart-icon"></i>
                    </div>
                    <div class="coworking-card">
                        <img src="https://th.bing.com/th/id/OIP.b8JbnTkGXa76-JNi757qCwHaFj?rs=1&pid=ImgDetMain"
                            alt="Coworking Space">
                        <h5>Coworking Space Name</h5>
                        <p>Location</p>
                        <i class="bi bi-heart heart-icon"></i>
                    </div>
                    <div class="coworking-card">
                        <img src="https://th.bing.com/th/id/OIP.b8JbnTkGXa76-JNi757qCwHaFj?rs=1&pid=ImgDetMain"
                            alt="Coworking Space">
                        <h5>Coworking Space Name</h5>
                        <p>Location</p>
                        <i class="bi bi-heart heart-icon"></i>
                    </div>
                </div>
            </div>
        </main>

    </div>
</div>
@endsection
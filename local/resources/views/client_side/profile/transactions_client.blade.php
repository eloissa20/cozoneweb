@extends('layouts.client_header')
@section('title', 'Profile')
@section('content')
<style>
    .filter-container {
        text-align: right;
        margin-bottom: 20px;
    }
</style>
<div class="container-fluid mt-4">
    <div class="row">
        <nav id="sidebar" class="col-md-2 border-end">
            <div class="p-3">
                <ul class="list-unstyled text-center">
                    <li><a href="{{ route('client_side.profile') }}">Personal Information</a></li>
                    <li><a href="{{ route('client_side.profile.transactions') }}" class="active_sidebar">Transaction
                            Details</a></li>
                    <li><a href="{{ route('client_side.profile.favorites') }}">Favorites /
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
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Transaction History</h2>
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
            </div>
        </main>

    </div>
</div>
@endsection
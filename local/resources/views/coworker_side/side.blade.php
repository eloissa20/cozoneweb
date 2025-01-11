<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COZONE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="{{ asset('assets/coworker.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/listSpace.css') }}" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">

    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<style>

</style>
<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div>
                <div class="sidebar-logo">
                    <a href="">COZONE</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Coworker Dashboard
                    </li>
                    <li class="sidebar-item {{ Route::is('coworker_side.coworker') ? 'active' : '' }}">
                        <a href="{{ route('coworker_side.coworker') }}" class="sidebar-link">
                            <i class="bi bi-graph-up"></i>
                            Analytics
                        </a>
                    </li>
                    <li class="sidebar-item {{ Route::is('reservations') ? 'active' : '' }}">
                        <a href="{{ route('reservations') }}" class="sidebar-link">
                            <i class="bi bi-book"></i>
                            Reservation
                        </a>
                    </li>
                    <li class="sidebar-item {{ Route::is('myCoworkingSpace') ? 'active' : '' }}">
                        <a href="{{ route('myCoworkingSpace') }}" class="sidebar-link">
                            <i class="bi bi-building-fill"></i>
                            My Coworking Space
                        </a>
                    </li>
                    <li class="sidebar-item {{ Route::is('reviews') ? 'active' : '' }}">
                        <a href="{{ route('reviews') }}" class="sidebar-link">
                            <i class="bi bi-chat-left-text-fill"></i>
                            Reviews
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom mb-3">
                <button class="btn" id="sidebar-toggle" type="button">
                    <i class="bi bi-arrow-bar-left" id="collapse-icon"></i>
                </button>
                <div class="navbar-collapse justify-content-end">
                    <ul class="navbar-nav">
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#">How to</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('aboutUs') ? 'active' : '' }}" href="{{ route('aboutUs') }}">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('coworker_side.listSpace') ? 'active' : '' }}" href="{{ route('coworker_side.listSpace') }}">List Space</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="pe-md-0">
                                <img src="{{ asset('assets/img/profile.png') }}" class="avatar img-fluid rounded" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                {{-- <a href="#" class="dropdown-item">Profile</a>
                                <a href="#" class="dropdown-item">Setting</a> --}}
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
            
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            
            {{-- main content --}}
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/coworker/coworker.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</body>
</html>
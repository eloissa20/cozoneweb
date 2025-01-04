<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="{{ asset('assets/coworker.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/listSpace.css') }}" rel="stylesheet">

    <!-- Include SweetAlert2 CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


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
                        Admin Pannel
                    </li>
                    <li class="sidebar-item {{ Route::is('admin_side.admin') ? 'active' : '' }}">
                        <a href="{{ route('admin_side.admin') }}" class="sidebar-link">
                            <i class="bi bi-graph-up"></i>
                            Analytics
                        </a>
                    </li>
                    <li class="sidebar-item {{ Route::is('users') ? 'active' : '' }}">
                        <a href="{{ route('users') }}" class="sidebar-link">
                            <i class="bi bi-people"></i>
                            Users
                        </a>
                    </li>
                    <li class="sidebar-item {{ Route::is('deactivated') ? 'active' : '' }}">
                        <a href="{{ route('deactivated') }}" class="sidebar-link">
                            <i class="bi bi-people"></i>
                            Deactivated Users
                        </a>
                    </li>
                    <li class="sidebar-item {{ Route::is('clients') ? 'active' : '' }}">
                        <a href="{{ route('clients') }}" class="sidebar-link">
                            <i class="bi bi-briefcase"></i>
                            Clients
                        </a>
                    </li>
                    <li class="sidebar-item {{ Route::is('admin.spaces') ? 'active' : '' }}">
                        <a href="{{ route('admin.spaces') }}" class="sidebar-link">
                            <i class="bi bi-building"></i>
                            Spaces
                        </a>
                    </li>
                    <li class="sidebar-item {{ Route::is('admin.transactions') ? 'active' : '' }}">
                        <a href="{{ route('admin.transactions') }}" class="sidebar-link">
                            <i class="bi bi-receipt"></i>
                            Transactions
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
                        <li class="nav-item">
                            <a class="nav-link" href="#">How to</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About Us</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="pe-md-0">
                                <img src="{{ asset('assets/img/profile.png') }}" class="avatar img-fluid rounded" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">Profile</a>
                                <a href="#" class="dropdown-item">Setting</a>
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
            
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="#" class="text-muted">
                                    <strong>COZONE</strong>
                                </a>
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Contact</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">About Us</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Terms</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Cozone</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/coworker/coworker.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cozone') }} | Client @yield('title')</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm w-100" style="z-index: 2; position: fixed; top: 0; left: 0;">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/client_side/home') }}">
                    <img src="{{ asset('assets/logo.png') }}"
                        alt="Logo" style="height: 40px;">
                </a>

                <div class="d-flex">
                    <a class="btn btn-outline-secondary me-2" href="{{ route('client_side.how.reserve') }}">How
                        to</a>
                    <a class="btn btn-outline-secondary me-2" href="{{ route('client_side.about') }}">About
                        Us</a>
                    <a class="btn btn-outline-secondary me-2" href="#">List Space</a>
                </div>
                <div class="d-flex align-items-center">
                    <a href="#" class="me-3">
                        <i class="bi bi-bell" style="font-size: 1.5rem;"></i>
                    </a>
                    <a href="{{ route('client_side.profile') }}" class="me-3">
                        <i class="bi bi-person" style="font-size: 1.5rem;"></i>
                    </a>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>


    <style>
        a {
            text-decoration: none;
            color: #888;
        }

        body {
            overflow-x: hidden;
        }

        .page {
            margin-top: 5rem;
        }

        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1;
            height: 100vh;
            width: 270px;
            padding-top: 150px;
        }

        .main_with_sidebar {
            margin-left: 300px;
        }

        #sidebar div {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        #sidebar ul li {
            padding-left: 0;
            margin-bottom: 10px;
        }

        #sidebar ul li a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #000;
        }

        #sidebar ul li a:hover {
            background-color: #f0f0f0;
            text-decoration: none;
        }

        .active_sidebar {
            border-bottom: 2px solid #000;
        }
    </style>
</body>

</html>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">

    <title>{{ config('app.name', 'Cozone') }} @yield('title')</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.9.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm w-100"
            style="z-index: 2; position: fixed; top: 0; left: 0; width: 100%; min-width: 500px;">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/client_side/home') }}">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" style="height: 40px;">
                </a>

                <div class="d-flex">
                    <a class="btn btn-outline-secondary me-2" href="{{ route('client_side.about') }}">About Us</a>
                 
                </div>
                <div class="d-flex align-items-center">
                    <button type="button" id="notification" class="me-3 btn btn-light bg-white border border-0"
                        data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom"
                        data-bs-html="true">
                        <i class="bi bi-bell" style="font-size: 1.5rem; position: relative;">
                        </i>
                        <span id="notification-count" class="badge text-bg-secondary"></span>
                    </button>
                    <a href="{{ route('client_side.profile') }}" class="me-3 btn btn-light bg-white border border-0">
                        <i class="bi bi-person" style="font-size: 1.5rem;"></i>
                    </a>
                </div>
            </div>
        </nav>

        <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
            <!-- Success Toast -->
            @if (session('success'))
                <div class="toast align-items-center bg-black border-0" role="alert" aria-live="assertive"
                    aria-atomic="true" id="successToast">
                    <div class="toast-header">
                        <strong class="me-auto">Success</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body text-bg-light">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- Error Toast -->
            @if (session('error'))
                <div class="toast align-items-center bg-black border-0" role="alert" aria-live="assertive"
                    aria-atomic="true" id="errorToast">
                    <div class="toast-header">
                        <strong class="me-auto">Error</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body text-bg-danger">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <style>
        a {
            text-decoration: none;
            color: #000;
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                var successToast = new bootstrap.Toast(document.getElementById('successToast'));
                successToast.show();
            @endif
            @if (session('error'))
                var errorToast = new bootstrap.Toast(document.getElementById('errorToast'));
                errorToast.show();
            @endif

            async function fetchNotifications() {
                try {
                    const response = await $.ajax({
                        url: '{{ route('client_side.notifications.all')}}',
                        method: 'GET',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                    });

                    if (response.success) {
                        return response.data;
                    }
                } catch (error) {
                    console.error('Error fetching notifications:', error);
                }
                return [];
            }

            async function initializeNotifications() {
                const notifications = await fetchNotifications();

                const detailsRouteBase = "{{ url('client_side/reservation') }}";

                const notificationContent = notifications.length > 0 ?
                `
                <div style="max-height: 200px; overflow-y: auto; width: 300px;">
                    ${notifications.map(notification => {
                        const formattedDate = moment(notification.created_at).fromNow(); // Using Moment.js to format date
                        return `
                            <a href="${detailsRouteBase}/${notification.transaction_id}"
                            class="text-decoration-none text-dark d-block py-2 border-bottom">
                                <div>
                                    <p class="mb-0 fw-bold">${notification.content}</p>
                                    <small class="text-muted">${formattedDate}</small>
                                </div>
                            </a>
                        `;
                    }).join('')}
                </div>
                ` :
                `<div style="width: 300px; text-align: center; padding: 10px;">No new notifications</div>`;

                const notificationButton = document.getElementById('notification');
                const popover = new bootstrap.Popover(notificationButton, {
                    content: notificationContent,
                    html: true,
                    trigger: 'focus',
                });

                const notificationCount = document.getElementById('notification-count');
                notificationCount.textContent = notifications.length;
            }

            initializeNotifications();
        });
    </script>
</body>

</html>
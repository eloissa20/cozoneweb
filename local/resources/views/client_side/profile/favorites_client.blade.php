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
                    <button class="btn btn-dark w-100 align-bottom"> <a class="dropdown-item" id="logout">
                            {{ __('LOG OUT') }}
                        </a>
                    </button>
                </div>
            </nav>

            <main class="col-md page main_with_sidebar">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>My Favorites Coworking List</h2>
                        <div class="filter-container">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Filter Date
                            </button>
                            <ul class="dropdown-menu" id="filter-transactions">
                                <li><a class="dropdown-item" href="#">Newest</a></li>
                                <li><a class="dropdown-item" href="#">Oldest</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="grid-container">
                        @if (count($favorites) == 0)
                            <h6>No Favorites</h6>
                        @else
                            @foreach ($favorites as $item)
                                <div class="coworking-card">
                                    <img src="{{ asset($item->cowork->header_image) }}" alt="Coworking Space">
                                    <h5>{{ $item->cowork->coworking_space_name }}</h5>
                                    <p class="mb-3">{{ $item->cowork->coworking_space_name }}</p>
                                    <a href="{{ route('client_side.details', ['id' => $item->space_id]) }}" type="submit"
                                        class="btn btn-outline-dark btn-sm">View Details</a>
                                    <a class="btn btn-outline-danger btn-sm btn remove_item"
                                        data-id="{{ $item->id }}">Remove</a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </main>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            const favoritesContainer = document.querySelector('.grid-container');
            const filterMenu = document.getElementById('filter-transactions');

            let favorites = @json($favorites);

            function renderFavorites(favorites) {
                favoritesContainer.innerHTML = '';

                if (favorites.length === 0) {
                    favoritesContainer.innerHTML = '<h6>No Favorites</h6>';
                    return;
                }

                const detailsRouteBase = "{{ url('client_side/details') }}";

                favorites.forEach(item => {
                    favoritesContainer.innerHTML += `
                <div class="coworking-card">
                    <img src="{{ asset('${item.cowork.header_image}') }}" alt="Coworking Space" onerror="this.onerror=null;this.src='{{ asset('assets/img/no-image-available.jpeg') }}';">
                    <h5>${item.cowork.coworking_space_name}</h5>
                    <p class="mb-3">${item.cowork.coworking_space_name}</p>
                    <a href="${detailsRouteBase}/${item.space_id}" class="btn btn-outline-dark btn-sm">View Details</a>
                    <a class="btn btn-outline-danger btn-sm btn remove_item" data-id="${item.id}">Remove</a>
                </div>
            `;
                });
            }

            filterMenu.addEventListener('click', function(e) {
                e.preventDefault();
                const filterType = e.target.textContent.trim();

                if (filterType === 'Newest') {
                    favorites.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                } else if (filterType === 'Oldest') {
                    favorites.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
                }

                renderFavorites(favorites);
            });

            $(document).on('click', '.remove_item', function() {
                const itemId = $(this).data('id');
                $.ajax({
                    url: '{{ route('client_side.profile.favorite.remove') }}',
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: itemId
                    },
                    success: function(response) {
                        if (response.success) {
                            favorites = favorites.filter(item => item.id !== itemId);
                            renderFavorites(favorites);
                            alertify.success('Cozone removed from favorites!');
                        }
                    },
                    error: function() {
                        alertify.error('Failed to remove favorite.');
                    }
                });
            });

            renderFavorites(favorites);
        });

        $(document).ready(function() {
            $('#logout').on('click', function() {
                showConfirmDelete();
            });

            function showConfirmDelete() {
                alertify.confirm("Confirm Logout", "Are you sure you want to logout?",
                    function() {
                        $.ajax({
                            url: "{{ route('logout') }}",
                            method: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            success: function(data) {
                                location.reload();
                            },
                            error: function(xhr) {
                                alertify.error('Error: ' + xhr.responseText || xhr.statusText);
                                console.error('Error:', xhr);
                            }
                        });
                    },
                    function() {});
            }
        })
    </script>
@endsection

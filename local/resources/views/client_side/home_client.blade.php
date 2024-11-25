@extends('layouts.client_header')
@section('title', 'Home')
@section('content')
    <style>
        .search-section {
            padding: 50px 0;
        }

        .search-box {
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 800px;
            margin: 0 auto;
        }

        .coworking-spaces {
            padding: 50px 0;
        }

        .coworking-spaces img {
            height: 250px;
            width: 100%;
        }

        .coworking-spaces h2 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }

        .coworking-space-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease;
            margin-bottom: 15px;
        }

        .coworking-space-card:hover {
            transform: scale(1.05);
        }

        .coworking-space-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-color: #ccc;
        }

        .coworking-space-info {
            padding: 15px;
        }

        .view-all {
            text-align: right;
            font-size: 0.9rem;
        }

        .favorite-heart {
            position: absolute;
            bottom: 15px;
            right: 15px;
            font-size: 18px;
            color: #888;
            transition: transform 0.3s ease;
        }

        .favorite-heart:hover {
            transform: scale(1.05);
            color: red;
        }
    </style>

    <main class="container page">
        <section class="search-section">
            <div class="container">
                <div class="search-box">
                    <form class="row g-3" method="GET" action="{{ route('client_side.home') }}">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search Location"
                                    value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <select class="form-select" id="filter-spaces">
                                <option selected disabled>Type of Space</option>
                                <option value="Private Room">Private Room</option>
                                <option value="Meeting Room">Meeting Room</option>
                                <option value="Desk Space">Desk Space</option>
                            </select>
                            <button hidden type="button" id="remove-filter" class="btn btn-outline-dark"><i class="bi bi-x"></i></button>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-dark w-100">Find Space</button>
                        </div>
                    </form>

                </div>
            </div>
        </section>

        <section class="coworking-spaces">
            <div class="container">
                <div>
                    <h1 class="text-center fw-bolder">TOP COWORKING SPACES</h1>
                </div>
                <div class="view-all mb-3 pb-3 border-bottom">
                    <a href="{{ route('client_side.lists') }}" class="text-dark link-opacity-100-hover">View all coworking
                        spaces &#x2192;</a>
                </div>

                <div class="row">
                    @foreach ($spaces as $item)
                        <div class="col-md-4">
                            <div class="coworking-space-card position-relative">
                                <img src="{{ asset($item->header_image) }}" alt="Space">
                                <i class="favorite-heart bi bi-heart-fill fs-3 btn
                                    {{ $item->isFavorite ? 'text-danger remove_to_favorite' : 'add_to_favorite' }}"
                                    data-id="{{ $item->id }}"></i>

                                <div class="coworking-space-info">
                                    <h5 class="fw-bold">{{ $item->coworking_space_name }}</h5>
                                    <p>{{ $item->coworking_space_address }}</p>
                                    @if ($item->averageRating !== 0 || $item->averageRating !== null)
                                        <p>
                                            @php
                                                $fullStars = floor($item->averageRating);
                                                $halfStar = $item->averageRating - $fullStars >= 0.5 ? 1 : 0;
                                                $emptyStars = 5 - ($fullStars + $halfStar);
                                            @endphp
                                            @for ($i = 0; $i < $fullStars; $i++)
                                                <span style="color: gold;" class="fs-5">★</span>
                                            @endfor
                                            @if ($halfStar)
                                                <span style="color: gold;" class="fs-5">☆</span>
                                            @endif
                                            @for ($i = 0; $i < $emptyStars; $i++)
                                                <span style="color: lightgray;" class="fs-5">☆</span>
                                            @endfor
                                        </p>
                                    @else
                                        <p class="text-muted fs-5">☆☆☆☆☆</p>
                                    @endif

                                    <a href="{{ route('client_side.details', ['id' => $item->id]) }}" type="submit"
                                        class="btn btn-outline-dark btn-sm">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    <script>
        $(document).ready(function() {
            let spaces = @json($spaces);

            function renderSpaces(spaces) {
                let spaceContainer = $('.coworking-spaces .row');
                spaceContainer.html('');

                spaces.forEach(space => {
                    const fullStars = Math.floor(space.averageRating || 0);
                    const halfStar = (space.averageRating - fullStars >= 0.5) ? 1 : 0;
                    const emptyStars = 5 - (fullStars + halfStar);

                    const stars = `${'<span style="color: gold;" class="fs-5">★</span>'.repeat(fullStars)}
                   ${halfStar ? '<span style="color: gold;" class="fs-5">☆</span>' : ''}
                   ${'<span style="color: lightgray;" class="fs-5">☆</span>'.repeat(emptyStars)}`;

                    const detailsRouteBase = "{{ url('client_side/details') }}";

                    spaceContainer.append(`
                        <div class="col-md-4">
                            <div class="coworking-space-card position-relative">
                                <img src="{{ asset('${space.header_image}') }}" alt="Space">

                                <i class="favorite-heart bi bi-heart-fill fs-3 btn
                                ${space.isFavorite ? 'text-danger remove_to_favorite' : 'add_to_favorite'}"
                                data-id="${space.id}"></i>

                                <div class="coworking-space-info">
                                    <h5 class="fw-bold">${space.coworking_space_name}</h5>
                                    <p>${space.coworking_space_address}</p>
                                    <p>${stars}</p>
                                    <a href="${detailsRouteBase}/${space.id}" type="submit" class="btn btn-outline-dark btn-sm">View Details</a>
                                </div>
                            </div>
                        </div>
                    `);
                });
            }

            $('.form-control').on('keyup', _.debounce(function() {
                const searchTerm = $(this).val().toLowerCase();
                const filteredSpaces = _.filter(spaces.data, function(space) {
                    return space.coworking_space_name.toLowerCase().includes(searchTerm) ||
                        space.coworking_space_address.toLowerCase().includes(searchTerm);
                });

                renderSpaces(filteredSpaces);
            }, 300));

            $('#filter-spaces').on('change', function() {
                const filterType = $(this).val();
                const filteredSpaces = spaces.data.filter(item => item.type_of_space === filterType);
                $('#remove-filter').removeAttr('hidden');
                renderSpaces(filteredSpaces);
            });

            $('#remove-filter').on('click', function() {
                $('#remove-filter').attr('hidden', true);
                renderSpaces(spaces.data);
            });

            $(document).on('click', '.add_to_favorite, .remove_to_favorite', function() {
                const itemId = $(this).data('id');
                const isFavorite = $(this).hasClass(
                    'remove_to_favorite');

                $.ajax({
                    url: isFavorite ? '{{ route('client_side.profile.favorite.remove.space') }}' :
                        '{{ route('client_side.profile.favorite.add') }}',
                    method: isFavorite ? 'DELETE' : 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: itemId
                    },
                    success: function(response) {
                        if (isFavorite) {
                            alertify.success('Cozone remove to favorites!')
                        } else {
                            alertify.success('Cozone added to favorites!')
                        }
                        let spaceIndex = _.findIndex(spaces.data, {
                            id: itemId
                        });
                        if (spaceIndex !== -1) {
                            spaces.data[spaceIndex].isFavorite = !
                                isFavorite;
                        }

                        const searchTerm = $('.form-control').val().toLowerCase();
                        const filteredSpaces = _.filter(spaces.data, function(space) {
                            return space.coworking_space_name.toLowerCase().includes(
                                    searchTerm) ||
                                space.coworking_space_address.toLowerCase().includes(
                                    searchTerm);
                        });

                        renderSpaces(filteredSpaces);
                    },
                    error: function() {

                    }
                });
            });

        });
    </script>

@endsection
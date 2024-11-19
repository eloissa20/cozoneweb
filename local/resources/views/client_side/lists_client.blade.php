@extends('layouts.client_header')
@section('title', 'Cowork List')
@section('content')
    <style>
        .filter-section {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #eaeaea;
        }

        .filter-title {
            font-weight: bold;
            font-size: 18px;
        }

        .coworking-card {
            border: 1px solid #eaeaea;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .coworking-card:hover {
            transform: scale(1.05);
        }

        .coworking-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-color: #ccc;
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

        .coworking-card .rating {
            color: #ffc107;
        }

        .price-tag {
            font-weight: bold;
            color: #333;
        }

        .search-bar input {
            border-radius: 50px;
            padding: 10px 20px;
            border: 1px solid #ced4da;
        }
    </style>
    <div class="container-fluid page">
        <div class="row">
            <div class="col-md-3">
                <div class="filter-section">
                    <p class="filter-title">Price (₱)</p>
                    <div class="mb-3">
                        <label for="minPrice" class="form-label">Min</label>
                        <input type="text" class="form-control" id="minPrice" placeholder="₱">
                    </div>
                    <div class="mb-3">
                        <label for="maxPrice" class="form-label">Max</label>
                        <input type="text" class="form-control" id="maxPrice" placeholder="₱">
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="duration1">
                            <label class="form-check-label" for="duration1">
                                1 hour - 2 hours
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="duration2">
                            <label class="form-check-label" for="duration2">
                                3 hours - 5 hours
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="duration3">
                            <label class="form-check-label" for="duration3">
                                6 hours - 8 hours
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="duration4">
                            <label class="form-check-label" for="duration4">
                                9 hours - 12 hours
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="col-md-4">
                        <form class="search-bar" method="GET" action="{{ route('client_side.lists') }}">
                            <input type="text" name="search" class="form-control" id="search"
                                placeholder="Search Location" value="{{ request('search') }}">
                        </form>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select">
                            <option value="">Select Type</option>
                            <option>Coworking</option>
                        </select>
                    </div>
                    <div>
                        <button class="btn btn-outline-secondary">Recommended</button>
                        <button class="btn btn-outline-secondary">Map</button>
                    </div>
                </div>

                <div class="row" id="spacesContainer">
                    @foreach ($spaces as $item)
                        <div class="col-md-4 space-card">
                            <div class="coworking-card position-relative">
                                <img src="{{ asset($item->header_image) }}" alt="Coworking Space Image" class="img-fluid">
                                <i class="favorite-heart bi bi-heart-fill fs-3 btn
                                    {{ $item->isFavorite ? 'text-danger remove_to_favorite' : 'add_to_favorite' }}"
                                    data-id="{{ $item->id }}"></i>
                                <h6 class="mt-2">{{ $item->coworking_space_name }}</h6>
                                <p class="text-muted">{{ $item->coworking_space_address }}</p>
                                <p><span class="rating">★★★★★</span> <small>(21)</small></p>
                                <p class="price-tag">Price at ₱{{ $item->membership_price }}</p>
                                <a href="{{ route('client_side.details', ['id' => $item->id]) }}"
                                    class="btn btn-outline-dark btn-sm">View Details</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
    <script>
        $(document).ready(function() {
            let spaces = @json($spaces);

            $('#search').on('keyup', _.debounce(function() {
                const searchTerm = $(this).val().toLowerCase();
                const filteredSpaces = _.filter(spaces.data, function(space) {
                    return space.coworking_space_name.toLowerCase().includes(searchTerm) ||
                        space.coworking_space_address.toLowerCase().includes(searchTerm);
                });

                renderSpaces(filteredSpaces);
            }, 300));

            function renderSpaces(spaces) {
                let spaceContainer = $('#spacesContainer');
                spaceContainer.html('');

                spaces.forEach(space => {
                    spaceContainer.append(`
        <div class="col-md-4 space-card">
            <div class="coworking-card position-relative">
                <img src="{{ asset('${space.header_image}') }}" alt="Coworking Space Image" class="img-fluid">
                <i class="favorite-heart bi bi-heart-fill fs-3 btn
                    ${space.isFavorite ? 'text-danger remove_to_favorite' : 'add_to_favorite'}"
                    data-id="${space.id}"></i>
                <h6 class="mt-2">${space.coworking_space_name}</h6>
                <p class="text-muted">${space.coworking_space_address}</p>
                <p><span class="rating">★★★★★</span> <small>(21)</small></p>
                <p class="price-tag">Price at ₱${space.membership_price}</p>
                <a href="{{ url('client_side/details') }}/${space.id}" class="btn btn-outline-dark btn-sm">View Details</a>
            </div>
        </div>
    `);
                });
            }

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
                        let spaceIndex = _.findIndex(spaces.data, {
                            id: itemId
                        });
                        if (spaceIndex !== -1) {
                            spaces.data[spaceIndex].isFavorite = !
                            isFavorite;
                        }

                        const searchTerm = $('#search').val().toLowerCase();
                        const filteredSpaces = _.filter(spaces.data, function(space) {
                            return space.coworking_space_name.toLowerCase().includes(
                                    searchTerm) ||
                                space.coworking_space_address.toLowerCase().includes(
                                    searchTerm);
                        });

                        renderSpaces(filteredSpaces);
                        alert(response.message);
                    },
                    error: function() {
                        alert('Failed to update favorite.');
                    }
                });
            });
        });
    </script>
@endsection
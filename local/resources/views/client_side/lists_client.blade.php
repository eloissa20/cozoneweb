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

        #spacesContainer {
            height: 80vh;
            /* Set the height to 50% of the viewport height */
            overflow-x: hidden;
            /* Hide horizontal overflow */
            overflow-y: auto;
            /* Allow vertical scrolling if necessary */
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
                        <label for="duration" class="form-label"></label>
                        <div class="form-check">
                            <!-- <input class="form-check-input" type="checkbox" value="1-2" id="duration1"> -->
                            <label class="form-check-label" for="duration1">
                                
                            </label>
                        </div>
                        <div class="form-check">
                            <!-- <input class="form-check-input" type="checkbox" value="3-5" id="duration2"> -->
                            <label class="form-check-label" for="duration2">
                                
                            </label>
                        </div>
                        <div class="form-check">
                            <!-- <input class="form-check-input" type="checkbox" value="6-8" id="duration3"> -->
                            <label class="form-check-label" for="duration3">
                                
                            </label>
                        </div>
                        <div class="form-check">
                            <!-- <input class="form-check-input" type="checkbox" value="9-12" id="duration4"> -->
                            <label class="form-check-label" for="duration4">
                                
                            </label>
                        </div>
                    </div>
                    <button hidden type="button" id="remove-filters" class="btn btn-dark mt-3 w-100">Remove Filter</button>
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
                    <div class="col-md-4 d-flex gap-2">
                        <select class="form-select" id="filter-spaces">
                            <option selected disabled>Select Type</option>
                            <option value="Coworking">Coworking Space</option>
                            <option value="Desk Space">Desk Space</option>
                        </select>
                        <button hidden type="button" id="remove-type-filter" class="btn btn-outline-dark"><i
                                class="bi bi-x"></i></button>
                    </div>
                </div>

                <div class="row" id="spacesContainer">
                    @foreach ($spaces as $item)
                        <div class="col-md-4 space-card">
                            <div class="coworking-card position-relative">
                                <img src="{{ asset($item->header_image) }}" alt="Coworking Space Image" class="img-fluid"
                                    onerror="this.onerror=null;this.src='{{ asset('assets/img/no-image-available.jpeg') }}';">
                                <i class="favorite-heart bi bi-heart-fill fs-3 btn
                                    {{ $item->isFavorite ? 'text-danger remove_to_favorite' : 'add_to_favorite' }}"
                                    data-id="{{ $item->id }}"></i>
                                <h6 class="mt-2">{{ $item->coworking_space_name }}</h6>
                                <p class="text-muted">{{ $item->coworking_space_address }}</p>

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
                                            <span style="color: lightgray;" class="fs-5">
                                                ☆</span>
                                        @endfor
                                    </p>
                                @else
                                    <p class="text-muted fs-5">☆☆☆☆☆</p>
                                @endif
                                <p class="price-tag">Price starts at ₱{{ $item->lowestPrice ?? '0.00' }}</p>
                                <a href="{{ route('client_side.details', ['id' => $item->id]) }}" type="submit"
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

            function renderSpaces(spaces) {
                let spaceContainer = $('#spacesContainer');
                spaceContainer.html('');

                spaces.forEach(space => {
                    const fullStars = Math.floor(space.averageRating || 0);
                    const halfStar = (space.averageRating - fullStars >= 0.5) ? 1 : 0;
                    const emptyStars = 5 - (fullStars + halfStar);

                    const stars = `${'<span style="color: gold;" class="fs-5">★</span>'.repeat(fullStars)}
                   ${halfStar ? '<span style="color: gold;" class="fs-5">☆</span>' : ''}
                   ${'<span style="color: lightgray;" class="fs-5">☆</span>'.repeat(emptyStars)}`;

                    const detailsRouteBase = "{{ url('client_side/details') }}";
                    const assetBaseUrl = "{{ asset('') }}";

                    spaceContainer.append(`
                        <div class="col-md-4 space-card">
                            <div class="coworking-card position-relative">
                                <img src="{{ asset('${space.header_image}') }}" alt="Coworking Space Image" class="img-fluid" onerror="this.onerror=null;this.src='${assetBaseUrl}assets/img/no-image-available.jpeg';">
                                <i class="favorite-heart bi bi-heart-fill fs-3 btn
                                    ${space.isFavorite ? 'text-danger remove_to_favorite' : 'add_to_favorite'}"
                                    data-id="${space.id}"></i>
                                <h6 class="mt-2">${space.coworking_space_name}</h6>
                                <p class="text-muted">${space.coworking_space_address}</p>
                                <p>${stars}</p>
                                <p class="price-tag">Price starts at ₱${space.lowestPrice ?? '0.00'}</p>
                                <a href="${detailsRouteBase}/${space.id}" type="submit" class="btn btn-outline-dark btn-sm">View Details</a>
                            </div>
                        </div>
                    `);
                });

            }

            function renderSearchSpaces(spaces, searchTerm) {
                let spaceContainer = $('#spacesContainer');
                spaceContainer.html('');

                if (searchTerm) {
                    spaceContainer.append(`
                        <div style="margin-bottom: 20px;">
                            <h5 style="font-weight: bold;"><i class="bi bi-geo-alt-fill"></i> Viewing ${spaces.length} Locations in or near ${searchTerm}</h5>
                        </div>
                    `);
                }

                spaces.forEach(space => {
                    const fullStars = Math.floor(space.averageRating || 0);
                    const halfStar = (space.averageRating - fullStars >= 0.5) ? 1 : 0;
                    const emptyStars = 5 - (fullStars + halfStar);

                    const stars = `${'<span style="color: gold;" class="fs-5">★</span>'.repeat(fullStars)}
                   ${halfStar ? '<span style="color: gold;" class="fs-5">☆</span>' : ''}
                   ${'<span style="color: lightgray;" class="fs-5">☆</span>'.repeat(emptyStars)}`;

                    const detailsRouteBase = "{{ url('client_side/details') }}";
                    const assetBaseUrl = "{{ asset('') }}";

                    spaceContainer.append(`
                        <div class="col-md-4 space-card">
                            <div class="coworking-card position-relative">
                                <img src="{{ asset('${space.header_image}') }}" alt="Coworking Space Image" class="img-fluid" onerror="this.onerror=null;this.src='${assetBaseUrl}assets/img/no-image-available.jpeg';">
                                <i class="favorite-heart bi bi-heart-fill fs-3 btn
                                    ${space.isFavorite ? 'text-danger remove_to_favorite' : 'add_to_favorite'}"
                                    data-id="${space.id}"></i>
                                <h6 class="mt-2">${space.coworking_space_name}</h6>
                                <p class="text-muted">${space.coworking_space_address}</p>
                                <p>${stars}</p>
                                <p class="price-tag">Price starts at ₱${space.lowestPrice ?? '0.00'}</p>
                                <a href="${detailsRouteBase}/${space.id}" type="submit" class="btn btn-outline-dark btn-sm">View Details</a>
                            </div>
                        </div>
                    `);
                });

            }

            function renderEmptySpaceMessage(spaces, searchTerm = null) {
                let spaceContainer = $('#spacesContainer');
                spaceContainer.html('');

                if (searchTerm) {
                    spaceContainer.append(`
                        <div class="col-md-4">
                            <p class="text-center">No available cowork space with keyword "${searchTerm}"</p>
                        </div>
                    `);
                } else {

                    spaceContainer.append(`
                        <div class="col-md-4">
                            <p class="text-center">No available cowork space</p>
                        </div>
                    `);
                }

            }


            $('#search').on('keyup', _.debounce(function() {
                const searchTerm = $(this).val().toLowerCase();

                const filteredSpaces = _.filter(spaces, function(space) {
                    return space.coworking_space_address.toLowerCase().includes(searchTerm)
                });

                if (filteredSpaces.length === 0) {
                    renderEmptySpaceMessage(filteredSpaces, searchTerm)
                } else {
                    renderSearchSpaces(filteredSpaces, searchTerm);
                }


            }, 300));

            $('#filter-spaces').on('change', function() {
                const filterType = $(this).val();
                const filteredSpaces = spaces.filter(item => item.type_of_space === filterType);
                $('#remove-type-filter').removeAttr('hidden');

                if (filteredSpaces.length === 0) {
                    renderEmptySpaceMessage(filteredSpaces)
                } else {
                    renderSpaces(filteredSpaces);
                }

            });

            $('#remove-type-filter').on('click', function() {
                $('#remove-type-filter').attr('hidden', true);
                renderSpaces(spaces);
            });

            function applyPriceFilter() {
                let minPrice = parseFloat($('#minPrice').val()) || 0;
                let maxPrice = parseFloat($('#maxPrice').val()) || Infinity;

                let filteredSpaces = spaces.filter(space => {
                    // Extract the array of prices from the space's pricing
                    let spacePrices = space.pricing.map(item => item.price);

                    // Check if any price within the array matches the criteria
                    let priceMatches = spacePrices.some(price => price >= minPrice && price <= maxPrice);

                    return priceMatches;

                });


                if (filteredSpaces.length === 0) {
                    renderEmptySpaceMessage(filteredSpaces)
                } else {
                    renderSpaces(filteredSpaces);
                }

                // Show the remove filter button if filters are applied
                if (minPrice > 0 || maxPrice < Infinity) {
                    $('#remove-filters').removeAttr('hidden');
                } else {
                    $('#remove-filters').attr('hidden', true);
                }
            }

            // Trigger filtering when input fields change
            $('#minPrice, #maxPrice').on('change', applyPriceFilter);

            function applyDurationFilter() {
                let selectedDuration1 = $('#duration1').prop('checked');
                let selectedDuration2 = $('#duration2').prop('checked');
                let selectedDuration3 = $('#duration3').prop('checked');
                let selectedDuration4 = $('#duration4').prop('checked');

                // Time ranges for duration (in minutes)
                const durationRanges = [{
                        min: 60,
                        max: 120
                    }, // 1 hour - 2 hours
                    {
                        min: 180,
                        max: 300
                    }, // 3 hours - 5 hours
                    {
                        min: 360,
                        max: 480
                    }, // 6 hours - 8 hours
                    {
                        min: 540,
                        max: 720
                    }, // 9 hours - 12 hours
                ];

                // Convert operating hours (from time to minutes) for comparison
                function timeToMinutes(time) {
                    let [hours, minutes] = time.split(':').map(Number);
                    return hours * 60 + minutes;
                }

                // Filter spaces based on price and selected duration
                let filteredSpaces = spaces.filter(space => {
                    let spaceMinTime = timeToMinutes(space.operating_hours_from); // Example: "08:00:00"
                    let spaceMaxTime = timeToMinutes(space.operating_hours_to); // Example: "17:00:00"

                    // Check duration range
                    let durationMatches = false;
                    if (selectedDuration1) {
                        durationMatches = spaceMinTime >= durationRanges[0].min && spaceMaxTime <=
                            durationRanges[0].max;
                    }
                    if (selectedDuration2) {
                        durationMatches = spaceMinTime >= durationRanges[1].min && spaceMaxTime <=
                            durationRanges[1].max;
                    }
                    if (selectedDuration3) {
                        durationMatches = spaceMinTime >= durationRanges[2].min && spaceMaxTime <=
                            durationRanges[2].max;
                    }
                    if (selectedDuration4) {
                        durationMatches = spaceMinTime >= durationRanges[3].min && spaceMaxTime <=
                            durationRanges[3].max;
                    }

                    return durationMatches;
                });

                if (filteredSpaces.length === 0) {
                    renderEmptySpaceMessage(filteredSpaces)
                } else {
                    renderSpaces(filteredSpaces);
                }

                // Show the remove filter button if filters are applied
                if (selectedDuration1 || selectedDuration2 ||
                    selectedDuration3 || selectedDuration4) {
                    $('#remove-filters').removeAttr('hidden');
                } else {
                    $('#remove-filters').attr('hidden', true);
                }
            }

            // Trigger filtering when input fields change
            $('#duration1, #duration2, #duration3, #duration4').on('change', applyDurationFilter);

            // Remove filters
            $('#remove-filters').on('click', function() {
                $('#minPrice').val('');
                $('#maxPrice').val('');
                $('#duration1, #duration2, #duration3, #duration4').prop('checked', false);
                const filteredSpaces = spaces;
                renderSpaces(filteredSpaces);
                $('#remove-filters').attr('hidden', true);
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
                        let spaceIndex = _.findIndex(spaces, {
                            id: itemId
                        });
                        if (spaceIndex !== -1) {
                            spaces[spaceIndex].isFavorite = !
                                isFavorite;
                        }

                        const searchTerm = $('#search').val().toLowerCase();
                        const filteredSpaces = _.filter(spaces, function(space) {
                            return space.coworking_space_name.toLowerCase().includes(
                                    searchTerm) ||
                                space.coworking_space_address.toLowerCase().includes(
                                    searchTerm);
                        });

                        renderSpaces(filteredSpaces);
                    },
                    error: function() {}
                });
            });
        });
    </script>
@endsection

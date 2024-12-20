@extends('layouts.client_header')
@section('title', 'Details')
@section('content')
    <style>
        .map-placeholder {
            background: #eaeaea;
            height: 300px;
            z-index: 1;
        }

        .review-placeholder,
        .image-placeholder {
            background: #f0f0f0;
            margin-bottom: 10px;
            width: 100%;
            background-size: cover;

        }

        .image-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            /* Two columns */
            gap: 10px;
        }

        .image-container {
            position: relative;
            width: 100%;
            height: 150px;
            /* Adjust as needed */
            overflow: hidden;
        }

        .image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }
    </style>
    <div class="container page">
        <div class="row">
            <div class="col">
                <h1>{{ $space->coworking_space_name }}</h1>
                <p class="mb-4">
                    @if ($space->averageRating !== 0 || $space->averageRating !== null)
                        @php
                            $fullStars = floor($space->averageRating);
                            $halfStar = $space->averageRating - $fullStars >= 0.5 ? 1 : 0;
                            $emptyStars = 5 - ($fullStars + $halfStar);
                        @endphp
                        @for ($i = 0; $i < $fullStars; $i++)
                            <span style="color: gold;" class="fs-5">★</span>
                        @endfor
                        @if ($halfStar)
                            <span style="color: gold;"class="fs-5">☆</span>
                        @endif
                        @for ($i = 0; $i < $emptyStars; $i++)
                            <span style="color: lightgray;" class="fs-5">☆</span>
                        @endfor
                    @else
                        No ratings yet
                    @endif
                </p>
            </div>
            <div class="col text-end">
                <h2>{{ $space->coworking_space_address }}</h2>
            </div>
        </div>

        <div id="map" class="map-placeholder mb-4"></div>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">Space Overview</div>
                    <div class="card-body">
                        <p>
                            Welcome to {{ $space->coworking_space_name }}, a vibrant coworking space located at
                            {{ $space->unit }}, {{ $space->city }}, {{ $space->location }}, {{ $space->country }},
                            offering a dynamic environment for freelancers, startups, and established businesses.
                            Our facility features various workspace types, including private offices and meeting rooms,
                            with a seating capacity of {{ $space->capacity }}. We are open from
                            {{ $space->available_days_from }}
                            to {{ $space->available_days_to }} <b>(except on {{ $space->exceptions }})</b>, operating between
                            {{ $space->operating_hours_from }} and {{ $space->operating_hours_to }}.

                            Membership options include short-term and long-term plans at competitive prices, with various
                            payment methods accepted.
                            For inquiries, reach us at {{ $space->email }} or {{ $space->contact_no }} /
                            {{ $space->phone }},
                            and
                            connect with us on Instagram ({{ $space->instagram }}) and Facebook ({{ $space->facebook }}).
                        </p>

                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Space Amenities & Facilities</div>
                    <div class="card-body">
                        <div class="row">
                            @if ($space->basics)
                                <div class="col-6">
                                    <h6>Basics</h6>
                                    <ul class="list-unstyled">
                                        @foreach ($space->basics as $basic)
                                            <li>{{ $basic }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if ($space->seats)
                                <div class="col-6">
                                    <h6>Seats</h6>
                                    <ul class="list-unstyled">
                                        @foreach ($space->seats as $seat)
                                            <li>{{ $seat }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if ($space->equipment)
                                <div class="col-6">
                                    <h6>Equipments</h6>
                                    <ul class="list-unstyled">
                                        @foreach ($space->equipment as $equipment)
                                            <li>{{ $equipment }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if ($space->facilities)
                                <div class="col-6">
                                    <h6>Facilities</h6>
                                    <ul class="list-unstyled">
                                        @foreach ($space->facilities as $facility)
                                            <li>{{ $facility }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Space Pricing</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pricing as $price)
                                        <tr>
                                            <td>
                                                {{ $price['hours'] }}
                                            </td>
                                            <td>
                                                &#8369;{{ $price['price'] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="w-100 card-header">
                        <div class="w-100 d-flex justify-content-between items-center">
                            <p class="m-0">Space Reviews</p>
                            <button class="btn btn-primary edit-review" data-id="{{ $space->id }}"
                                data-bs-toggle="modal" data-bs-target="#reviewModal">
                                Post a Review
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (count($allReviews) > 0)
                            @foreach ($allReviews as $item)
                                <div class="review-placeholder mb-3 p-3 border rounded">
                                    <div class="review-header d-flex justify-content-between">
                                        <strong>{{ $item->user->name }}</strong>
                                        <div class="d-flex align-items-center gap-4">
                                            <span class="text-warning fs-5">
                                                @for ($i = 0; $i < $item->rating; $i++)
                                                    ★
                                                @endfor
                                                @for ($i = 0; $i < 5 - $item->rating; $i++)
                                                    ☆
                                                @endfor
                                            </span>
                                            @if (auth()->user()->id === $item->user_id)
                                                <div>
                                                    <button class="btn text-danger remove-review fs-5 p-0"
                                                        data-id="{{ $item->id }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                    <!-- Add Reply Button -->
                                                    <button class="btn text-secondary fs-5 p-0" data-bs-toggle="modal"
                                                        data-bs-target="#addReplyModal-{{ $item->id }}">
                                                        <i class="bi bi-reply"></i>
                                                    </button>
                                                </div>
                                            @else
                                                <div>
                                                    <!-- Add Reply Button -->
                                                    <button class="btn text-secondary fs-5 p-0" data-bs-toggle="modal"
                                                        data-bs-target="#addReplyModal-{{ $item->id }}">
                                                        <i class="bi bi-reply"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="review-body">
                                        <p>{{ $item->review_body }}</p>
                                    </div>
                                    <div class="review-footer text-muted">
                                        <small>Reviewed on: {{ $item->created_at->format('M d, Y') }}</small>
                                    </div>

                                    @if ($allReplies->where('review_id', $item->id)->isNotEmpty())
                                        <button class="btn btn-link p-0" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#replies-{{ $item->id }}" aria-expanded="false"
                                            aria-controls="replies-{{ $item->id }}"
                                            id="toggle-replies-{{ $item->id }}">
                                            Show Replies
                                        </button>

                                        <div class="collapse mt-2" id="replies-{{ $item->id }}">
                                            @php
                                                // Filter the replies for the current review
                                                $repliesForReview = $allReplies->where('review_id', $item->id);
                                            @endphp

                                            @if ($repliesForReview->isEmpty())
                                                <p>No replies yet.</p>
                                            @else
                                                @foreach ($repliesForReview as $reply)
                                                    <div class="mb-2">
                                                        <strong>{{ $reply->user->name }}</strong>
                                                        <p>Reply: {{ $reply->reply }}</p>
                                                        <small>Replied on:
                                                            {{ $reply->created_at->format('M d, Y') }}</small>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endif

                                    <!-- Add Reply Modal -->
                                    <div class="modal fade" id="addReplyModal-{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="addReplyModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addReplyModalLabel">Add Reply to Review by
                                                        "{{ $item->user->name }}"</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('client_side.reply.add', $space->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <input type="text" name="reviewId" id="reviewId" hidden
                                                                value="{{ $item->id }}">
                                                            <label for="reply" class="form-label">Your Reply</label>
                                                            <textarea class="form-control" id="reply" name="reply" rows="3" required></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Submit
                                                            Reply</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        @else
                            <p class="text-center">No reviews yet.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">Your Reservation Details</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('client_side.details.reserve', ['id' => $space->id]) }}"
                            onsubmit="return validateForm()">
                            @csrf
                            <div class="mb-3">
                                <label for="date" class="form-label">Select Date</label>
                                <input type="date" class="form-control" id="reservation_date" name="reservation_date"
                                    required>
                                <div id="date_error" class="text-danger" style="display: none;"></div>
                            </div>
                            <div class="mb-3">
                                <label for="hours1" class="form-label">Full Hours</label>
                                <select class="form-control sync-select" id="hours1" name="hours" required>
                                    <option selected disabled>Select</option>
                                    @foreach ($pricing as $price)
                                        <option value="{{ $price->hours }}">{{ $price->hours }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="hours2" class="form-label">Full Hours</label>
                                <select class="form-control sync-select" id="hours2" name="price" required>
                                    <option selected disabled>Select</option>
                                    @foreach ($pricing as $price)
                                        <option value="{{ $price->price }}">{{ $price->price }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="guests" class="form-label">Number of Guests</label>
                                <input type="number" class="form-control" id="guests" name="guests" value="1"
                                    min="1" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ auth()->user()->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ auth()->user()->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="company" class="form-label">Company Name</label>
                                <input type="text" class="form-control" id="company" name="company" required>
                            </div>
                            <div class="mb-3">
                                <label for="contact" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="contact" name="contact"
                                    value="{{ auth()->user()->contact }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="arrival" class="form-label">Estimated Arrival Time</label>
                                <input type="time" class="form-control" id="arrival" name="arrival" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Pay Now</button>
                        </form>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">Cowork Images</div>
                    <div class="card-body">
                        <div class="image-grid">
                            @php
                                $maxImages = 4;
                                $remainingImages = count($images) - $maxImages;
                            @endphp

                            @foreach ($images as $index => $image)
                                @if ($index < $maxImages)
                                    <div class="image-container">
                                        <img src="{{ asset($image) }}" alt="Coworking Space Image" class="image"
                                            onerror="this.onerror=null;this.src='{{ asset('assets/img/no-image-available.jpeg') }}';">
                                        @if ($index == $maxImages - 1 && $remainingImages > 0)
                                            <div class="overlay">
                                                <span>+{{ $remainingImages }}</span>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Add Review</h5>
                </div>
                <form id="reviewForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="rating">Rating (1-5):</label>
                            <input type="number" name="rating" min="1" max="5" required
                                class="form-control" id="rating">
                        </div>
                        <div class="form-group">
                            <label for="reviewBody">Your Review:</label>
                            <textarea name="review_body" class="form-control" id="reviewBody" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveReviewButton">Save Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


    <script>
        // Create a mapping of hours to price from the PHP data
        const hoursToPrice = {
            @foreach ($pricing as $price)
                "{{ $price->hours }}": "{{ $price->price }}",
            @endforeach
        };

        const priceToHours = {
            @foreach ($pricing as $price)
                "{{ $price->price }}": "{{ $price->hours }}",
            @endforeach
        };

        const hoursSelect = document.getElementById('hours1');
        const priceSelect = document.getElementById('hours2');

        // Sync hours1 with hours2
        hoursSelect.addEventListener('change', (event) => {
            const selectedHours = event.target.value;
            const correspondingPrice = hoursToPrice[selectedHours];
            if (correspondingPrice) {
                priceSelect.value = correspondingPrice;
            }
        });

        // Sync hours2 with hours1
        priceSelect.addEventListener('change', (event) => {
            const selectedPrice = event.target.value;
            const correspondingHours = priceToHours[selectedPrice];
            if (correspondingHours) {
                hoursSelect.value = correspondingHours;
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select the button and collapse element for each review
            const replyButtons = document.querySelectorAll('[data-bs-toggle="collapse"]');

            replyButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const collapseElement = document.querySelector(button.getAttribute(
                        'data-bs-target'));

                    // Toggle button text based on the collapse state
                    if (collapseElement.classList.contains('show')) {
                        button.innerText = 'Show Replies';
                    } else {
                        button.innerText = 'Hide Replies';
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content') // Get CSRF token from meta tag
                }
            });

            // Handle review form submission
            $('#reviewForm').on('submit', function(event) {
                event.preventDefault();

                const formData = $(this).serialize();
                const spaceId = {{ $space->id }};
                const url = "{{ route('client_side.review.add', ':spaceId') }}".replace(':spaceId',
                    spaceId);

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    success: function(data) {
                        alertify.success('Review added successfully!');
                        location.reload();
                    },
                    error: function(xhr) {
                        alertify.error('Error: ' + xhr.responseText || xhr.statusText);
                        console.error('Error:', xhr);
                    }
                });
            });


            $('.remove-review').on('click', function() {
                const spaceId = $(this).data('id');
                showConfirmDelete(spaceId);
            });

            function showConfirmDelete(id) {
                alertify.confirm("Confirm Delete", "Are you sure you want to delete this review?",
                    function() {
                        $.ajax({
                            url: "{{ route('client_side.review.delete', ':id') }}".replace(':id', id),
                            method: 'DELETE',
                            success: function(data) {
                                alertify.success('Review deleted successfully!');
                                location.reload();
                            },
                            error: function(xhr) {
                                alertify.error('Error: ' + xhr.responseText || xhr.statusText);
                                console.error('Error:', xhr);
                            }
                        });
                    },
                    function() {
                        alertify.error('Canceled');
                    });
            }


            const dateInput = document.getElementById('reservation_date');
            const exceptedDaysString = @json($space->exceptions);
            const exceptedDays = exceptedDaysString.split(',').map(day => day.trim());

            // Helper: Map day names to index (0 = Sunday, 1 = Monday, etc.)
            const dayToIndex = {
                "sunday": 0,
                "monday": 1,
                "tuesday": 2,
                "wednesday": 3,
                "thursday": 4,
                "friday": 5,
                "saturday": 6
            };

            // Get disabled days as indices
            const disabledDays = exceptedDays.map(day => dayToIndex[day]);

            // Set the min date
            let today = new Date();
            let dd = String(today.getDate()).padStart(2, '0');
            let mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
            let yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;
            dateInput.setAttribute('min', today);

            // Disable invalid days on input
            dateInput.addEventListener('input', function() {
                const selectedDate = new Date(dateInput.value);
                const selectedDay = selectedDate.getDay(); // Day index (0 = Sunday, ..., 6 = Saturday)

                // Check if the selected day is in the disabled days
                if (disabledDays.includes(selectedDay)) {
                    alertify.error(`Reservations are not allowed on ${exceptedDays.join(', ')}.`);
                    dateInput.value = ''; // Clear invalid date
                }
            });
        });

        function validateForm() {
            const dateInput = document.getElementById('reservation_date');
            const errorContainer = document.getElementById('date_error');
            const selectedDate = new Date(dateInput.value);
            const today = new Date();

            // Reset error message
            errorContainer.style.display = 'none';
            errorContainer.innerText = '';

            // Clear time portion of today's date for comparison
            today.setHours(0, 0, 0, 0);

            const exceptedDays = @json($space->exceptions);

            // Check if the selected date is in the past
            if (selectedDate < today) {
                errorContainer.innerText = 'Please select a date that is today or in the future.';
                errorContainer.style.display = 'block';
                return false; // Prevent form submission
            }

            // Get the day of the week for the selected date
            const daysOfWeek = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
            const selectedDay = daysOfWeek[selectedDate.getDay()];

            // Check if the selected day is in the excepted days
            if (exceptedDays.includes(selectedDay)) {
                errorContainer.innerText = `Reservations are not allowed on ${selectedDay}s.`;
                errorContainer.style.display = 'block';
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }
    </script>

    <script>
        const latitude = {{ $space->latitude }};
        const longitude = {{ $space->longitude }};

        const map = L.map('map').setView([latitude, longitude], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        L.marker([latitude, longitude]).addTo(map)
            .bindPopup('{{ $space->coworking_space_name }}')
            .openPopup();
    </script>
@endsection
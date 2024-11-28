@extends('coworker_side.side')

@section('content')
<style>
    .separator-line {
        border: none;
        height: 2px;
        background-color: #1f1f1f;
        margin: 10px 0;
    }
</style>

<div class="mb-3">
    <h2><strong>WHAT OUR CLIENTS SAY</strong></h2>
    <hr class="separator-line" />

    @php
        // Calculate the percentage for the progress bars
        $fiveStarPercentage = ($fiveStar / $totalReviews) * 100;
        $fourStarPercentage = ($fourStar / $totalReviews) * 100;
        $threeStarPercentage = ($threeStar / $totalReviews) * 100;
        $twoStarPercentage = ($twoStar / $totalReviews) * 100;
        $oneStarPercentage = ($oneStar / $totalReviews) * 100;
    @endphp

    <div class="d-flex align-items-center">
        <strong class="me-2">{{ number_format($averageRating, 1) }}</strong> Out of 5 stars
        <div class="stars text-warning ms-3">
            {{-- Displaying the stars visually --}}
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= floor($averageRating))
                    ★
                @elseif ($i == ceil($averageRating))
                    ☆
                @else
                    ☆
                @endif
            @endfor
        </div>
    </div>
    
    <div class="review-summary mt-3">
        <div>Overall rating of {{ $totalReviews }} reviews</div>
        <ul class="list-unstyled">
            <li class="d-flex align-items-center">
                5 Stars:
                <div class="progress ms-2 w-50">
                    <div class="progress-bar bg-secondary" role="progressbar" style="width: {{ $fiveStarPercentage }}%;" aria-valuenow="{{ $fiveStarPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="ms-2">{{ $fiveStar }}</span>
            </li>
            <li class="d-flex align-items-center">
                4 Stars:
                <div class="progress ms-2 w-50">
                    <div class="progress-bar bg-secondary" role="progressbar" style="width: {{ $fourStarPercentage }}%;" aria-valuenow="{{ $fourStarPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="ms-2">{{ $fourStar }}</span>
            </li>
            <li class="d-flex align-items-center">
                3 Stars:
                <div class="progress ms-2 w-50">
                    <div class="progress-bar bg-secondary" role="progressbar" style="width: {{ $threeStarPercentage }}%;" aria-valuenow="{{ $threeStarPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="ms-2">{{ $threeStar }}</span>
            </li>
            <li class="d-flex align-items-center">
                2 Stars:
                <div class="progress ms-2 w-50">
                    <div class="progress-bar bg-secondary" role="progressbar" style="width: {{ $twoStarPercentage }}%;" aria-valuenow="{{ $twoStarPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="ms-2">{{ $twoStar }}</span>
            </li>
            <li class="d-flex align-items-center">
                1 Stars:
                <div class="progress ms-2 w-50">
                    <div class="progress-bar bg-secondary" role="progressbar" style="width: {{ $oneStarPercentage }}%;" aria-valuenow="{{ $oneStarPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="ms-2">{{ $oneStar }}</span>
            </li>
        </ul>
    </div>

    <div class="d-flex justify-content-end align-items-center mb-3">
        <div class="me-2">57 reviews sorted by :</div>
        <div>
            <select class="form-select d-inline-block me-2" style="width: auto;">
                <option>All Reviews</option>
                <option>Positive</option>
                <option>Critical</option>
            </select>
            <select class="form-select d-inline-block" style="width: auto;">
                <option>Newest to Oldest</option>
                <option>Oldest to Newest</option>
            </select>
        </div>
    </div>
    
    <div class="row">
        @foreach ($reviews as $review)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body position-relative">
                        <button class="btn btn-outline-secondary btn-sm position-absolute top-0 end-0 me-2 mt-2">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                        <div class="text-center mb-3">
                            <img src="{{ asset('assets/img/profile.png') }}" class="img-fluid rounded-circle" alt="Client image" style="width: 60px; height:60px;">
                            <h5 class="card-title">{{ $review->reviewer_name }}</h5>
                        </div>
                        
                        {{-- <div class="d-flex mb-3 justify-content-between">
                            <img src="{{ asset('assets/img/sample_room.jpg') }}" class="img-fluid rounded me-3" alt="Space image" style="width: 60%; object-fit:cover;">
                            <div>
                                <p class="mb-1"><strong>{{ $review->space_name }}</strong></p>
                                <p class="mb-1">Location</p>
                                <p>Open Hours</p>
                            </div>
                        </div> --}}

                        <div class="d-flex mb-3 justify-content-between">
                            <img src="{{ asset($review->header_image) }}" class="img-fluid rounded me-3" alt="Space image" style="width: 60%; object-fit:cover;">
                            <div>
                                <p class="mb-0">COWORKING SPACE NAME:</p>
                                <p class="mb-1"><strong>{{ $review->space_name }}</strong></p>
                                <p class="mb-0">Location:</p>
                                <p class="mb-1"></p>
                                <p class="mb-0">Open Hours</p>
                                <p class="mb-1"></p>
                            </div>
                        </div>
                
                        {{-- <p class="mb-0"><strong>{{ $review->review_body }}</strong></p> --}}
                        <p class="text-muted">{{ $review->created_at->format('D M d, Y') }}</p>

                
                        <div class="bg-light p-3 rounded border border-1">
                            <p class="mb-1"><strong>{{ $review->space_name }}</strong></p>
                            <div class="text-warning text-end mt-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="response-section row mb-5">
        <div class="col-md-10">
            <input type="text" class="form-control" placeholder="Write a response..." />
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Submit</button>
        </div>
    </div>
    
</div>
@endsection
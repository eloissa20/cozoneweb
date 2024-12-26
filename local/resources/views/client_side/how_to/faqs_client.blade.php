@extends('layouts.client_header')
@section('title', 'FAQs')
@section('content')
    <style>
        .find-space-section {
            text-align: center;
            padding: 50px;
            background-color: #f8f9fa;
        }

        .find-space-section h1 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .find-space-section button {
            margin-top: 20px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-2 border-end">
                <ul class="list-unstyled p-3 text-center">
                    <li><a href="{{ route('client_side.how.reserve') }}">How to Reserve a Seat...</a></li>
                    <li><a href="{{ route('client_side.how.find') }}">Find Office Space by Type</a></li>
                    <li><a href="{{ route('client_side.how.faqs') }}" class="active_sidebar">FAQs</a></li>
                </ul>
            </nav>

            <main class="col-md-7 page main_with_sidebar">
                <section class="faq-section">
                    <div class="find-space-section">
                        <h1>Our Most Frequently Asked Questions</h1>
                    </div>
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Question 1
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Answer for Question 1.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Question 2
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Answer for Question 2.
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

        </div>
    </div>
@endsection

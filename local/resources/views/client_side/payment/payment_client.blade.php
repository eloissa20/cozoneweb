@extends('layouts.client_header')
@section('title', 'Payment')
@section('content')
    <style>
        .btn-payment-method {
            width: 100%;
            margin-bottom: 10px;
        }

        .border-section {
            border: 1px solid #eaeaea;
            padding: 15px;
        }

        .summary-section {
            background-color: #f8f8f8;
            padding: 15px;
        }

        .card-title {
            font-weight: bold;
        }

        .payment-radio {
            display: none;
        }

        .placeholder-box {
            background-color: #e0e0e0;
            height: 50px;
            width: 120px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-top: 10px;
        }

        .payment-label {
            display: inline-block;
            padding: 15px;
            width: 100%;
            max-width: 250px;
            text-align: center;
            border-radius: 10px;
            background-color: white;
            border: 2px solid #ccc;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .payment-radio:checked+span+.placeholder-box {
            background-color: #007bff;
            border-color: #007bff;
        }

        .payment-radio:checked+span {
            color: #007bff;
        }

        .payment-label:hover {
            background-color: #f0f0f0;
        }

        .payment-label span {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>

    <div class="container page">
        <div class="row">
            <div class="col-md-6 border rounded" style="padding: 2rem">
                <div>
                    <h2 class="text-center">
                        Your Reservation Details
                    </h2>
                    <div>
                        <div class="mb-3">
                            <label class="form-label">Payment Methods</label>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-outline-dark btn-payment-method active"
                                    id="btnCreditCard">Credit Card</button>
                                <button type="button" class="btn btn-outline-dark btn-payment-method"
                                    id="btnEWallets">E-Wallets</button>
                            </div>
                        </div>

                        <form method="GET" action="{{ route('client_side.payment.success', ['id' => $space->id]) }}">
                            <div id="credit-card">
                                <div class="mb-3">
                                    <label for="nameOnCard" class="form-label">Name on Card</label>
                                    <input type="text" class="form-control" id="nameOnCard" placeholder="Full Name">
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label for="cardNumber" class="form-label">Card Number</label>
                                        <input type="text" class="form-control" id="cardNumber"
                                            placeholder="0000 0000 0000 0000">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cvvCode" class="form-label">CVV Code</label>
                                        <input type="text" class="form-control" id="cvvCode" placeholder="123">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="expiryDate" class="form-label">Expiry Date</label>
                                        <input type="text" class="form-control" id="expiryDate" placeholder="MM / YY">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="discountCode" class="form-label">Discount Code</label>
                                        <input type="text" class="form-control" id="discountCode"
                                            placeholder="Enter Code">
                                    </div>
                                </div>
                            </div>

                            <div id="e-wallets" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6 mb-4 text-center">
                                        <label class="payment-label">
                                            <input type="radio" name="payment" value="gcash" class="payment-radio">
                                            <span>GCash</span>
                                            <div class="placeholder-box"></div>
                                        </label>
                                    </div>

                                    <div class="col-md-6 mb-4 text-center">
                                        <label class="payment-label">
                                            <input type="radio" name="payment" value="maya" class="payment-radio">
                                            <span>Maya</span>
                                            <div class="placeholder-box"></div>
                                        </label>
                                    </div>

                                    <div class="col-md-6 mb-4 text-center">
                                        <label class="payment-label">
                                            <input type="radio" name="payment" value="paypal" class="payment-radio">
                                            <span>PayPal</span>
                                            <div class="placeholder-box"></div>
                                        </label>
                                    </div>

                                    <div class="col-md-6 mb-4 text-center">
                                        <label class="payment-label">
                                            <input type="radio" name="payment" value="grabpay" class="payment-radio">
                                            <span>GrabPay</span>
                                            <div class="placeholder-box"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-secondary"><a
                                        href="{{ route('client_side.details', ['id' => $space->id]) }}">Go Back</a></button>
                                <button type="submit" class="btn btn-dark">Confirm and Pay</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <img src="{{ asset($space->header_image) }}" style="height: 150px; width: 50%;" alt="Space">
                            <div class="ms-3">
                                <h5 class="mb-0">{{ $space->coworking_space_name }}</h5>
                                <p class="text-muted">★★★★★ 0 Reviews</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body summary-section">
                        <p><strong>{{ $transaction->guests }} Guest</strong> <br> {{ $transaction->reservation_date }}</p>
                        <p>₱ 80.00 x 1</p>
                        <div class="d-flex justify-content-between">
                            <p>Subtotal</p>
                            <p>₱ 80.00</p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p><strong>Total</strong></p>
                            <p><strong>₱ 80.00</strong></p>
                        </div>
                        <p class="text-muted mt-3"> Welcome to {{ $space->coworking_space_name }}, a vibrant coworking
                            space located at
                            {{ $space->unit }}, {{ $space->city }}, {{ $space->location }}, {{ $space->country }},
                            offering a dynamic environment for freelancers, startups, and established businesses.
                            Our facility features various workspace types, including private offices and meeting rooms,
                            with a seating capacity of {{ $space->capacity }}. We are open from
                            {{ $space->available_days_from }}
                            to {{ $space->available_days_to }} (except on {{ $space->exceptions }}), operating between
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
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const creditCardSection = document.getElementById('credit-card');
            const eWalletsSection = document.getElementById('e-wallets');
            const btnCreditCard = document.getElementById('btnCreditCard');
            const btnEWallets = document.getElementById('btnEWallets');

            btnCreditCard.addEventListener('click', function() {
                creditCardSection.style.display = 'block';
                eWalletsSection.style.display = 'none';
                btnCreditCard.classList.add('active');
                btnEWallets.classList.remove('active');
            });

            btnEWallets.addEventListener('click', function() {
                creditCardSection.style.display = 'none';
                eWalletsSection.style.display = 'block';
                btnEWallets.classList.add('active');
                btnCreditCard.classList.remove('active');
            });
        });
    </script>
@endsection
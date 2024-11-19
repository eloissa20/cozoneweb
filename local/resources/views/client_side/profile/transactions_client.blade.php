@extends('layouts.client_header')
@section('title', 'Profile')
@section('content')
    <style>
        .filter-container {
            text-align: right;
            margin-bottom: 20px;
        }
    </style>
    <div class="container-fluid mt-4">
        <div class="row">
            <nav id="sidebar" class="col-md-2 border-end">
                <div class="p-3">
                    <ul class="list-unstyled text-center">
                        <li><a href="{{ route('client_side.profile') }}">Personal Information</a></li>
                        <li><a href="{{ route('client_side.profile.transactions') }}" class="active_sidebar">Transaction
                                Details</a></li>
                        <li><a href="{{ route('client_side.profile.favorites') }}">Favorites / Wishlist</a></li>
                    </ul>
                    <button class="btn btn-dark w-100 align-bottom">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('LOG OUT') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </button>
                </div>
            </nav>

            <main class="col-md page main_with_sidebar">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Transaction History</h2>
                    </div>
                    <div class="card-body">
                        <table id="data-table" class="table table-responsive" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Space Name</th>
                                    <th>Amount</th>
                                    <th>Payment Methods</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#data-table').DataTable({
                serverSide: true,
                ajax: {
                    method: 'GET',
                    url: "{{ route('client_side.profile.transactions.data') }}",
                    error: function(xhr, error, code) {
                        console.log(xhr.responseText);
                        alert('Error: ' + xhr.responseText);
                    }
                },
                columns: [
                    {
                        data: 'date'
                    },
                    {
                        data: 'space_name'
                    },
                    {
                        data: 'amount'
                    },
                    {
                        data: 'payment_method'
                    },
                    {
                        data: 'status'
                    }
                ]
            });
        });
    </script>

@endsection
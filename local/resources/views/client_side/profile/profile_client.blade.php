@extends('layouts.client_header')
@section('title', 'Profile')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <nav id="sidebar" class="col-md-2 border-end">
                <div class="p-3">
                    <ul class="list-unstyled text-center">
                        <li><a href="{{ route('client_side.profile') }}" class="active_sidebar">Personal Information</a></li>
                        <li><a href="{{ route('client_side.profile.transactions') }}">Transaction Details</a></li>
                        <li><a href="{{ route('client_side.profile.favorites') }}">Favorites / Wishlist</a></li>
                    </ul>
                    <button class="btn btn-dark w-100 align-bottom"> <a class="dropdown-item" id="logout">
                            {{ __('LOG OUT') }}
                        </a>
                    </button>
                </div>
            </nav>

            <main class="col-md-7 page main_with_sidebar">
                <div class="container">
                    <h2>My Profile</h2>
                    <div class="profile-container">
                        <div class="d-flex justify-content-end">
                            <i class="bi bi-gear fs-4" style="cursor: pointer;" onclick="toggleInputs()"></i>
                        </div>
                        <form id="profile-form" class="w-75"
                            action="{{ route('client_side.profile.update', ['user' => auth()->user()]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <h6 class="p-2 fw-bold">{{ $user->email }}</h6>
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input hidden type="text" class="form-control" id="name" name="name"
                                    placeholder="Name" required value="{{ $user->name }}">
                                <p class="p-2 fw-bold">{{ $user->name }}</p>
                            </div>
                            <div class="form-group mb-3">
                                <label for="contactNo">Contact No.</label>
                                <input hidden type="text" class="form-control" id="contactNo" name="contact"
                                    placeholder="Contact No." required value="{{ $user->contact }}">
                                <p class="p-2 fw-bold">
                                    {{ !empty($user->contact) && trim($user->contact) !== '' ? $user->contact : 'Not Set' }}
                                </p>
                            </div>
                            <div class="form-group mb-3">
                                <label for="birthday">Birthday</label>
                                <input hidden type="date" class="form-control" id="birthday" required name="birthday"
                                    value="{{ $user->birthday }}">
                                <p class="p-2 fw-bold">
                                    {{ !empty($user->birthday) && trim($user->birthday) !== '' ? $user->birthday : 'Not Set' }}
                                </p>
                            </div>
                            <div class="form-group mb-3">
                                <label for="gender">Gender</label>
                                <select hidden class="form-control" id="gender" name="gender">
                                    <option selected disabled>Not Set</option>
                                    <option hidden value="Male" {{ $user->gender === 'Male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option hidden value="Female" {{ $user->gender === 'Female' ? 'selected' : '' }}>Female
                                    </option>
                                    <option hidden value="Other" {{ $user->gender === 'Other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                                <p class="p-2 fw-bold">
                                    {{ !empty($user->gender) && trim($user->gender) !== '' ? $user->gender : 'Not Set' }}
                                </p>
                            </div>
                            <div class="form-group mb-3">
                                <label for="address">Address</label>
                                <input hidden type="text" class="form-control" id="address" name="address"
                                    placeholder="Address" required value="{{ $user->address }}">
                                <p class="p-2 fw-bold">
                                    {{ !empty($user->address) && trim($user->address) !== '' ? $user->address : 'Not Set' }}
                                </p>
                            </div>
                            <button hidden id="submit-btn" class="btn btn-dark w-100 mt-2" type="submit">
                                Save Changes
                            </button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
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
        });

        function toggleInputs() {
            const inputs = document.querySelectorAll('.form-group input, .form-group select option');
            const gender = document.querySelector('#gender');
            const paragraphs = document.querySelectorAll('.form-group p');
            const saveBtn = document.querySelector('#submit-btn');

            inputs.forEach(input => {
                if (input.hasAttribute('hidden')) {
                    input.removeAttribute('hidden');
                    gender.removeAttribute('hidden');
                    saveBtn.removeAttribute('hidden');
                } else {
                    input.setAttribute('hidden', true);
                    gender.setAttribute('hidden', true);
                    saveBtn.setAttribute('hidden', true);
                }
            });

            paragraphs.forEach(p => {
                p.style.display = (p.style.display === 'none' ? 'block' : 'none');
            });
        }
    </script>
@endsection

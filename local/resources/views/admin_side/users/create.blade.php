@extends('admin_side.side')

@section('content')
<style>
    .card {
        border: 1px solid #000000;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div>
    <h3 class="fw-bold mb-4">Create User</h3>
    <form action="{{ route('user.store') }}" method="POST" class="border p-5 rounded">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <!-- Contact Field -->
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact" required>
                    </div>

                    <!-- Birthday Field -->
                    <div class="mb-3">
                        <label for="birthday" class="form-label">Birthday</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" required>
                    </div>

                    <div class="mb-3">
                        <label for="user_type" class="form-label">User Type</label>
                        <select class="form-control" id="user_type" name="user_type" required>
                            <option value="">Select Type</option>
                            <option value="1">Client</option>
                            <option value="2">Co Worker</option>
                            <option value="3">Admin</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Gender Field -->
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Address Field -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-end mt-3">
                <button type="submit" class="btn btn-outline-dark px-4 py-2">Submit</button>
            </div>
        </div>
    </form>
</div>

@endsection
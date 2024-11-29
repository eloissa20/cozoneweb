@extends('admin_side.side')

@section('content')
<style>
    .card{
        border: 1px solid #000000;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div>
  <h3 class="fw-bold mb-4">Edit User</h3>
    <form action="{{ route('user.update', $user->id) }}" method="POST" class="border p-5 rounded">
        @csrf
        @method('PUT')
        
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required>
                    </div>

                    <!-- Contact Field -->
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact" value="{{$user->contact}}" required>
                    </div>

                    <!-- Birthday Field -->
                    <div class="mb-3">
                        <label for="birthday" class="form-label">Birthday</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" value="{{$user->birthday}}" required>
                    </div>

                    <div class="mb-3">
                        <label for="user_type" class="form-label">User Type</label>
                        <select class="form-control" id="user_type" name="user_type" required>
                            <option value="1" {{ $user->user_type == 1 ? 'selected' : '' }}>Client</option>
                            <option value="2" {{ $user->user_type == 2 ? 'selected' : '' }}>Co Worker</option>
                            <option value="3" {{ $user->user_type == 3 ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Gender Field -->
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <!-- Address Field -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{$user->address}}" required>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-end mt-3">
                <button type="submit" class="btn btn-outline-dark px-4 py-2">Update</button>
            </div>
        </div>
    </form>
</div>

@endsection

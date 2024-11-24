{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

{{-- @extends('layouts.app')

@section('content') --}}

<link href="{{ asset('assets/login.css') }}" rel="stylesheet">
<body>
    <div class="login-container">
        <input type="checkbox" id="check">
        <div class="login form">
            <header>Login</header>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                {{-- Email Field --}}
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autocomplete="email" 
                    autofocus 
                    placeholder="Enter your email"
                >
                {{-- Display Email Error Below the Input Field --}}
                @error('email')
                    <div class="text-danger text-center" style="margin-bottom: 1rem;">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror

                {{-- Password Field --}}
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="current-password" 
                    placeholder="Enter your password"
                >
                {{-- Display Password Error Below the Input Field --}}
                @error('password')
                    <div class="text-danger text-center" style="margin-bottom: 1rem;">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror

                {{-- Forgot Password Link --}}
                <div class="form-options">
                    <a href="{{ route('password.request') }}" class="">Forgot password?</a>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>
            </form>

            {{-- Register Link --}}
            <div class="signup">
                <span class="signup">Don't have an account?
                    <label for="check">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </label>
                </span>
            </div>
        </div>
    </div>

    {{-- Loading Screen --}}
    <div id="loading-screen" class="loading-screen">
        <div class="spinner"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.querySelector('form');
            var loadingScreen = document.getElementById('loading-screen');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                loadingScreen.style.display = 'flex';

                function delay(ms) {
                    return new Promise(resolve => setTimeout(resolve, ms));
                }

                delay(1000).then(function() {
                    form.submit();
                });
            });
        });
    </script>
</body>

{{-- @endsection --}}
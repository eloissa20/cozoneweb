<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cozone | Log in</title>
    <link href="{{ asset('assets/login.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
</head>

<body>
    <div class="login-container">
        <input type="checkbox" id="check">
        <div class="login">
            <header>Login</header>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email Field --}}
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    autocomplete="email" autofocus placeholder="Enter your email">
                {{-- Display Email Error Below the Input Field --}}
                @error('email')
                    <div class="text-danger text-center" style="margin-bottom: 1rem;">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror

                {{-- Password Field --}}
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    placeholder="Enter your password">
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

</html>

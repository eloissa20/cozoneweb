<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cozone | Register as Cowork</title>
    <link href="{{ asset('assets/register.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
</head>

<body>
    <div class="register-container">
        <input type="checkbox" id="check">
        <div class="register">
            <header>Register as Cowork</header>
            <form method="POST" action="{{ route('register_as_cowork') }}">
                @csrf
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                    placeholder="Enter your name">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror mt-2"
                    name="email" value="{{ old('email') }}" required autocomplete="email"
                    placeholder="Enter your email">


                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror mt-2"
                    name="password" required autocomplete="new-password" placeholder="Create a password">


                <input id="password-confirm" type="password" class="form-control mt-2" name="password_confirmation"
                    required autocomplete="new-password" placeholder="Confirm your password">

                <button type="submit">
                    {{ __('Register') }}
                </button>
            </form>
        </div>
        <a class="other_button" href="{{ route('register') }}">{{ __('Register as User') }}
        </a>
        <div class="signup">
            <span class="signup">Already have an account?
                <label for="check">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </label>
            </span>
        </div>
    </div>
    </div>
</body>

</html>

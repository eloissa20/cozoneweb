<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
    <title>Landing Page</title>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<style>
    .hero-section {
        background-image: url('assets/img/hero-bg.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: white;
        text-align: center;
        padding: 100px 0;
    }
    .button {
        background: #fff;
        backface-visibility: hidden;
        border-radius: .375rem;
        border-style: solid;
        border-width: .100rem;
        box-sizing: border-box;
        color: #212121;
        cursor: pointer;
        display: inline-block;
        font-family: Circular,Helvetica,sans-serif;
        font-size: 1.125rem;
        font-weight: 700;
        letter-spacing: -.01em;
        line-height: 1.3;
        padding: .875rem 1.125rem;
        position: relative;
        text-align: left;
        text-decoration: none;
        transform: translateZ(0) scale(1);
        transition: transform .2s;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
    }

    .button:not(:disabled):hover {
        transform: scale(1.05);
    }

    .button:not(:disabled):hover:active {
        transform: scale(1.05) translateY(.125rem);
    }

    .button:focus {
        outline: 0 solid transparent;
    }

    .button:focus:before {
        content: "";
        left: calc(-1*.375rem);
        pointer-events: none;
        position: absolute;
        top: calc(-1*.375rem);
        transition: border-radius;
        user-select: none;
    }

    .button:focus:not(:focus-visible) {
        outline: 0 solid transparent;
    }

    .button:focus:not(:focus-visible):before {
        border-width: 0;
    }

    .button:not(:disabled):active {
        transform: translateY(.125rem);
    }
</style>
<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4">Welcome to Cozone</h1>
            <p class="lead">A great place to manage your spaces and connect with others.</p>
            <a href="{{ route('login') }}" class="button text-black">Get Started</a>

        </div>
    </section>

    <!-- Features Section -->
    <section class="container my-5">
        <div class="text-center mb-5">
            <h2>Features</h2>
            <p class="text-muted">Our platform offers a wide range of tools to make your experience easier and more productive.</p>
        </div>
        <div class="row">
            <div class="col-md-4 text-center">
                <i class="bi bi-layout-text-sidebar-reverse display-4 mb-3"></i>
                <h4>Manage Spaces</h4>
                <p>Easily manage your coworking spaces, meeting rooms, and more.</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="bi bi-people display-4 mb-3"></i>
                <h4>Connect with Coworkers</h4>
                <p>Connect, collaborate, and grow with your coworking community.</p>
            </div>
            <div class="col-md-4 text-center">
                <i class="bi bi-graph-up display-4 mb-3"></i>
                <h4>Analytics & Insights</h4>
                <p>Access powerful analytics to track usage and optimize your resources.</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-light py-5">
        <div class="container text-center">
            <h3>Ready to start?</h3>
            <p>Sign up now and take your coworking experience to the next level!</p>
            <a href="{{ route('login') }}" class="button text-black">Login</a>
        </div>
    </section>

</body>
</html>


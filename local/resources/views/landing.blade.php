<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Landing Page</title>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<style>
    .hero-section {
        background-image: url('assets/img/hero-header.png');
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
        font-family: Circular, Helvetica, sans-serif;
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

    .smaller-carousel {
        max-width: 700px;
        margin: 0 auto;
    }

    .smaller-carousel .carousel-inner {
        max-height: 400px;
    }

    .smaller-carousel img {
        max-height: 300px;
        width: auto;
    }

    .carousel-control-prev,
    .carousel-control-next {
        transform: translateY(45px);
    }
</style>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4" style="font-weight: bold; font-size: 5rem;">Welcome to Cozone</h1>
            <p class="lead">A great place to manage your spaces and connect with others.</p>
            <a href="{{ route('client_side.home') }}" class="button text-black">Get Started</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="container my-5">
        <div class="text-center mb-5">
            <h2 style="font-weight: bold; font-size: 2rem;">Features</h2>
            <p class="text-muted">Our platform offers a wide range of tools to make your experience easier and more productive.</p>
        </div>
        <!-- Carousel Slider -->
        <div id="featuresCarousel" class="carousel slide smaller-carousel" data-bs-ride="carousel" data-bs-interval="3000">
            <!-- Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#featuresCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#featuresCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#featuresCarousel" data-bs-slide-to="2"></button>
            </div>

            <!-- Slides -->
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="text-center">
                        <i class="bi bi-layout-text-sidebar-reverse display-4 mb-3"></i>
                        <h4 style="font-weight: bold; font-size: 2rem;">Manage Spaces</h4>
                        <p>Easily manage your coworking spaces, desks, and more.</p>
                        <img src="assets/img/sample_room.jpg" alt="Manage Spaces" class="img-fluid mt-2" style="border-radius: 10px; width: 95%;">
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="text-center">
                        <i class="bi bi-layout-text-sidebar-reverse display-4 mb-3"></i>
                        <h4 style="font-weight: bold; font-size: 2rem;">Connect with Coworkers</h4>
                        <p>Connect, collaborate, and grow with your coworking community.</p>
                        <img src="assets/img/sample_room.jpg" alt="Connect with Coworkers" class="img-fluid mt-2" style="border-radius: 10px; width: 95%;">
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="text-center">
                        <i class="bi bi-graph-up display-4 mb-3"></i>
                        <h4 style="font-weight: bold; font-size: 2rem;">Analytics & Insights</h4>
                        <p>Track usage and optimize resources with powerful analytics.</p>
                        <img src="assets/img/sample_room.jpg" alt="Analytics & Insights" class="img-fluid mt-2" style="border-radius: 10px; width: 95%;">
                    </div>
                </div>
            </div>

            <!-- Controls
            <button class="carousel-control-prev" type="button" data-bs-target="#featuresCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#featuresCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button> -->
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-light py-5">
        <div class="container text-center">
            <hr style="border: 1px solid #000; margin-bottom: 30px;">
            <h3 style="font-weight: bold;">Ready to start?</h3>
            <p>Sign up now and take your coworking experience to the next level!</p>
            <a href=" {{ route('register') }}" class="button text-black">Sign Up</a>
        </div>
    </section>

</body>

</html>
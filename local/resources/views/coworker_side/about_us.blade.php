@extends('coworker_side.side')
@section('content')
<style>
    .logo {
        font-size: 3rem;
        font-weight: bold;
    }

    .management-team img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background-color: #eaeaea;
    }

    .info-section {
        padding: 2rem 0;
    }

    .contact-box {
        background-color: #eaeaea;
        padding: 1rem;
        border-radius: 8px;
    }

    .send-btn {
        background-color: black;
        color: white;
    }

    .social-icons a {
        margin: 0 10px;
        color: black;
    }
</style>
<main class="page container">
    <section class="text-center mt-5 d-flex justify-content-center align-items-center gap-5">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo" style="height: 300px; width: 300px;">
        <p class="ms-5 p-5 h-20 bg-light">Smarter way to reserve coworking spaces. Effortlessly find and book the perfect workspace to fit your needs.
            Experience productivity and flexibility like never before.</p>
    </section>
    <section class="management-team text-center mt-5">
        <h2 style="font-weight: bold;">Management Team</h2>
        <div class=" container">
            <div class="row justify-content-center">
                <div class="col-2">
                    <img src="{{ asset('assets/img/andal.png') }}" alt="Team Member 1">
                    <p style="font-weight: bold;">Maria Eloissa Andal</p>
                </div>
                <div class="col-2">
                    <img src="{{ asset('assets/img/balatero.png') }}" alt="Team Member 2">
                    <p style="font-weight: bold;">Jay-Ann Angela Balatero</p>
                </div>
                <div class="col-2">
                    <img src="{{ asset('assets/img/caguiat.png') }}" alt="Team Member 3">
                    <p style="font-weight: bold;">Tara Francesca Caguiat</p>
                </div>
                <div class="col-2">
                    <img src="{{ asset('assets/img/enriquez.png') }}" alt="Team Member 4">
                    <p style="font-weight: bold;">Signet Enriquez</p>
                </div>
                <div class="col-2">
                    <img src="{{ asset('assets/img/recana.png') }}" alt="Team Member 5">
                    <p style="font-weight: bold;">Angel Cyrhen Recaña</p>
                </div>
            </div>
        </div>
    </section>

    <section class="info-section text-center mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-box">
                        <h3 style="font-weight: bold;">Our Mission</h3>
                        <p>To transform the coworking landscape by offering innovative reservation systems that streamline workspace access. We aim to create a collaborative environment where flexibility, efficiency, and convenience enable professionals to thrive. By leveraging cutting-edge technology and exceptional service, we empower individuals and teams to connect and succeed in dynamic workspaces.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-box">
                        <h3 style="font-weight: bold;">Our Values</h3>
                        <p>We are committed to flexibility, adapting our platform to the evolving needs of modern professionals. At the core of our approach is innovation, utilizing advanced technology to redefine the coworking experience. We prioritize simplicity, offering an intuitive system that streamlines bookings while fostering a collaborative, creative community. Sustainability drives us, promoting shared workspaces as an eco-friendly solution for the future of work.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Us Section -->
    <section class="contact-section mt-5">
        <div class="container text-center">
            <h2 style="font-weight: bold;">Contact Us</h2>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Full Name">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="E-mail">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="4" placeholder="Type your message here..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark send-btn w-100">SEND</button>
                    </form>
                </div>
                <div class="col-md-4 text-start mt-4">
                    <h5>Contact</h5>
                    <p>example@example.com</p>
                    <h5>Based In</h5>
                    <p>Manila, Metro Manila, PH</p>
                    <div class="social-icons">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
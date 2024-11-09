@extends('layouts.client_header')
@section('title', 'Home')
@section('content')
<style>
    .search-section {
        padding: 50px 0;
    }

    .search-box {
        background-color: #fff;
        padding: 30px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        max-width: 800px;
        margin: 0 auto;
    }

    .coworking-spaces {
        padding: 50px 0;
    }

    .coworking-spaces img {
        height: 250px;
        width: 100%;
    }

    .coworking-spaces h2 {
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
    }

    .coworking-space-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .coworking-space-card:hover {
        transform: scale(1.05);
    }

    .coworking-space-image {
        width: 100%;
        height: 200px;
        background-color: #ccc;
    }

    .coworking-space-info {
        padding: 15px;
    }

    .view-all {
        text-align: right;
        font-size: 0.9rem;
    }
</style>

<main class="container page">
    <section class="search-section">
        <div class="container">
            <div class="search-box">
                <form class="row g-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search Location">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option selected>Type of Space</option>
                            <option value="1">Private Office</option>
                            <option value="2">Meeting Room</option>
                            <option value="3">Desk Space</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-dark w-100">Find Space</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="coworking-spaces">
        <div class="container">
            <div>
                <h1 class="text-center fw-bolder">TOP COWORKING SPACES</h1>
            </div>
            <div class="view-all mb-3 pb-3 border-bottom">
                <a href="{{ route('client_side.lists') }}" class="text-dark link-opacity-100-hover">View all coworking spaces &#x2192;</a>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="coworking-space-card">
                        <img src="https://th.bing.com/th/id/OIP.b8JbnTkGXa76-JNi757qCwHaFj?rs=1&pid=ImgDetMain" alt="Space">
                        <div class="coworking-space-info">
                            <h5 class="fw-bold">Coworking Space Name</h5>
                            <p>Location</p>
                            <p>&#9733;&#9733;&#9733;&#9733;&#9733;</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="coworking-space-card">
                        <img src="https://th.bing.com/th/id/OIP.b8JbnTkGXa76-JNi757qCwHaFj?rs=1&pid=ImgDetMain" alt="Space">
                        <div class="coworking-space-info">
                            <h5 class="fw-bold">Coworking Space Name</h5>
                            <p>Location</p>
                            <p>&#9733;&#9733;&#9733;&#9733;&#9733;</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="coworking-space-card">
                        <img src="https://th.bing.com/th/id/OIP.b8JbnTkGXa76-JNi757qCwHaFj?rs=1&pid=ImgDetMain" alt="Space">
                        <div class="coworking-space-info">
                            <h5 class="fw-bold">Coworking Space Name</h5>
                            <p>Location</p>
                            <p>&#9733;&#9733;&#9733;&#9733;&#9733;</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
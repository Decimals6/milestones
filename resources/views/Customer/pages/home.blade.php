@extends('Customer.layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="container">

    {{-- Carousel - Today's Specials --}}
    <div id="specialsCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner rounded-3 shadow-sm">
            <div class="carousel-item active">
                <img src="https://via.placeholder.com/1200x300?text=Special+Fast+Food+1" class="d-block w-100" alt="Offer 1">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1200x300?text=Special+Fast+Food+2" class="d-block w-100" alt="Offer 2">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#specialsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#specialsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    {{-- Dish Discoveries --}}
    <div class="bg-body-tertiary p-3 rounded shadow-sm mb-4">
        <h5 class="fw-bold mb-3">Dish Discoveries</h5>
        <div class="row row-cols-4 row-cols-sm-5 row-cols-md-7 g-3 text-center">
            @foreach(['Set Menu', 'Hot Item', 'Biriyani', 'Drinks', 'Pizza', 'Sandwich', 'Burger'] as $cat)
                <div class="col">
                    <div class="border rounded p-2 bg-white h-100">
                        <img src="https://via.placeholder.com/50" class="img-fluid mb-1" alt="{{ $cat }}">
                        <div class="small">{{ $cat }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Local Eats --}}
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="fw-bold mb-0">Local Eats</h5>
            <a href="#" class="text-decoration-none small text-primary">Discover All</a>
        </div>
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-3">
            @foreach([
                ['Zinger & Pop', 'https://via.placeholder.com/200', 100, 4.0, false],
                ['Popcorn Rice Bowl', 'https://via.placeholder.com/200', 130, 4.2, false],
                ['Chizza Meal', 'https://via.placeholder.com/200', 258, 4.0, true],
                ['Spicy Burger', 'https://via.placeholder.com/200', 72, 3.0, true],
            ] as [$name, $image, $price, $rating, $discount])
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 position-relative">
                        @if($discount)
                            <span class="badge bg-danger position-absolute top-0 end-0 m-2">SALE</span>
                        @endif
                        <img src="{{ $image }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="{{ $name }}">
                        <div class="card-body text-center p-2">
                            <h6 class="fw-bold mb-1">{{ $name }}</h6>
                            <div class="text-warning small mb-1">
                                ★ {{ $rating }}
                            </div>
                            <div class="text-success fw-bold">${{ number_format($price, 2) }}</div>
                            <button class="btn btn-sm btn-danger rounded-pill mt-2">
                                <i class="bi bi-plus-circle me-1"></i> Add
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection

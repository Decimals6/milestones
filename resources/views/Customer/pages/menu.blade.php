@extends('Customer.layouts.app')

@section('title', 'Menu')

@section('content')
<div class="container">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Our Menu</h4>
        <button class="btn btn-outline-secondary btn-sm" id="themeToggle">
            <i class="bi bi-circle-half"></i> Theme
        </button>
    </div>

    {{-- Kategori Menu --}}
    <div class="mb-4 overflow-auto">
        <div class="d-flex gap-3 flex-nowrap">
            @foreach(['All', 'Pizza', 'Burger', 'Rice', 'Hot Deals', 'Drinks'] as $cat)
                <button class="btn btn-outline-primary rounded-pill px-3 py-1 flex-shrink-0">{{ $cat }}</button>
            @endforeach
        </div>
    </div>

    {{-- Daftar Menu --}}
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-4">
        @foreach([
            ['Beef Burger', 'https://via.placeholder.com/400', 32000, 4.5],
            ['Pepperoni Pizza', 'https://via.placeholder.com/400', 48000, 4.7],
            ['Fried Chicken Rice', 'https://via.placeholder.com/400', 25000, 4.2],
            ['Cola Bottle', 'https://via.placeholder.com/400', 9000, 3.8]
        ] as [$name, $image, $price, $rating])
            <div class="col">
                @include('Customer.components.product-card', [
                    'image' => $image,
                    'title' => $name,
                    'price' => $price,
                    'rating' => $rating
                ])
            </div>
        @endforeach
    </div>

</div>
@endsection

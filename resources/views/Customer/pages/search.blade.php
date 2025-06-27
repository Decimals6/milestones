@extends('Customer.layouts.app')

@section('title', 'Pencarian')

@section('content')
<div class="container">

    {{-- Judul --}}
    <h4 class="fw-bold mb-3">Pencarian Menu</h4>

    {{-- Search Bar --}}
    <form action="#" method="GET" class="mb-4">
        <div class="input-group">
            <span class="input-group-text bg-white dark:bg-secondary border-end-0">
                <i class="bi bi-search text-muted"></i>
            </span>
            <input type="text" name="q" class="form-control border-start-0 dark:bg-dark dark:text-light"
                   placeholder="Cari menu favoritmu..." value="{{ request('q') }}">
        </div>
    </form>

    {{-- Rekomendasi atau Hasil --}}
    @php
        $searchQuery = request('q');
        $results = $searchQuery
            ? [
                ['Nasi Goreng Spesial', 'https://via.placeholder.com/300', 25000, 4.2],
                ['Ayam Bakar Madu', 'https://via.placeholder.com/300', 28000, 4.4]
              ]
            : null;

        $suggestions = ['Pizza', 'Ayam Geprek', 'Burger', 'Spaghetti', 'Ice Cream'];
    @endphp

    @if(!$searchQuery)
        {{-- Saran Populer --}}
        <div class="mb-4">
            <h6 class="fw-bold">Populer</h6>
            <div class="d-flex flex-wrap gap-2">
                @foreach($suggestions as $item)
                    <a href="?q={{ urlencode($item) }}" class="btn btn-outline-secondary btn-sm rounded-pill">{{ $item }}</a>
                @endforeach
            </div>
        </div>
    @elseif($results)
        {{-- Hasil Pencarian --}}
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-4">
            @foreach($results as [$title, $image, $price, $rating])
                <div class="col">
                    @include('Customer.components.product-card', [
                        'image' => $image,
                        'title' => $title,
                        'price' => $price,
                        'rating' => $rating
                    ])
                </div>
            @endforeach
        </div>
    @else
        {{-- Tidak Ditemukan --}}
        <div class="text-center py-5">
            <i class="bi bi-search fs-1 text-muted"></i>
            <h6 class="mt-3">Tidak ada hasil ditemukan</h6>
            <p class="text-muted">Coba kata kunci lain.</p>
        </div>
    @endif

</div>
@endsection

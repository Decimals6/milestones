@extends('Customer.layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bold">Selamat Datang, {{ Auth::user()->first_name ?? 'User' }}</h3>
        <p class="text-muted">Temukan produk terbaik hanya di sini.</p>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-4">
            @include('Customer.components.product-card', [
                'title' => 'Produk Spesial',
                'desc' => 'Promo terbatas hari ini saja!',
                'price' => 'Rp 25.000'
            ])
        </div>
    </div>
@endsection


<div>
    Home
    <li>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i data-feather="log-out"></i><span>Logout</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</div>

@extends('Customer.layouts.app')

@section('title', 'Beranda')

@section('content')
    <h3 class="mb-4">Selamat Datang di Portal Pelanggan</h3>

    @include('Customer.components.alert')

    <div class="row">
        <div class="col-md-6 mb-3">
            @include('Customer.components.product-card', [
                'title' => 'Produk Spesial',
                'desc' => 'Promo terbatas hari ini saja!',
                'price' => 'Rp 25.000'
            ])
        </div>
    </div>
@endsection

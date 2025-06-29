@extends('Customer.layouts.app')

@section('title', 'Notifikasi')

@section('content')
<div class="container">

    {{-- Judul --}}
    <h4 class="fw-bold mb-4">Notifikasi</h4>

    {{-- Notifikasi List --}}
    @php
        $notifications = [
            ['title' => 'Promo Hari Ini!', 'desc' => 'Diskon 30% untuk semua menu Pizza.', 'time' => '5 menit yang lalu'],
            ['title' => 'Pesanan Diterima', 'desc' => 'Pesanan kamu sedang diproses oleh restoran.', 'time' => '1 jam yang lalu'],
        ];
    @endphp

    @if(count($notifications) > 0)
        <div class="list-group shadow-sm mb-4">
            @foreach($notifications as $notif)
                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                    <div class="me-3">
                        <i class="bi bi-bell-fill text-primary fs-4"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold">{{ $notif['title'] }}</div>
                        <div class="small text-muted">{{ $notif['desc'] }}</div>
                    </div>
                    <small class="text-muted ms-2">{{ $notif['time'] }}</small>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-bell-slash fs-1 text-secondary"></i>
            <h6 class="mt-3">Tidak ada notifikasi</h6>
            <p class="text-muted">Notifikasi kamu akan muncul di sini saat tersedia.</p>
        </div>
    @endif

</div>
@endsection

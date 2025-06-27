@extends('Customer.layouts.app')

@section('title', 'Lacak Pesanan')

@section('content')
<div class="container">

    {{-- Judul --}}
    <h4 class="fw-bold mb-4">Lacak Pesanan</h4>

    {{-- Stepper Status --}}
    <ol class="list-group list-group-numbered mb-4">
        @foreach([
            ['status' => 'Pesanan Diterima', 'done' => true],
            ['status' => 'Sedang Dimasak', 'done' => true],
            ['status' => 'Dalam Pengantaran', 'done' => false],
            ['status' => 'Tiba di Lokasi', 'done' => false],
        ] as $step)
            <li class="list-group-item d-flex justify-content-between align-items-center
                {{ $step['done'] ? 'list-group-item-success' : '' }}">
                {{ $step['status'] }}
                @if($step['done'])
                    <i class="bi bi-check-circle-fill text-success"></i>
                @else
                    <span class="spinner-border spinner-border-sm text-secondary"></span>
                @endif
            </li>
        @endforeach
    </ol>

    {{-- Info Kurir --}}
    <div class="card shadow-sm mb-4 border-0 p-3 d-flex flex-row align-items-center bg-white dark:bg-dark">
        <img src="https://via.placeholder.com/60" alt="Kurir" class="rounded-circle me-3" width="60" height="60">
        <div class="flex-grow-1">
            <h6 class="mb-1">Budi, Pengemudi</h6>
            <small class="text-muted">Plat: B 1234 CD</small>
        </div>
        <a href="tel:+628123456789" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-telephone me-1"></i> Hubungi
        </a>
    </div>

    {{-- Estimasi Timer --}}
    <div class="bg-light p-3 rounded text-center mb-4">
        <div class="text-muted small mb-1">Estimasi Tiba</div>
        <h5 class="fw-bold text-success">18 Menit Lagi</h5>
    </div>

    {{-- Tombol Refresh --}}
    <div class="text-center">
        <button class="btn btn-outline-secondary">
            <i class="bi bi-arrow-clockwise me-1"></i> Perbarui Status
        </button>
    </div>

</div>
@endsection

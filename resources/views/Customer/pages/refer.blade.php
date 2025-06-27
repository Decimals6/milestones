@extends('Customer.layouts.app')

@section('title', 'Referensi & Hadiah')

@section('content')
<div class="container">

    {{-- Judul --}}
    <h4 class="fw-bold mb-3">Ajak Teman & Dapatkan Hadiah!</h4>
    <p class="text-muted mb-4">
        Bagikan kode referral kamu ke teman dan dapatkan saldo hingga <strong>Rp10.000</strong> untuk setiap pengguna baru yang mendaftar dan melakukan pesanan.
    </p>

    {{-- Kode Referral --}}
    <div class="text-center mb-4">
        <div class="d-inline-flex align-items-center border rounded-pill px-4 py-2 bg-light">
            <strong class="me-3">REF12345</strong>
            <button class="btn btn-sm btn-outline-primary" onclick="navigator.clipboard.writeText('REF12345')">
                <i class="bi bi-clipboard"></i> Salin
            </button>
        </div>
    </div>

    {{-- Tombol Share --}}
    <div class="text-center mb-5">
        <a href="#" class="btn btn-success btn-lg rounded-pill px-5">
            <i class="bi bi-share me-1"></i> Bagikan Sekarang
        </a>
    </div>

    {{-- Penjelasan Program --}}
    <div class="bg-body-tertiary rounded p-4 shadow-sm">
        <h6 class="fw-bold mb-3">Cara Kerja Program</h6>
        <ul class="list-group list-group-flush small">
            <li class="list-group-item">1. Salin dan bagikan kode referral kamu ke teman-teman.</li>
            <li class="list-group-item">2. Temanmu harus mendaftar dan melakukan pesanan pertama.</li>
            <li class="list-group-item">3. Kamu akan mendapatkan hadiah langsung ke dompet setelah pesanan berhasil.</li>
        </ul>
    </div>

</div>
@endsection

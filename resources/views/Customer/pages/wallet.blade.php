@extends('Customer.layouts.app')

@section('title', 'Dompet')

@section('content')
<div class="container">

    {{-- Header Saldo --}}
    <div class="bg-success text-white rounded p-4 shadow-sm mb-4 text-center">
        <div class="fw-bold">Saldo Dompet Anda</div>
        <h2 class="fw-bold mt-1">Rp120.000</h2>
    </div>

    {{-- Tombol Aksi --}}
    <div class="d-flex justify-content-center gap-3 mb-4">
        <button class="btn btn-outline-light bg-primary text-white">
            <i class="bi bi-wallet2 me-1"></i> Tambah Saldo
        </button>
        <button class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-right me-1"></i> Konversi
        </button>
    </div>

    {{-- Riwayat Transaksi --}}
    <h6 class="fw-bold mb-3">Riwayat Transaksi</h6>
    @php
        $history = [
            ['label' => 'Top Up via Transfer', 'amount' => 50000, 'type' => 'in', 'date' => '26 Jun 2025'],
            ['label' => 'Pembayaran Pesanan #INV12345', 'amount' => 28000, 'type' => 'out', 'date' => '25 Jun 2025'],
        ];
    @endphp

    @if(count($history) > 0)
        <ul class="list-group shadow-sm mb-5">
            @foreach($history as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-semibold">{{ $item['label'] }}</div>
                        <small class="text-muted">{{ $item['date'] }}</small>
                    </div>
                    <div class="fw-bold {{ $item['type'] === 'in' ? 'text-success' : 'text-danger' }}">
                        {{ $item['type'] === 'in' ? '+' : '-' }}Rp{{ number_format($item['amount'], 0, ',', '.') }}
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="text-center py-5">
            <i class="bi bi-wallet2 fs-1 text-muted"></i>
            <h6 class="mt-3">Belum ada transaksi</h6>
            <p class="text-muted">Transaksi Anda akan muncul di sini.</p>
        </div>
    @endif

</div>
@endsection

@extends('Customer.layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<div class="container">

    {{-- Judul --}}
    <h4 class="fw-bold mb-4">Pesanan Saya</h4>

    {{-- Tab Navigasi --}}
    <ul class="nav nav-tabs mb-3" id="orderTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="ongoing-tab" data-bs-toggle="tab" data-bs-target="#ongoing" type="button" role="tab">
                Sedang Diproses
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab">
                Selesai
            </button>
        </li>
    </ul>

    {{-- Tab Content --}}
    <div class="tab-content" id="orderTabsContent">

        {{-- Tab 1: Sedang Diproses --}}
        <div class="tab-pane fade show active" id="ongoing" role="tabpanel">
            @foreach([
                ['INV12345', 'Dalam Pengantaran', '5 menit lalu', 2, 56000],
                ['INV12346', 'Menunggu Konfirmasi', '10 menit lalu', 1, 32000],
            ] as [$id, $status, $time, $itemCount, $total])
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mb-1 fw-bold">#{{ $id }}</h6>
                                <div class="small text-muted">{{ $time }} • {{ $itemCount }} item</div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-info">{{ $status }}</span><br>
                                <div class="fw-semibold text-danger mt-1">Rp{{ number_format($total, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Tab 2: Selesai --}}
        <div class="tab-pane fade" id="completed" role="tabpanel">
            @foreach([
                ['INV12200', 'Selesai', '2 hari lalu', 3, 74000],
                ['INV12199', 'Selesai', '5 hari lalu', 1, 29000],
            ] as [$id, $status, $time, $itemCount, $total])
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mb-1 fw-bold">#{{ $id }}</h6>
                                <div class="small text-muted">{{ $time }} • {{ $itemCount }} item</div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-success">{{ $status }}</span><br>
                                <div class="fw-semibold text-success mt-1">Rp{{ number_format($total, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

</div>
@endsection

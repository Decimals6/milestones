@extends('Customer.layouts.app')

@section('title', 'Profil')

@section('content')
<div class="container">

    {{-- Header Profil --}}
    <div class="text-center mb-4">
        <img src="https://via.placeholder.com/100" alt="User Avatar" class="rounded-circle mb-2" style="width: 100px; height: 100px;">
        <h5 class="fw-bold mb-0">Nama Pengguna</h5>
        <small class="text-muted">email@example.com</small>
    </div>

    {{-- Form Ubah Profil --}}
    <div class="card shadow-sm border-0 p-4 mb-4 bg-white dark:bg-dark">
        <h6 class="fw-bold mb-3">Edit Profil</h6>
        <form action="#" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" placeholder="Masukkan nama Anda" value="Nama Pengguna">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="Email" value="email@example.com">
            </div>
            <div class="mb-3">
                <label class="form-label">Nomor HP</label>
                <input type="text" class="form-control" placeholder="08xxxxxx" value="08123456789">
            </div>
            <div class="text-end">
                <button class="btn btn-primary px-4">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    {{-- Tambahan --}}
    <div class="d-grid gap-2">
        <a href="#" class="btn btn-outline-secondary">
            <i class="bi bi-box-arrow-right me-1"></i> Logout
        </a>
        <button class="btn btn-outline-dark" id="themeToggle">
            <i class="bi bi-circle-half me-1"></i> Ubah Mode Gelap
        </button>
    </div>

</div>
@endsection

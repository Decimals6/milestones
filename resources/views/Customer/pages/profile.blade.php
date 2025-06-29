@extends('Customer.layouts.app')
@section('title', 'Profil')

@section('content')
    <style>
        .container-profile {
            max-width: 1140px;
            margin: auto;
            padding: 2rem 1rem;
        }

        .avatar-profile {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #dee2e6;
            cursor: pointer;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1.25rem;
            margin-top: 2rem;
        }

        .menu-item {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.2rem 0.5rem;
            text-align: center;
            color: #333;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .menu-item i {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .menu-item:hover {
            background: #e9ecef;
            color: #0d6efd;
        }

        .dark .menu-item {
            background: #2a2a2a;
            color: #eee;
        }

        .dark .menu-item:hover {
            background: #333;
            color: #0d6efd;
        }

        /* Modal styling */
        .modal.profile-modal {
            z-index: 3050;
        }

        .modal.profile-modal .modal-content {
            border-radius: 16px;
            padding: 2rem;
        }

        .dark .modal.profile-modal .modal-content {
            background: #1e1e1e;
            color: #fff;
        }

        .dark .modal.profile-modal .btn-close {
            filter: invert(1);
        }

        .upload-avatar-wrapper {
            position: relative;
            width: 100px;
            height: 100px;
            margin: auto;
        }

        .upload-avatar-wrapper img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #ccc;
        }

        .upload-avatar-wrapper label {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #0d6efd;
            color: #fff;
            border-radius: 50%;
            padding: 4px;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .logout-card {
            background: #fff;
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            color: #dc3545;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid #dc3545;
        }

        .logout-card:hover {
            background: #dc3545;
            color: #fff;
        }

        .dark .logout-card {
            background: #2b2b2b;
            border-color: #ff6b6b;
            color: #ff6b6b;
        }

        .dark .logout-card:hover {
            background: #ff6b6b;
            color: #000;
        }

        body.dark .text-muted {
            color: #e0e0e0 !important;
        }

        .profile-tile {
            width: 100%;
            height: 100%;
            padding: 1.2rem 0.8rem;
            border-radius: 0.75rem;
            background: #f8f9fa;
            color: #333;
            border: none;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease-in-out;
        }

        .profile-tile:hover {
            background-color: #e9ecef;
            color: #000;
        }

        .dark .profile-tile {
            background: #2b2b2b;
            color: #fff;
        }

        .dark .profile-tile:hover {
            background: #353535;
        }

        .danger-tile {
            background-color: #ffe5e5;
            color: #dc3545;
        }

        .danger-tile:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .dark .danger-tile {
            background-color: #3a1c1c;
            color: #ff6b6b;
        }

        .dark .danger-tile:hover {
            background-color: #ff6b6b;
            color: #000;
        }
    </style>

    <div class="container-profile">

        {{-- Static Account Section --}}
        <div class="text-center">
            <img src="https://picsum.photos/100" alt="User Avatar" class="avatar-profile mb-2 shadow"
                onclick="showProfileModal()">
            <h5 class="fw-bold mb-0">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h5>
            <small class="text-muted">{{ auth()->user()->email }}</small>
        </div>

        {{-- Grid Menu --}}
        <div class="menu-grid">

            <a href="{{ route('customer.profile') }}" class="menu-item">
                <i class="bi bi-person"></i> Profile
            </a>

            <a href="{{ route('orders') }}" class="menu-item">
                <i class="bi bi-receipt"></i> My Order
            </a>

            <a href="#" class="menu-item">
                <i class="bi bi-star"></i> Menu
            </a>

            <a href="{{ route('notifications') }}" class="menu-item">
                <i class="bi bi-bell"></i> Notification
            </a>

            <a href="{{ route('wallet') }}" class="menu-item">
                <i class="bi bi-wallet2"></i> Wallet
            </a>

            <a href="{{ route('coupons') }}" class="menu-item">
                <i class="bi bi-ticket-perforated"></i> Coupon
            </a>

            <a href="{{ route('refer') }}" class="menu-item">
                <i class="bi bi-people"></i> Refer &amp; Earn
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="profile-tile danger-tile">
                    <i class="bi bi-box-arrow-right fs-4"></i>
                    <span class="mt-2 small">Logout</span>
                </button>
            </form>

        </div>
    </div>

    {{-- Modal Edit Profile --}}
    <div class="modal fade profile-modal" id="profileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="modal-title">Edit Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="upload-avatar-wrapper mb-4">
                        <img src="https://picsum.photos/100" alt="Avatar Preview">
                        <label for="avatarInput"><i class="bi bi-camera"></i></label>
                        <input type="file" id="avatarInput" name="avatar" class="d-none">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->first_name }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->last_name }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ auth()->user()->email }}">
                    </div>

                    <div class="text-end mt-3">
                        <button class="btn btn-primary px-4">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- Script --}}
    <script>
        function showProfileModal() {
            const modal = new bootstrap.Modal(document.getElementById('profileModal'));
            modal.show();
        }

        document.getElementById('avatarInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const img = document.querySelector('.upload-avatar-wrapper img');
                img.src = URL.createObjectURL(file);
            }
        });
    </script>
@endsection

<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Customer') | BellFresh</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: var(--bs-body-bg);
            transition: background-color 0.3s ease;
        }

        .dark .navbar,
        .dark .dropdown-menu,
        .dark .list-group-item,
        .dark .input-group-text {
            background-color: #212529 !important;
            color: #fff !important;
        }

        .dark .dropdown-item {
            color: #fff !important;
        }

        .dark .form-control {
            background-color: #343a40 !important;
            color: #fff !important;
        }

        .menu-popup {
            position: absolute;
            top: 60px;
            left: 0;
            right: 0;
            z-index: 1045;
            background: #fff;
            display: none;
        }

        .menu-popup.active {
            display: block;
        }

        /* Sidebar */
        #sidebar {
            z-index: 1050;
            overflow-y: auto;
            width: 300px;
        }

        .dark .btn-outline-secondary {
            color: #fff;
            border-color: #6c757d;
        }

        .dark .btn-outline-secondary:hover {
            background-color: #495057;
        }
    </style>
</head>
<body class="position-relative">

    {{-- Navbar --}}
    @include('Customer.layouts.navbar')

    {{-- Sidebar (Account Menu Only) --}}
    <div id="sidebar" class="position-fixed top-0 end-0 bg-white dark:bg-dark shadow p-3 d-none"
         style="height: 100vh;">
        <h5 class="text-dark dark:text-white">Account Menu</h5>
        <div class="row row-cols-3 g-3 text-center">
            @foreach (['Profile', 'My Order', 'Favourite', 'Notification', 'Wallet', 'Loyalty Point', 'Coupon'] as $item)
                <div>
                    <i class="bi bi-person-circle fs-3"></i>
                    <div class="small text-dark dark:text-white">{{ $item }}</div>
                </div>
            @endforeach
        </div>
        <button class="btn btn-secondary w-100 mt-4" onclick="toggleSidebar()">Close</button>
    </div>

    {{-- Main Content --}}
    <main class="container-fluid p-3">
        @yield('content')
    </main>

    {{-- Bottom nav (mobile only) --}}
    @includeIf('Customer.layouts.bottomnav')

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Theme & Sidebar Script -->
    <script>
        const themeToggle = document.getElementById('themeToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');

        themeToggle?.addEventListener('click', () => {
            document.body.classList.toggle('dark');
            localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
        });

        sidebarToggle?.addEventListener('click', () => {
            sidebar.classList.toggle('d-none');
        });

        function toggleSidebar() {
            sidebar.classList.add('d-none');
        }

        window.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('theme') === 'dark') {
                document.body.classList.add('dark');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>

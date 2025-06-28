<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Customer') | BellFresh</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        /* GLOBAL DARK BODY */
        .dark {
            background-color: #1f1f1f !important;
            color: #e2e2e2 !important;
        }

        /* BACKGROUND CONTAINERS */
        .dark .bg-white,
        .dark .navbar,
        .dark .dropdown-menu,
        .dark .offcanvas,
        .dark .card,
        .dark .special-box,
        .dark .discover-box,
        .dark .chef-wrap,
        .dark .form-control {
            background-color: #2b2b2b !important;
            color: #f2f2f2 !important;
            border-color: #3d3d3d !important;
        }

        /* TEXT */
        .dark h1,
        .dark h2,
        .dark h3,
        .dark h4,
        .dark h5,
        .dark .section-title {
            color: #ffffff !important;
        }

        /* PLACEHOLDER TEXT */
        .dark .form-control::placeholder {
            color: #aaaaaa !important;
        }

        /* DROPDOWN ITEM */
        .dark .dropdown-item {
            color: #e0e0e0 !important;
        }

        .dark .dropdown-item:hover,
        .dark .dropdown-item:focus {
            background-color: #3c3c3c !important;
            color: #fff !important;
        }

        /* BUTTONS */
        .dark .btn-outline-secondary {
            color: #ffffff;
            border-color: #666;
        }

        .dark .btn-outline-secondary:hover {
            background-color: #444;
            border-color: #666;
        }

        /* BADGES, ACCENTS */
        .dark .badge.bg-danger {
            background-color: #dc3545 !important;
        }

        /* CARD WRAPPER IF NEEDED */
        .dark .scroll-x>.card-wrapper,
        .dark .card2-wrapper {
            background-color: #2c2c2c;
        }

        /* SCROLLBAR (optional) */
        .dark ::-webkit-scrollbar {
            width: 8px;
            height: 6px;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #444;
            border-radius: 3px;
        }

        /* FOOTER: hide on mobile */
        @media (max-width: 575.98px) {
            footer {
                display: none !important;
            }
        }
    </style>


</head>

<body class="position-relative">

    @include('Customer.layouts.navbar')
    @include('Customer.layouts.sidebar')

    <main class="container-fluid p-3">@yield('content')</main>

    @include('Customer.layouts.bottomnav')


    @include('Customer.layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            const ov = document.getElementById('sidebarBackdrop');
            if (ov) {
                ov.classList.toggle('show');
                return;
            }
            const el = document.getElementById('sidebar');
            if (el) {
                let o = bootstrap.Offcanvas.getInstance(el);
                if (!o) {
                    o = new bootstrap.Offcanvas(el);
                }
                o.toggle();
            }
        }
        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('theme') === 'dark') {
                document.body.classList.add('dark');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>

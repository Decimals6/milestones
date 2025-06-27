<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Customer') | BellFresh</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        .dark .navbar,
        .dark .dropdown-menu,
        .dark .offcanvas,
        .dark .card,
        .dark .bg-white,
        .dark .form-control{background:#1e1e1e!important;color:#f1f1f1!important}
        .dark .dropdown-item{color:#f1f1f1!important}
        .dark .form-control::placeholder{color:#bcbcbc!important}

        .dark .btn-outline-secondary{color:#fff;border-color:#6c757d}
        .dark .btn-outline-secondary:hover{background:#495057}
    </style>
</head>
<body class="position-relative">

@include('Customer.layouts.navbar')
@include('Customer.layouts.sidebar')

<main class="container-fluid p-3">@yield('content')</main>

@include('Customer.layouts.bottomnav')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function toggleSidebar(){
    const ov=document.getElementById('sidebarBackdrop');
    if(ov){
        ov.classList.toggle('show');
        return;
    }
    const el=document.getElementById('sidebar');
    if(el){
        let o=bootstrap.Offcanvas.getInstance(el);
        if(!o){o=new bootstrap.Offcanvas(el);}
        o.toggle();
    }
}
document.addEventListener('DOMContentLoaded',()=>{
    if(localStorage.getItem('theme')==='dark'){document.body.classList.add('dark');}
});
</script>

@stack('scripts')
</body>
</html>

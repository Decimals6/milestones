<nav class="navbar navbar-expand-lg px-3 py-2 border-bottom bg-white dark:bg-dark shadow-sm position-relative">
    <div class="container-fluid d-flex justify-content-between align-items-center">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center text-danger" href="#">
            <img src="https://picsum.photos/32" alt="Logo" class="me-2 rounded-circle" height="32">
            <strong>eFood</strong>
        </a>

        <!-- Categories (desktop only) -->
        <div class="dropdown d-none d-md-block me-3">
            <button class="btn btn-outline-secondary dropdown-toggle dark:bg-dark dark:text-white" type="button" data-bs-toggle="dropdown">
                Categories
            </button>
            <ul class="dropdown-menu dark:bg-dark">
                @foreach (['Set Menu', 'Hot Item', 'Biriyani', 'Drinks', 'Pizza', 'Sandwich', 'Burger'] as $cat)
                    <li><a class="dropdown-item dark:text-white" href="#">{{ $cat }}</a></li>
                @endforeach
            </ul>
        </div>

        <!-- Search -->
        <form class="d-none d-md-flex mx-auto w-50">
            <div class="input-group">
                <span class="input-group-text bg-white dark:bg-secondary border-end-0">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0 dark:bg-dark dark:text-light" placeholder="Are you hungry?">
            </div>
        </form>

        <!-- Icons -->
        <div class="d-flex align-items-center gap-3">

            <!-- Wishlist -->
            <div class="position-relative d-none d-md-block">
                <i class="bi bi-heart fs-5"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge bg-danger">0</span>
            </div>

            <!-- Cart -->
            <div class="position-relative d-none d-md-block">
                <i class="bi bi-basket fs-5"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge bg-danger">0</span>
            </div>

            <!-- Profile -->
            <i class="bi bi-person fs-5 d-none d-md-block"></i>

            <!-- Sidebar toggle (both mobile and desktop) -->
            <button class="btn btn-outline-secondary" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>

            <!-- Darkmode toggle -->
            <button class="btn btn-outline-secondary" id="themeToggle">
                <i class="bi bi-brightness-high"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Search -->
    <div class="container d-md-none mt-2">
        <div class="input-group">
            <span class="input-group-text bg-white dark:bg-secondary border-end-0">
                <i class="bi bi-search text-muted"></i>
            </span>
            <input type="text" class="form-control border-start-0 dark:bg-dark dark:text-light" placeholder="Are you hungry?">
        </div>
    </div>
</nav>




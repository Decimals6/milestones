<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('admin.food.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.food.index') }}">
                <i class="ti-agenda menu-icon"></i>
                <span class="menu-title">Menu</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('admin.category.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.category.index') }}">
                <i class="ti-menu-alt menu-icon"></i>
                <span class="menu-title">Category</span>
            </a>
        </li>
    </ul>
</nav>
<!-- partial -->


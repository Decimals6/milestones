<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->routeIs('admin.page.dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.page.dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('admin.page.foods') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.page.foods') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Menu</span>
            </a>
        </li>
    </ul>
</nav>
<!-- partial -->

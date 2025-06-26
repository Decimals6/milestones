<div id="sidebar" class="position-fixed top-0 end-0 bg-white dark:bg-dark shadow p-3 d-none"
     style="width: 300px; height: 100vh; z-index: 1050; overflow-y: auto;">
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
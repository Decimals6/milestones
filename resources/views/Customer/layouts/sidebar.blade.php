<aside class="bg-white shadow-sm border-end" style="width: 230px;">
    <div class="list-group list-group-flush pt-3">
        <a href="{{ route('customer.home') }}" class="list-group-item list-group-item-action {{ request()->is('customer/home') ? 'active text-white bg-primary' : 'text-dark' }}">
            <i class="bi bi-house-door me-2"></i> Beranda
        </a>
        <a href="#" class="list-group-item list-group-item-action text-dark">
            <i class="bi bi-list-ul me-2"></i> Menu
        </a>
        <a href="#" class="list-group-item list-group-item-action text-dark">
            <i class="bi bi-cart me-2"></i> Keranjang
        </a>
        <a href="#" class="list-group-item list-group-item-action text-dark">
            <i class="bi bi-credit-card me-2"></i> Checkout
        </a>
        <a href="{{ route('customer.profile') }}" class="list-group-item list-group-item-action text-dark">
            <i class="bi bi-person me-2"></i> Profil
        </a>
    </div>
</aside>


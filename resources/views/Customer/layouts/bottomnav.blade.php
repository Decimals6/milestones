<nav class="navbar navbar-light bg-white dark:bg-dark fixed-bottom border-top d-md-none">
    <div class="container d-flex justify-content-around">
        @include('Customer.components.icon-button', ['icon'=>'house','label'=>'Home'])
        @include('Customer.components.icon-button', ['icon'=>'heart','label'=>'Wishlist','badge'=>0])
        @include('Customer.components.icon-button', ['icon'=>'basket','label'=>'Cart','badge'=>2])
        @include('Customer.components.icon-button', ['icon'=>'person','label'=>'Profile'])
        <a class="text-center text-decoration-none dark:text-light" onclick="toggleSidebar()">
            <i class="bi bi-list fs-4"></i><br><small>Menu</small>
        </a>
    </div>
</nav>

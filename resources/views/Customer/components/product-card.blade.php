{{-- resources/views/components/product-card-grid.blade.php --}}
@props([
    'image'   => 'https://picsum.photos/seed/grid/600/400',
    'title'   => 'Product',
    'price'   => 0,
    'rating'  => 4.5,
    'fav'     => false,
    'off'     => null,
    'soldOut' => false
])

<style>
    .pg-card{border-radius:1.25rem;transition:.25s ease}
    .pg-img{height:170px;object-fit:cover;border-radius:1.25rem 1.25rem 0 0;transition:filter .25s}
    .pg-card:hover        {box-shadow:0 1rem 2rem rgba(0,0,0,.12);transform:translateY(-6px)}
    .pg-card:hover .pg-img{filter:brightness(.8)}
    .pg-btn{
        background:#e63946;
        color:#fff;
        border:none;
        border-radius:50rem;
        width:88%;
        margin:0 auto;
        box-shadow:0 6px 16px rgba(230,57,70,.35);
        transition:background .2s,color .2s,transform .2s
    }
    .pg-btn:hover        {background:#ffffff;color:#e63946;transform:scale(1.05)}
    .dark .pg-card       {background:#1e1e1e}
    .dark .pg-card:hover {box-shadow:0 1rem 2rem rgba(0,0,0,.5)}
    .dark .pg-img        {filter:brightness(.85)}
    .dark .pg-card:hover .pg-img{filter:brightness(.7)}
    .dark .pg-btn:hover  {background:#2a2a2a;color:#fff}
</style>

<div class="card pg-card bg-white dark:bg-dark text-body dark:text-light border-0 h-100">

    <div class="position-relative">
        <img src="{{ $image }}" class="w-100 pg-img" alt="{{ $title }}">
        @isset($off)
            <span class="badge bg-danger rounded-pill position-absolute top-0 start-0 m-2 px-3">{{ $off }} % OFF</span>
        @endisset
        @if($soldOut)
            <span class="badge bg-danger position-absolute top-50 start-50 translate-middle px-4">Not&nbsp;Available</span>
        @endif
        <button class="btn btn-light btn-sm position-absolute top-0 end-0 m-2 rounded-circle">
            <i class="bi bi-heart{{ $fav ? '-fill text-danger' : '' }}"></i>
        </button>
    </div>

    <div class="p-3">
        <h6 class="fw-semibold mb-1 text-truncate">{{ $title }}</h6>
        <div class="d-flex justify-content-between align-items-center small mb-3">
            <span class="text-warning"><i class="bi bi-star-fill me-1"></i>{{ number_format($rating,1) }}</span>
            <span class="fw-bold text-danger">Rp{{ number_format($price,0,',','.') }}</span>
        </div>
        <button class="btn pg-btn d-flex align-items-center justify-content-center gap-1 py-1">
            <i class="bi bi-plus-circle"></i> Add
        </button>
    </div>
</div>

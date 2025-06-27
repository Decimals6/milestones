{{-- resources/views/components/product-card-horizontal.blade.php --}}
@props([
    'image'   => 'https://picsum.photos/seed/horizontal/600/400',
    'title'   => 'Product',
    'price'   => 0,
    'rating'  => 4.4,
    'fav'     => false,
    'off'     => null,
    'soldOut' => false
])

<style>
    .ph-card{border-radius:1.25rem;transition:transform .25s,box-shadow .25s,background .25s}
    .ph-img{width:140px;height:100%;object-fit:cover;border-radius:1.25rem 0 0 1.25rem;transition:filter .25s}
    .ph-btn{
        background:#e63946;color:#fff;border:none;border-radius:50rem;
        box-shadow:0 6px 16px rgba(230,57,70,.35);transition:background .2s,color .2s,transform .2s
    }
    .ph-btn:hover{background:#ffffff;color:#000;transform:scale(1.05)}

    .ph-card:hover{box-shadow:0 .75rem 1.5rem rgba(0,0,0,.12);transform:translateY(-4px);background:#f8f9fa}
    .ph-card:hover .ph-img{filter:brightness(.8)}
    .ph-card:hover .ph-title,.ph-card:hover .ph-price{color:#212529}

    .dark .ph-card{background:#1e1e1e}
    .dark .ph-img{filter:brightness(.85)}
    .dark .ph-card:hover{
        box-shadow:0 .75rem 1.5rem rgba(0,0,0,.5);
        background:#1a1a1a
    }
    .dark .ph-card:hover .ph-img{filter:brightness(.7)}
    .dark .ph-card:hover .ph-title,
    .dark .ph-card:hover .ph-price{color:#f1f1f1}
    .dark .ph-btn:hover{background:#2a2a2a;color:#fff}
</style>

<div class="card ph-card d-flex flex-row border-0 text-body dark:text-light">

    <div class="position-relative">
        <img src="{{ $image }}" class="ph-img" alt="{{ $title }}">
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

    <div class="flex-grow-1 p-3 d-flex flex-column justify-content-between">
        <div>
            <h6 class="fw-semibold mb-1 ph-title text-truncate">{{ $title }}</h6>
            <div class="d-flex align-items-center small gap-2 mb-2">
                <span class="text-warning"><i class="bi bi-star-fill me-1"></i>{{ number_format($rating,1) }}</span>
                <span class="fw-bold text-danger ph-price">Rp{{ number_format($price,0,',','.') }}</span>
            </div>
        </div>
        <button class="btn ph-btn align-self-start px-4 py-1 d-flex align-items-center gap-1">
            <i class="bi bi-plus-circle"></i> Add
        </button>
    </div>
</div>

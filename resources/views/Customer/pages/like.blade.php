@extends('Customer.layouts.app')
@section('title','Favourite')

@section('content')
<style>
    .fav-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .fav-back {
        display: none;
        border: none;
        background: transparent;
        font-size: 1.25rem;
        color: #333;
    }

    @media (max-width: 768px) {
        .fav-back {
            display: inline-block;
        }

        .fav-header h4 {
            font-size: 1.25rem;
        }
    }

    .fav-empty {
        padding: 4rem 0;
        text-align: center;
    }

    .fav-empty i {
        font-size: 3rem;
        color: #dc3545;
    }

    .fav-empty h6 {
        margin-top: 1rem;
        font-weight: 600;
    }

    .dark .fav-back {
        color: #f1f1f1;
    }

    .dark .fav-empty i {
        color: #f88;
    }

    .dark .fav-empty p {
        color: #ccc;
    }

    @media (max-width: 768px) {
        .fav-grid-mobile {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
    }

    .pb-safe {
        padding-bottom: 5rem; /* space for bottom nav */
    }
</style>

<div class="container pb-safe" style="max-width: 1140px;">
    {{-- === Title & Back (mobile) === --}}
    <div class="fav-header">
        <button class="fav-back" onclick="history.back()"><i class="bi bi-arrow-left"></i></button>
        <h4 class="fw-bold m-0">My Favourites</h4>
    </div>

    @php
        $favourites = [
            ['Pizza Supreme',     'https://picsum.photos/seed/pizzaSupreme/400/300', 42000, 4.5],
            ['Crispy Chicken',    'https://picsum.photos/seed/crispyChicken/400/300',27000, 4.2],
            ['Chizza Meal',       'https://picsum.photos/seed/chizzaFav/400/300',     25800, 4.0],
            ['Beef Burger',       'https://picsum.photos/seed/beefBurger/400/300',    7200,  3.8],
        ];
    @endphp

    @if(count($favourites) > 0)

        {{-- Desktop Grid --}}
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-4 d-none d-md-flex">
            @foreach($favourites as [$name,$img,$price,$rating])
                <div class="col">
                    @include('Customer.components.product-card', [
                        'image'=>$img, 'title'=>$name, 'price'=>$price,
                        'rating'=>$rating, 'isFav'=>true
                    ])
                </div>
            @endforeach
        </div>

        {{-- Mobile Grid --}}
        <div class="fav-grid-mobile d-md-none">
            @foreach($favourites as [$name,$img,$price,$rating])
                <div>
                    @include('Customer.components.product-card', [
                        'image'=>$img, 'title'=>$name, 'price'=>$price,
                        'rating'=>$rating, 'isFav'=>true
                    ])
                </div>
            @endforeach
        </div>

    @else
        {{-- Fallback --}}
        <div class="fav-empty">
            <i class="bi bi-heartbreak"></i>
            <h6>Belum ada item favorit</h6>
            <p class="text-muted">Produk yang kamu suka akan muncul di sini.</p>
        </div>
    @endif
</div>
@endsection

@extends('Customer.layouts.app')
@section('title','Favourite')

@section('content')
<div class="container">

    {{-- =====  TITLE  ================================================= --}}
    <h4 class="fw-bold mb-4">My Favourites</h4>

    {{-- =====  DATA (contoh statis)  ================================== --}}
    @php
        $favourites = [
            ['Pizza Supreme',     'https://picsum.photos/seed/pizzaSupreme/400/300', 42000, 4.5],
            ['Crispy Chicken',    'https://picsum.photos/seed/crispyChicken/400/300',27000, 4.2],
            ['Chizza Meal',       'https://picsum.photos/seed/chizzaFav/400/300',     25800, 4.0],
            ['Beef Burger',       'https://picsum.photos/seed/beefBurger/400/300',    7200,  3.8],
        ];
    @endphp

    {{-- =====  LIST (selalu tampil penuh)  ============================ --}}
    @if(count($favourites) > 0)

        {{-- • Desktop : grid --}}
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-4 d-none d-md-flex">
            @foreach($favourites as [$name,$img,$price,$rating])
                <div class="col">
                    @include('Customer.components.product-card',[
                        'image'=>$img,'title'=>$name,'price'=>$price,
                        'rating'=>$rating,'isFav'=>true
                    ])
                </div>
            @endforeach
        </div>

        {{-- • Mobile : horizontal scroll --}}
        <div class="d-flex gap-3 overflow-auto d-md-none pb-2">
            @foreach($favourites as [$name,$img,$price,$rating])
                <div style="min-width:65%;max-width:65%;">
                    @include('Customer.components.product-card',[
                        'image'=>$img,'title'=>$name,'price'=>$price,
                        'rating'=>$rating,'isFav'=>true
                    ])
                </div>
            @endforeach
        </div>

    @else
        {{-- fallback bila array kosong --}}
        <div class="text-center py-5">
            <i class="bi bi-heartbreak fs-1 text-danger"></i>
            <h6 class="mt-3">Belum ada item favorit</h6>
            <p class="text-muted">Produk yang kamu suka akan muncul di sini.</p>
        </div>
    @endif

</div>
@endsection

@extends('Customer.layouts.app')
@section('title','Home')

@section('content')
<div class="container">

    {{-- === 1. TOP SECTION (Banner + Discoveries) ========================== --}}
    <div class="row g-3 mb-4">

        {{-- Banner / Today’s Specials ------------------------------------------------ --}}
        <div class="col-12 col-md-8">
            <h5 class="fw-bold text-light-emphasis dark:text-white mb-2">Today’s Specials</h5>

            <div id="bannerCarousel" class="carousel slide rounded-3 overflow-hidden shadow-sm" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach([
                        'https://picsum.photos/seed/pizza/1200/300',
                        'https://picsum.photos/seed/burger/1200/300',
                        'https://picsum.photos/seed/salad/1200/300'
                    ] as $i=>$img)
                        <div class="carousel-item {{ $i==0?'active':'' }}">
                            <img src="{{ $img }}" class="d-block w-100" alt="Banner {{ $i+1 }}" loading="lazy">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>

        {{-- Dish Discoveries --------------------------------------------------------- --}}
        <div class="col-12 col-md-4">
            <div class="p-3 rounded-3 bg-light dark:bg-dark shadow-sm h-100">
                <h5 class="fw-bold text-center mb-3">Dish Discoveries</h5>
                <div class="row row-cols-4 row-cols-md-3 g-2 text-center">
                    @foreach(['Set Menu','Hot Item','Biriyani','Drinks','Pizza','Sandwich','Burger','Dessert'] as $cat)
                        <div class="col">
                            <div class="rounded-3 bg-white dark:bg-black p-2 h-100 d-flex flex-column align-items-center justify-content-center">
                                <img src="https://picsum.photos/seed/{{ Str::slug($cat) }}/60/60"
                                     class="rounded-2 mb-1" alt="{{ $cat }}" loading="lazy">
                                <small class="fw-medium text-dark dark:text-white">{{ $cat }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    {{-- === 2. LOCAL EATS ========================================================= --}}
    <section class="mb-4">

        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="fw-bold mb-0">Local Eats</h5>
            <a href="#" class="small text-decoration-none text-primary">Discover All</a>
        </div>

        {{-- 2a •  GRID (desktop) ---------------------------------------------------- --}}
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-3 d-none d-md-flex">
            @foreach([
                ['Zinger & Pop','https://picsum.photos/seed/zinger/400/300',100,4.0,false],
                ['Popcorn Rice Bowl','https://picsum.photos/seed/rice/400/300',130,4.2,false],
                ['Chizza Meal','https://picsum.photos/seed/chizza/400/300',258,4.0,true],
                ['Spicy Burger','https://picsum.photos/seed/spicy/400/300',72,3.0,true],
            ] as [$name,$img,$price,$rating,$sale])
                <div class="col">
                    @include('Customer.components.product-card',[
                        'image'=>$img,'title'=>$name,'price'=>$price,
                        'rating'=>$rating,'sale'=>$sale,'isFav'=>false
                    ])
                </div>
            @endforeach
        </div>

        {{-- 2b •  HORIZONTAL SCROLL (mobile) -------------------------------------- --}}
        <div class="d-flex gap-3 overflow-auto d-md-none pb-2">
            @foreach([
                ['Zinger & Pop','https://picsum.photos/seed/zinger/400/300',100,4.0,false],
                ['Popcorn Rice Bowl','https://picsum.photos/seed/rice/400/300',130,4.2,false],
                ['Chizza Meal','https://picsum.photos/seed/chizza/400/300',258,4.0,true],
                ['Spicy Burger','https://picsum.photos/seed/spicy/400/300',72,3.0,true],
            ] as [$name,$img,$price,$rating,$sale])
                <div style="min-width: 60%; max-width: 60%;">
                    @include('Customer.components.product-card',[
                        'image'=>$img,'title'=>$name,'price'=>$price,
                        'rating'=>$rating,'sale'=>$sale,'isFav'=>false
                    ])
                </div>
            @endforeach
        </div>

    </section>

</div>
@endsection

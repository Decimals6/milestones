@extends('Customer.layouts.app')
@section('title', 'Home')

@section('content')
    <style>
        .section-title {
            font-weight: 700;
            margin-bottom: .5rem
        }

        .special-box {
            border-radius: 1.25rem;
            overflow: hidden
        }

        .discover-box {
            background: #f4f8ff;
            border-radius: 1.25rem;
            padding: 1.5rem
        }

        .discover-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: .35rem;
            width: 85px
        }

        .discover-item img {
            width: 68px;
            height: 68px;
            object-fit: cover;
            border-radius: .75rem
        }

        .dark .discover-box {
            background: #232323;
            border: 1px solid #3a3a3a
        }

        .dark .discover-item small {
            color: #f1f1f1
        }

        /* horizontal scroll container */
        .scroll-x {
            display: flex;
            gap: 1.25rem;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            padding-bottom: .5rem
        }

        .scroll-x::-webkit-scrollbar {
            display: none
        }

        .scroll-x {
            -ms-overflow-style: none;
            scrollbar-width: none
        }

        .scroll-x>* {
            scroll-snap-align: start;
            flex-shrink: 0
        }

        /* preserve full size card */
        .card-wrapper,
        .card2-wrapper {
            width: auto;
            max-width: none
        }

        /* fallback for mobile */
        @media (max-width:575.98px) {
            .discover-box {
                padding: 1rem
            }

            .discover-item {
                width: 64px
            }

            .discover-item img {
                width: 54px;
                height: 54px
            }

            .scroll-x>.card-wrapper,
            .scroll-x>.card2-wrapper {
                flex: 0 0 85%;
                max-width: 85%
            }
        }

        .chef-wrap {
            background: #fff6f6;
            border-radius: 1.25rem;
            padding: 1.5rem;
            position: relative
        }

        .dark .chef-wrap {
            background: #2b2b2b
        }

        .chef-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 42px;
            height: 42px;
            border: 2px solid #e63946;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: #e63946;
            cursor: pointer;
            transition: .2s
        }

        .chef-arrow:hover {
            background: #e63946;
            color: #fff
        }

        .chef-arrow.prev {
            left: -21px
        }

        .chef-arrow.next {
            right: -21px
        }

        .discover-main {
            border-radius: 1.25rem;
            background: linear-gradient(135deg, #fefefe, #e9f5ff);
            padding: 2rem 1rem;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .discover-main:hover {
            background: linear-gradient(135deg, #d6f0ff, #fff);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
        }

        .dark .discover-main {
            background: #2a2a2a;
            border-color: #444;
        }

        .icon-circle {
            width: 72px;
            height: 72px;
            background: #e63946;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <div class="container">
        <div class="row g-4 mb-5">
            <div class="col-12 col-lg-8">
                <h5 class="section-title">Today’s Specials</h5>
                <div id="specialCarousel" class="carousel slide special-box" data-bs-touch="true" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach (['pizza', 'burger', 'salad', 'coffee'] as $k => $seed)
                            <div class="carousel-item {{ !$k ? 'active' : '' }}">
                                <img src="https://picsum.photos/seed/{{ $seed }}/1200/350" class="d-block w-100"
                                    loading="lazy">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <a href="{{ route('discover') }}"
                    class="discover-main d-flex flex-column align-items-center justify-content-center text-center text-decoration-none h-100">
                    <div class="icon-circle mb-3">
                        <i class="bi bi-egg-fried fs-1"></i>
                    </div>
                    <h5 class="fw-bold mb-1">Custom Dish Builder</h5>
                    <p class="text-muted small mb-0">Create your healthy and tasty meal your way</p>
                </a>
            </div>
        </div>

        <section class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="section-title">Local Eats</h5>
                <a href="#" class="small fw-semibold text-primary text-decoration-none">Discover All</a>
            </div>
            <div class="scroll-x">
                @foreach ([['Zinger & Pop', 'zinger', 100, 4.0, 0, false], ['Popcorn Rice Bowl', 'rice', 130, 4.2, 0, false], ['Chizza Meal', 'chizza', 258, 4.1, 14, false], ['Spicy Burger', 'spicy', 72, 4.0, 40, false]] as $item)
                    <div class="card-wrapper">
                        <x-product-card :image="'https://picsum.photos/seed/' . $item[1] . '/400/300'" :title="$item[0]" :price="$item[2]" :rating="$item[3]"
                            :off="$item[4] ?: null" :sold-out="$item[5]" />
                    </div>
                @endforeach
            </div>
        </section>

        <section class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="section-title">Flavorful Set</h5>
                <a href="#" class="small fw-semibold text-primary text-decoration-none">Discover All</a>
            </div>
            <div class="scroll-x">
                @foreach ([['Popcorn Rice Bowl', 'rice', 130, 4.2, 0, false], ['Zinger & Pop', 'zinger', 100, 4.0, 0, false], ['Set Menu 2', 'set', 240, 4.4, 0, false], ['Special Cold Coffee', 'coffee', 171, 5.0, 0, false]] as $item)
                    <div class="card2-wrapper">
                        <x-product-card-2 :image="'https://picsum.photos/seed/' . $item[1] . '/500/350'" :title="$item[0]" :price="$item[2]" :rating="$item[3]"
                            :off="$item[4] ?: null" :sold-out="$item[5]" />
                    </div>
                @endforeach
            </div>
        </section>

        <section class="mb-5 position-relative">
            <h5 class="section-title text-center mb-3">Chef's Recommendation <i class="bi bi-emoji-smile"></i></h5>
            <div class="chef-wrap">
                <div class="scroll-x" id="chefScroll">
                    @foreach ([['Beef Biriyani With Spice', 'biriyani', 300, 4.6, 20, true], ['Ice Cream cremmm', 'ice', 270, 4.9, 30, false], ['Special Cold Coffee', 'coffee', 171, 4.4, 5, false], ['Cheese Sandwich', 'sandwich', 110, 4.1, 0, false]] as $item)
                        <div class="card-wrapper">
                            <x-product-card :image="'https://picsum.photos/seed/' . $item[1] . '/500/350'" :title="$item[0]" :price="$item[2]" :rating="$item[3]"
                                :off="$item[4] ?: null" :sold-out="$item[5]" />
                        </div>
                    @endforeach
                </div>
                <div class="chef-arrow prev" onclick="chefNavigate(-1)"><i class="bi bi-arrow-left"></i></div>
                <div class="chef-arrow next" onclick="chefNavigate(1)"><i class="bi bi-arrow-right"></i></div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        const chefScroll = document.getElementById('chefScroll');

        function chefNavigate(dir) {
            chefScroll.scrollBy({
                left: chefScroll.clientWidth * 0.8 * dir,
                behavior: 'smooth'
            });
        }
        new bootstrap.Carousel('#specialCarousel', {
            interval: 4000,
            ride: 'carousel'
        });
    </script>
@endpush

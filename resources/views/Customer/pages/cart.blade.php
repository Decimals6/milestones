@extends('Customer.layouts.app')
@section('title','Cart')

@section('content')
<div class="container">

    {{-- =====  TITLE & CLEAR-ALL  ========================================= --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">My Cart</h4>
        <a href="#" class="btn btn-sm btn-outline-danger">Clear All</a>
    </div>

    {{-- =====  CART ITEMS  ================================================= --}}
    @php
        $items = [
            ['Spicy Chicken&nbsp;Burger', 'https://picsum.photos/seed/spicyBurgerCart/400/300', 28000, 2, true],
            ['Beef Bowl Large',           'https://picsum.photos/seed/beefBowl/400/300',        39000, 1, false],
        ];
    @endphp

    @if(count($items))
        <div class="row g-3 mb-4">

            @foreach($items as [$title,$img,$price,$qty,$fav])
                <div class="col-12">
                    <div class="card shadow-sm border-0 p-3 flex-row align-items-center bg-white dark:bg-dark">
                        <img src="{{ $img }}" alt="{{ $title }}" class="rounded"
                             style="width:80px;height:80px;object-fit:cover" loading="lazy">

                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold mb-1 text-dark dark:text-white">{!! $title !!}</h6>
                            <div class="small text-muted">Rp{{ number_format($price,0,',','.') }} × {{ $qty }}</div>
                            <div class="fw-semibold text-success mt-1">
                                Rp{{ number_format($price*$qty,0,',','.') }}
                            </div>
                        </div>

                        <div class="ms-3 text-end">
                            <i class="bi {{ $fav?'bi-heart-fill text-danger':'bi-heart' }}"></i><br>
                            <a href="#" class="small text-danger">Remove</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    @else
        {{-- EMPTY STATE ---------------------------------------------------- --}}
        <div class="text-center py-5">
            <img src="https://picsum.photos/seed/emptyCart/200/160" alt="Empty" class="opacity-50 mb-4" loading="lazy">
            <h5 class="fw-bold mb-2">Your cart is empty!</h5>
            <p class="text-muted">Please add some items from the menu</p>
            <a href="{{ route('home.index') }}" class="btn btn-danger px-4">Explore Menu</a>
        </div>
    @endif


    {{-- =====  COUPON & ESTIMATE  ========================================= --}}
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <label class="form-label">Have a Coupon?</label>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter coupon code">
                <button class="btn btn-outline-primary">Apply</button>
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label">Delivery Estimate</label>
            <div class="bg-light dark:bg-black rounded p-3">
                <div class="small text-muted">Arrives in 30-45 min</div>
                <div class="fw-bold text-success mt-1">Free Delivery</div>
            </div>
        </div>
    </div>

    {{-- =====  TOTAL & CHECKOUT  ========================================== --}}
    <div class="d-flex justify-content-between align-items-center p-3 border-top border-bottom">
        <h5 class="mb-0">Total</h5>
        <h5 class="text-danger mb-0">
            Rp{{ number_format( collect($items)->sum(fn($i)=>$i[2]*$i[3]), 0, ',', '.') }}
        </h5>
    </div>

    <div class="mt-4 text-end">
        <a href="{{ route('checkout') }}" class="btn btn-lg btn-danger rounded-pill px-5">
            Proceed to Checkout
        </a>
    </div>

</div>
@endsection

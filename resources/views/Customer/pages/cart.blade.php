@extends('Customer.layouts.app')
@section('title', 'Cart')

@section('content')
    @php
        $items = [
            [
                'title' => 'Spicy Chicken Burger',
                'img' => 'https://picsum.photos/seed/spicyBurgerCart/400/300',
                'price' => 28000,
                'qty' => 2,
                'cal' => 600,
                'toppings' => ['Cheese', 'Lettuce'],
                'side' => 'Fries',
                'drink' => 'Iced Tea',
            ],
            [
                'title' => 'Beef Bowl Large',
                'img' => 'https://picsum.photos/seed/beefBowl/400/300',
                'price' => 39000,
                'qty' => 1,
                'cal' => 550,
                'toppings' => ['Onion', 'Sauce'],
                'side' => null,
                'drink' => null,
            ],
        ];
        $baseTotal = collect($items)->sum(fn($i) => $i['price'] * $i['qty']);
        $tax = $baseTotal * 0.1;
        $fee = 5000;
        $totalCal = collect($items)->sum(fn($i) => $i['cal'] * $i['qty']);
    @endphp

    <style>
        :root {
            --bg-box-light: #ffffff;
            --bg-box-dark: #2b2b2b;
            --text-main-light: #333;
            --text-main-dark: #eee;
            --text-secondary-light: #666;
            --text-secondary-dark: #bbb;
        }

        body {
            color: var(--text-main-light);
        }

        body.dark {
            color: var(--text-main-dark);
        }

        .cart-container {
            max-width: 1140px;
            margin: auto;
            padding-bottom: 6rem
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem
        }

        .btn-back {
            display: none;
            background: transparent;
            border: none;
            font-size: 1.3rem;
            color: var(--text-main-light);
        }

        body.dark .btn-back {
            color: var(--text-main-dark);
        }

        @media(max-width:768px) {
            .btn-back {
                display: inline-block;
            }
        }

        .card-box {
            background: var(--bg-box-light);
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            color: var(--text-main-light);
        }

        body.dark .card-box {
            background: var(--bg-box-dark);
            color: var(--text-main-dark);
        }

        .cart-item {
            display: flex;
            gap: 1rem;
            align-items: center
        }

        .cart-img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 0.75rem
        }

        .cart-info {
            flex: 1
        }

        .cart-info h6 {
            margin: 0;
            font-weight: 600;
            color: inherit
        }

        .cart-info .detail {
            font-size: 0.875rem;
            color: var(--text-secondary-light)
        }

        body.dark .cart-info .detail {
            color: var(--text-secondary-dark)
        }

        .cart-info .total {
            font-weight: 700;
            color: #d32f2f;
            margin-top: 0.4rem
        }

        .cart-action {
            text-align: right
        }

        .cart-action i {
            font-size: 1.2rem;
            cursor: pointer;
            color: #d32f2f;
            display: block;
            margin-bottom: 6px
        }

        .tip-btns {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
            flex-wrap: wrap
        }

        .tip-btns button {
            flex: 1;
            min-width: 100px;
            padding: 0.75rem;
            border: none;
            border-radius: 0.75rem;
            background: #f5f5f5;
            text-align: center;
            font-weight: 600;
            color: #222;
        }

        .tip-btns button.active {
            background: #4caf50;
            color: #fff
        }

        body.dark .tip-btns button {
            background: #3a3a3a;
            color: #ccc
        }

        body.dark .tip-btns button.active {
            background: #43a047;
            color: #fff
        }

        .summary-line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            color: var(--text-secondary-light);
        }

        body.dark .summary-line {
            color: var(--text-secondary-dark);
        }

        .summary-total {
            font-size: 1.2rem;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            color: var(--text-main-light);
        }

        body.dark .summary-total {
            color: var(--text-main-dark);
        }

        .checkout-row {
            display: flex;
            justify-content: flex-end;
            margin-top: 2rem
        }

        .btn-checkout {
            padding: 0.75rem 2rem;
            border-radius: 2rem;
            font-size: 1rem
        }

        @media(max-width:768px) {
            .checkout-row {
                flex-direction: column;
                align-items: stretch
            }

            .btn-checkout {
                width: 100%;
                margin-top: 1rem
            }
        }

        .order-mode label {
            display: inline-block;
            margin-right: 1rem;
            font-weight: 500;
            color: var(--text-main-light);
        }

        body.dark .order-mode label {
            color: var(--text-main-dark);
        }

        .text-muted {
            color: var(--text-secondary-light);
        }

        body.dark .text-muted {
            color: var(--text-secondary-dark);
        }
    </style>


    <div class="container cart-container">
        <div class="cart-header">
            <div><button class="btn-back" onclick="history.back()"><i class="bi bi-arrow-left"></i></button>
                <h4 class="d-inline-block ms-2 fw-bold">My Cart</h4>
            </div>
            <a href="#" class="btn btn-outline-danger">Clear Cart</a>
        </div>

        <div class="card-box">
            <h6 class="mb-3">How would you like to order?</h6>
            <div class="order-mode mb-2">
                <label><input type="radio" name="mode" value="dine" checked onchange="togglePlace()"> Dine In</label>
                <label><input type="radio" name="mode" value="takeout" onchange="togglePlace()"> Takeout</label>
            </div>
        </div>

        <div class="card-box place-card" id="placeOptions">
            <h6 class="mb-3">Where would you like to sit?</h6>
            <div class="order-mode">
                <label><input type="radio" name="place" value="indoor" checked> Indoor</label>
                <label><input type="radio" name="place" value="outdoor"> Outdoor</label>
                <label><input type="radio" name="place" value="bar"> Bar</label>
            </div>
        </div>

        @foreach ($items as $item)
            <div class="card-box">
                <div class="cart-item">
                    <img src="{{ $item['img'] }}" class="cart-img">
                    <div class="cart-info">
                        <h6>{{ $item['title'] }} ×{{ $item['qty'] }}</h6>
                        <div class="detail">Rp{{ number_format($item['price'], 0, ',', '.') }} · {{ $item['cal'] }} cal</div>
                        @if ($item['toppings'])
                            <div class="detail">Toppings: {{ implode(', ', $item['toppings']) }}</div>
                        @endif
                        @if ($item['side'])
                            <div class="detail">Side: {{ $item['side'] }}</div>
                        @endif
                        @if ($item['drink'])
                            <div class="detail">Drink: {{ $item['drink'] }}</div>
                        @endif
                        <div class="total">Rp{{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</div>
                    </div>
                    <div class="cart-action">
                        <i class="bi bi-heart"></i>
                        <a href="#" class="small text-danger">Remove</a>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="card-box">
            <h6 class="mb-1">Estimated time to prepare</h6>
            <p class="small" style="color: var(--text-secondary-light)" class="text-muted dark:text-secondary-dark">~15 minutes</p>
        </div>

        <div class="card-box">
            <label class="form-label fw-semibold">Tip to support staff</label>
            <div class="tip-btns">
                <button onclick="setTip(5)">5%<br>Rp{{ number_format($baseTotal * 0.05, 0, ',', '.') }}</button>
                <button onclick="setTip(10)">10%<br>Rp{{ number_format($baseTotal * 0.1, 0, ',', '.') }}</button>
                <button onclick="setTip(15)">15%<br>Rp{{ number_format($baseTotal * 0.15, 0, ',', '.') }}</button>
                <button onclick="setTip(0)" class="active">No Tip</button>
            </div>
        </div>

        <div class="card-box">
            <div class="summary-line">
                <div>Subtotal</div>
                <div>Rp{{ number_format($baseTotal, 0, ',', '.') }}</div>
            </div>
            <div class="summary-line">
                <div>Tax (10%)</div>
                <div>Rp{{ number_format($tax, 0, ',', '.') }}</div>
            </div>
            <div class="summary-line">
                <div>Service Fee</div>
                <div>Rp{{ number_format($fee, 0, ',', '.') }}</div>
            </div>
            <div class="summary-line">
                <div>Calories</div>
                <div>{{ $totalCal }} cal</div>
            </div>
            <div class="summary-line summary-total">
                <div>Total</div>
                <div id="totalAmount">Rp{{ number_format($baseTotal + $tax + $fee, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="checkout-row">
            <button class="btn btn-danger btn-checkout"
                onclick="window.location.href='{{ route('checkout') }}'">Checkout</button>
        </div>
    </div>

    <script>
        let base = {{ $baseTotal }};
        let tax = {{ $tax }};
        let fee = {{ $fee }};
        let tip = 0;

        function setTip(percent) {
            tip = Math.round(base * percent / 100);
            document.querySelectorAll('.tip-btns button').forEach(b => b.classList.remove('active'));
            event.target.classList.add('active');
            updateTotal();
        }

        function updateTotal() {
            let total = base + tax + fee + tip;
            document.getElementById('totalAmount').innerText = 'Rp' + total.toLocaleString('id-ID');
        }

        function togglePlace() {
            let dine = document.querySelector('input[name="mode"]:checked').value;
            document.getElementById('placeOptions').style.display = dine === 'dine' ? 'block' : 'none';
        }

        togglePlace();
    </script>
@endsection

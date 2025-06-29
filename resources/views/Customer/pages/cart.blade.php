@extends('Customer.layouts.app')
@section('title','Cart')

@section('content')
@php
  $items = [
    [
      'title' => 'Spicy Chicken Burger',
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
@endphp

<style>
  .cart-container { max-width: 1140px; margin: auto; padding-bottom: 6rem }
  .cart-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
  .cart-header h4 { margin: 0 }
  .btn-back { display: none; background: transparent; border: none; font-size: 1.3rem; }
  @media(max-width: 768px) { .btn-back { display: inline-block; } }

  .cart-item { display: flex; gap: 1rem; background: #fff; border-radius: 1rem; padding: 1rem; margin-bottom: 1.25rem; box-shadow: 0 1px 6px rgba(0,0,0,0.07); }
  .cart-item.dark { background: #1f1f1f; box-shadow: none; }
  .cart-img { width: 90px; height: 90px; border-radius: 0.75rem; object-fit: cover; }
  .cart-info { flex: 1 }
  .cart-info h6 { margin: 0 0 .3rem; font-weight: 600 }
  .cart-info .detail { font-size: 0.875rem; color: #666; }
  .cart-info .total { margin-top: 0.4rem; font-weight: 700; color: #d32f2f }

  .cart-action { text-align: right }
  .cart-action a { color: #d32f2f; font-size: 0.875rem; }

  .cart-section { background: #f9f9f9; padding: 1rem; border-radius: 1rem; margin-bottom: 1.5rem }
  .cart-section.dark { background: #2c2c2c }
  .cart-section h6 { margin-bottom: 0.5rem; font-weight: 600 }

  .tip-btns { display: flex; gap: 0.5rem; margin: .5rem 0 1rem }
  .tip-btns button { flex: 1; padding: .5rem; font-size: 0.9rem; background: #eee; border: none; border-radius: 0.5rem; transition: 0.2s }
  .tip-btns button.active { background: #4caf50; color: #fff }

  .summary { border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; padding: 1rem 0; font-weight: bold; font-size: 1.2rem; display: flex; justify-content: space-between }
  .summary.dark { border-color: #444 }

  .checkout-row { display: flex; justify-content: space-between; margin-top: 1.5rem }
  .btn-checkout { padding: 0.75rem 2rem; border-radius: 2rem; font-size: 1rem }
  @media(max-width: 768px) {
    .checkout-row { flex-direction: column-reverse; gap: 1rem }
    .btn-checkout { width: 100% }
  }

  body.dark .cart-item { background: #1f1f1f; color: #fff }
  body.dark .cart-info .detail { color: #bbb }
  body.dark .cart-section { background: #2c2c2c }
  body.dark .tip-btns button { background: #444; color: #ddd }
  body.dark .tip-btns button.active { background: #388e3c }
</style>

<div class="container cart-container">
  <div class="cart-header">
    <div>
      <button class="btn-back" onclick="history.back()"><i class="bi bi-arrow-left"></i></button>
      <h4 class="fw-bold d-inline-block ms-2">Checkout</h4>
    </div>
    <a href="#" class="btn btn-outline-danger">Clear Cart</a>
  </div>

  <div class="cart-section">
    <h6>How would you like to order?</h6>
    <label class="me-3"><input type="radio" name="mode" value="dine" checked> Dine In</label>
    <label><input type="radio" name="mode" value="takeout"> Takeout</label>
  </div>

  @foreach($items as $item)
    <div class="cart-item">
      <img src="{{ $item['img'] }}" class="cart-img" alt="">
      <div class="cart-info">
        <h6>{!! $item['title'] !!} ×{{ $item['qty'] }}</h6>
        <div class="detail">Rp{{ number_format($item['price'],0,',','.') }} · {{ $item['cal'] }} cal</div>
        @if($item['toppings'])<div class="detail">Toppings: {{ implode(', ', $item['toppings']) }}</div>@endif
        @if($item['side'])<div class="detail">Side: {{ $item['side'] }}</div>@endif
        @if($item['drink'])<div class="detail">Drink: {{ $item['drink'] }}</div>@endif
        <div class="total">Rp{{ number_format($item['price'] * $item['qty'],0,',','.') }}</div>
      </div>
      <div class="cart-action">
        <a href="#">Remove</a>
      </div>
    </div>
  @endforeach

  <div class="cart-section">
    <h6>Estimated time to prepare</h6>
    <p class="text-muted small">~15 minutes</p>
  </div>

  <div>
    <label class="form-label fw-semibold">Tip to support staff</label>
    <div class="tip-btns">
      <button onclick="setTip(5)">5%<br>Rp{{ number_format($total = collect($items)->sum(fn($i)=>$i['price']*$i['qty']) * 0.05,0,',','.') }}</button>
      <button onclick="setTip(10)">10%<br>Rp{{ number_format($total * 0.10,0,',','.') }}</button>
      <button onclick="setTip(15)">15%<br>Rp{{ number_format($total * 0.15,0,',','.') }}</button>
      <button onclick="setTip(0)" class="active">No Tip</button>
    </div>
  </div>

  <div class="summary">
    <div>Total</div>
    <div id="totalAmount">Rp{{ number_format($total,0,',','.') }}</div>
  </div>

  <div class="checkout-row">
    <button class="btn btn-danger btn-checkout" onclick="confirmCheckout()">Checkout</button>
  </div>

  <script>
    let baseTotal = {{ $total }};
    let selectedTip = 0;

    function setTip(percent) {
      selectedTip = percent;
      document.querySelectorAll('.tip-btns button').forEach(b => b.classList.remove('active'));
      event.target.classList.add('active');
      updateTotal();
    }

    function updateTotal() {
      const tipAmount = Math.round(baseTotal * selectedTip / 100);
      document.getElementById('totalAmount').innerText = 'Rp' + (baseTotal + tipAmount).toLocaleString('id-ID');
    }

    function confirmCheckout() {
      Swal.fire({
        icon: 'success',
        title: 'Order Placed!',
        text: `Total: Rp${(baseTotal + Math.round(baseTotal*selectedTip/100)).toLocaleString('id-ID')}`,
        background: document.body.classList.contains('dark') ? '#2c2c2c' : '#fff',
        color: document.body.classList.contains('dark') ? '#fff' : '#000',
        confirmButtonColor: '#d32f2f'
      }).then(() => window.location.href = "{{ route('home.index') }}");
    }
  </script>
  @endsection
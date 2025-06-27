@extends('Customer.layouts.app')
@section('title','Checkout')

@section('content')
<div class="container">

    {{-- =====  TITLE  =================================================== --}}
    <h4 class="fw-bold mb-4">Checkout</h4>

    {{-- =====  SHIPPING ADDRESS  ======================================= --}}
    <div class="mb-4 p-3 border rounded shadow-sm bg-white dark:bg-dark">
        <h6 class="mb-2">Shipping Address</h6>
        <select class="form-select">
            <option selected>Jl. Mawar No. 123 – Jakarta</option>
            <option>Jl. Melati No. 99 – Bandung</option>
        </select>
    </div>

    {{-- =====  PAYMENT METHOD  ========================================= --}}
    <div class="mb-4 p-3 border rounded shadow-sm bg-white dark:bg-dark">
        <h6 class="mb-2">Payment Method</h6>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="payMethod" id="cod" checked>
            <label class="form-check-label" for="cod">Cash on Delivery (COD)</label>
        </div>
        <div class="form-check mt-2">
            <input class="form-check-input" type="radio" name="payMethod" id="wallet">
            <label class="form-check-label" for="wallet">E-Wallet</label>
        </div>
    </div>

    {{-- =====  ORDER SUMMARY  ========================================== --}}
    <div class="mb-4 p-3 border rounded shadow-sm bg-white dark:bg-dark">
        <h6 class="mb-3">Order Summary</h6>
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between bg-transparent">
                Sub-total <span>Rp67 000</span>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-transparent">
                Delivery <span>Rp0</span>
            </li>
            <li class="list-group-item d-flex justify-content-between fw-bold bg-transparent">
                Total <span class="text-danger">Rp67 000</span>
            </li>
        </ul>
    </div>

    {{-- =====  NOTES  =================================================== --}}
    <div class="mb-4">
        <label class="form-label">Note for Courier</label>
        <textarea class="form-control" rows="3"
                  placeholder="e.g. Please leave it at the lobby…"></textarea>
    </div>

    {{-- =====  CONFIRM BUTTON  ========================================= --}}
    <div class="text-end">
        <button class="btn btn-lg btn-success px-5">
            <i class="bi bi-check-circle me-1"></i> Confirm Order
        </button>
    </div>

</div>
@endsection

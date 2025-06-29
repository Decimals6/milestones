@extends('Customer.layouts.app')
@section('title', 'Discover Your Meal')

@section('content')
<div class="container py-4">
  <h3 class="fw-bold mb-4 text-center">Build Your Custom Meal</h3>

  <form>
    <div class="row g-4 mb-4">
      <div class="col-md-6">
        <label class="form-label fw-semibold">Choose Base Dish</label>
        <select class="form-select">
          <option>Grilled Chicken Salad</option>
          <option>Healthy Bowl</option>
          <option>Vegan Wrap</option>
          <option>Fruit Smoothie</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label fw-semibold">Select Size</label>
        <div class="btn-group w-100" role="group">
          <input type="radio" class="btn-check" name="size" id="size-sm" autocomplete="off" checked>
          <label class="btn btn-outline-primary" for="size-sm">Small</label>

          <input type="radio" class="btn-check" name="size" id="size-md" autocomplete="off">
          <label class="btn btn-outline-primary" for="size-md">Medium</label>

          <input type="radio" class="btn-check" name="size" id="size-lg" autocomplete="off">
          <label class="btn btn-outline-primary" for="size-lg">Large</label>
        </div>
      </div>
    </div>

    <div class="row g-4 mb-4">
      <div class="col-md-6">
        <label class="form-label fw-semibold">Choose Toppings</label>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="top1">
          <label class="form-check-label" for="top1">Chia Seeds</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="top2">
          <label class="form-check-label" for="top2">Tofu Cubes</label>
        </div>
      </div>

      <div class="col-md-6">
        <label class="form-label fw-semibold">Choose Side</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="side" id="side1">
          <label class="form-check-label" for="side1">Soup</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="side" id="side2">
          <label class="form-check-label" for="side2">Fresh Juice</label>
        </div>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label fw-semibold">Additional Notes</label>
      <textarea class="form-control" rows="3" placeholder="Any preferences or allergies?"></textarea>
    </div>

    <div class="d-grid">
      <button type="submit" class="btn btn-success btn-lg">Add to Cart</button>
    </div>
  </form>
</div>
@endsection

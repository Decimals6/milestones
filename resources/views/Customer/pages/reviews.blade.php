@extends('Customer.layouts.app')

@section('title', 'Reviews')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">Customer Reviews</h2>

  {{-- Rating Summary --}}
  @php
  // fallback kalau $reviews null
  $reviews = $reviews ?? [];

  $total = count($reviews);
  $avg = $total ? round(collect($reviews)->avg('rating'), 1) : 0;
  $counts = collect($reviews)->groupBy('rating')->map->count();
@endphp

  <div class="row align-items-center mb-4">
    <div class="col-auto">
      <h1 class="display-1">{{ $avg }}</h1>
      <div class="fs-3 text-warning">
        <i class="bi bi-star-fill"></i>
      </div>
      <div class="text-muted">{{ $total }} review{{ $total > 1 ? 's' : '' }}</div>
    </div>
    <div class="col">
      @for($r = 5; $r >= 1; $r--)
        @php
          $cnt = $counts->get($r, 0);
          $pct = $total ? round($cnt / $total * 100) : 0;
        @endphp
        <div class="d-flex align-items-center mb-2">
          <span class="me-2 text-nowrap">{{ $r }} ⭐</span>
          <div class="progress flex-grow-1 me-2" style="height:6px;">
            <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $pct }}%" aria-valuenow="{{ $pct }}" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <span class="text-muted">{{ $cnt }}</span>
        </div>
      @endfor
    </div>
  </div>

  {{-- Detailed Reviews --}}
  <div class="list-group">
    @forelse($reviews as $rev)
      <div class="list-group-item mb-3 p-4 shadow-sm rounded">
        <div class="d-flex justify-content-between mb-2">
          <strong>{{ $rev['user'] ?? 'Anonymous' }}</strong>
          <small class="text-muted">{{ \Carbon\Carbon::parse($rev['date'])->translatedFormat('d M Y') }}</small>
        </div>
        <div class="mb-2">
          @for($i = 1; $i <= 5; $i++)
            <i class="bi bi-star{{ $i <= $rev['rating'] ? '-fill text-warning' : '' }}"></i>
          @endfor
        </div>
        @if(!empty($rev['comment']))
          <p class="mb-0">{{ $rev['comment'] }}</p>
        @endif
      </div>
    @empty
      <div class="text-center py-5 text-muted">
        <i class="bi bi-chat-dots fs-1 mb-3"></i>
        <div>No reviews yet. Be the first to review!</div>
      </div>
    @endforelse
  </div>
</div>
@endsection

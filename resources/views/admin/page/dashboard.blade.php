@extends('admin.index')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">

    {{-- Quick Actions --}}
    <div class="row mb-4">
      <div class="col-sm-12 text-right">
        <a href="{{ route('admin.food.create') }}" class="btn btn-primary mx-1"><i class="mdi mdi-food-plus"></i> Add Food</a>
        <a href="{{ route('admin.category.create') }}" class="btn btn-success mx-1"><i class="mdi mdi-format-list-bulleted"></i> Add Category</a>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-warning mx-1"><i class="mdi mdi-cart-arrow-down"></i> View Orders</a>
      </div>
    </div>

    {{-- Stat Cards --}}
    <div class="row">
      @php
        $cards = [
          ['label'=>'Total Foods',      'value'=>$totalFoods,      'bg'=>'bg-primary','icon'=>'mdi-food'],
          ['label'=>'Total Categories', 'value'=>$totalCategories, 'bg'=>'bg-success','icon'=>'mdi-shape'],
          ['label'=>'Total Orders',     'value'=>$totalOrders,     'bg'=>'bg-warning','icon'=>'mdi-cart-outline'],
          ['label'=>'Total Revenue',    'value'=>'Rp'.number_format($totalRevenue,0,',','.'), 'bg'=>'bg-danger','icon'=>'mdi-cash-multiple'],
        ];
      @endphp

      @foreach($cards as $c)
      <div class="col-lg-3 col-sm-6 grid-margin stretch-card">
        <div class="card {{ $c['bg'] }} text-white shadow">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <p class="mb-1 text-uppercase">{{ $c['label'] }}</p>
              <h3 class="mb-0">{{ $c['value'] }}</h3>
            </div>
            <i class="mdi {{ $c['icon'] }} display-3 opacity-75"></i>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    {{-- Charts --}}
    <div class="row">
      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title">Revenue Bulanan</h5>
            <canvas id="revenueChart" height="150"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-6 grid-margin stretch-card">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title">Top 5 Toppings</h5>
            <canvas id="toppingsChart" height="150"></canvas>
          </div>
        </div>
      </div>
    </div>

    {{-- Trending Foods --}}
    <div class="row mt-4">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title">Top 5 Foods</h5>
            <canvas id="trendingChart" height="100"></canvas>
          </div>
        </div>
      </div>
    </div>

    {{-- Recent Orders --}}
    <div class="row mt-4">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card shadow">
          <div class="card-body">
            <h5 class="card-title">Recent Orders</h5>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th><th>User</th><th>Total</th><th>Status</th><th>Time</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($recentOrders as $o)
                  <tr>
                    <td>{{ $o->id }}</td>
                    <td>{{ $o->user->name ?? 'Guest' }}</td>
                    <td>Rp{{ number_format($o->total_Price,0,',','.') }}</td>
                    <td>{{ ucfirst(strtolower($o->status)) }}</td>
                    <td>{{ \Carbon\Carbon::parse($o->order_Time)->format('d M Y H:i') }}</td>
                  </tr>
                  @endforeach
                  @if($recentOrders->isEmpty())
                  <tr><td colspan="5" class="text-center">No recent orders.</td></tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Chart 1: Revenue
  new Chart(document.getElementById('revenueChart'), {
    type:'line',
    data:{
      labels: @json($months),
      datasets:[{
        label:'Revenue',
        data:@json($monthlyRevenue),
        borderColor:'#7367F0', fill:false, tension:0.3
      }]
    },
    options:{scales:{y:{beginAtZero:true}}, plugins:{legend:{display:false}}}
  });

  // Chart 2: Toppings
  new Chart(document.getElementById('toppingsChart'), {
    type:'doughnut',
    data:{
      labels:@json($topToppings->pluck('name')),
      datasets:[{data:@json($topToppings->pluck('total')), backgroundColor:['#FF6384','#36A2EB','#FFCE56','#4BC0C0','#9966FF']}]
    },
    options:{plugins:{legend:{position:'right'}}}
  });

  // Chart 3: Trending Foods
  new Chart(document.getElementById('trendingChart'), {
    type:'bar',
    data:{
      labels:@json($trendingFoods->pluck('name')),
      datasets:[{label:'Jumlah Pemesanan', data:@json($trendingFoods->pluck('total')), backgroundColor:'#FFA726'}]
    },
    options:{scales:{y:{beginAtZero:true}}}
  });
</script>
@endpush

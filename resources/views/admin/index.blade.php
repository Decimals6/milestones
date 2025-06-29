@extends('admin.layouts.master')
@section('title', 'Dashboard')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Dashboard</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data</li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-12">
                <div class="alert bg-primary text-white p-4 rounded">
                    <h4 class="mb-0">Hi {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}, welcome back!
                    </h4>
                    <small>Today is: {{ now()->isoFormat('dddd, D MMMM Y') }}</small>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ([['Total Users', $totalUsers, 'fa-users', 'primary'], ['Total Orders', $totalOrders, 'fa-shopping-cart', 'secondary'], ['Total Sales', '$' . number_format($totalSales, 2), 'fa-dollar-sign', 'success'], ['Orders This Week', $ordersThisWeek, 'fa-calendar-day', 'warning'], ['Pending Orders', $pendingOrders, 'fa-hourglass-half', 'danger'], ['Avg Order Value', '$' . number_format($avgOrderValue, 2), 'fa-chart-line', 'info']] as [$title, $value, $icon, $color])
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-{{ $color }} shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">{{ $title }}</div>
                                    <div class="h5 mb-0 font-weight-bold">{{ $value }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas {{ $icon }} fa-2x text-{{ $color }}"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">Orders This Week</div>
                    <div class="card-body">
                        <canvas id="weeklyOrdersChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">Recent Orders</div>
                    <div class="card-body p-0">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentOrders as $order)
                                    <tr>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->user ? $order->user->first_name . ' ' . $order->user->last_name : '-' }}
                                        </td>
                                        <td>{{ ucfirst($order->status) }}</td>
                                        <td>${{ number_format($order->total_amount, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('weeklyOrdersChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($orderDays) !!},
                datasets: [{
                    label: 'Orders',
                    data: {!! json_encode($orderCounts) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.6)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
@endsection

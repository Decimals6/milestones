@extends('admin.layouts.master')
@section('title', 'Orders Data')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Orders</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data</li>
    <li class="breadcrumb-item active">Orders</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3>Order List</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Order Number</th>
                                        <th>User</th>
                                        <th>Payment Method</th>
                                        <th>Order Type</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $order->order_number }}</td>
                                            <td>{{ $order->user ? $order->user->first_name . ' ' . $order->user->last_name : '-' }}
                                            </td>
                                            <td>{{ $order->payment->name ?? '-' }}</td>
                                            <td>{{ ucfirst($order->order_type) }}</td>
                                            <td>{{ ucfirst($order->status) }}</td>
                                            <td>$ {{ number_format($order->total_amount, 2, ',', '.') }}</td>
                                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                <a href="{{ route('orders.show', $order->id) }}"
                                                    class="text-info">
                                                    <i class="icon-list"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
@endsection

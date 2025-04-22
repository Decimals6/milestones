@extends('admin.index')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">

    <div class="row mb-3">
      <div class="col">
        <h4 class="card-title">Order Management</h4>
      </div>
    </div>

    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5 class="mb-0"><i class="mdi mdi-cart-outline"></i> All Orders</h5>
              <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-secondary">
                <i class="mdi mdi-view-dashboard"></i> Dashboard
              </a>
            </div>
            <div class="table-responsive">
              <table class="table table-hover">
                {{-- <thead class="thead-light"> --}}
                  <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Time</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($orders as $o)
                  <tr>
                    <td>{{ $o->id }}</td>
                    <td>
                      <i class="mdi mdi-account-circle-outline"></i>
                      {{ $o->user->name ?? 'Guest' }}
                    </td>
                    <td>
                      <i class="mdi mdi-cash-multiple"></i>
                      Rp{{ number_format($o->details->sum('price'),0,',','.') }}
                    </td>
                    <td>
                      @php
                        $badge = match(strtolower($o->status)) {
                          'completed'   => 'badge-success',
                          'ready'       => 'badge-info',
                          'inprogress'  => 'badge-warning',
                          default       => 'badge-secondary',
                        };
                      @endphp
                      <label class="badge {{ $badge }}">
                        {{ ucfirst(strtolower($o->status)) }}
                      </label>
                    </td>
                    <td>
                      <i class="mdi mdi-clock-outline"></i>
                      {{ \Carbon\Carbon::parse($o->order_Time)->format('d M Y H:i') }}
                    </td>
                    <td>
                      <a href="{{ route('admin.orders.show', $o) }}"
                         class="btn btn-sm btn-primary">
                        <i class="mdi mdi-eye-outline"></i> View
                      </a>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="6" class="text-center py-4">
                      <i class="mdi mdi-clipboard-text-outline mdi-24px mb-2"></i><br>
                      No orders found.
                    </td>
                  </tr>
                  @endforelse
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

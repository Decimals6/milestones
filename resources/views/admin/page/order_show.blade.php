@extends('admin.index')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">

    <div class="row mb-3">
      <div class="col">
        <h4 class="card-title">
          <i class="mdi mdi-file-document-box-outline"></i>
          Order #{{ $order->id }} Details
        </h4>
      </div>
      <div class="col text-right">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-secondary">
          <i class="mdi mdi-arrow-left"></i> Back to Orders
        </a>
      </div>
    </div>

    {{-- Header Info --}}
    <div class="row">
      @php
        $info = [
          ['lbl'=>'User',   'val'=>$order->user->name ?? 'Guest', 'icon'=>'mdi-account'],
          ['lbl'=>'Time',   'val'=>\Carbon\Carbon::parse($order->order_Time)->format('d M Y H:i'), 'icon'=>'mdi-clock-outline'],
          ['lbl'=>'Status', 'val'=>ucfirst(strtolower($order->status)), 'icon'=>'mdi-information-outline'],
          ['lbl'=>'Type',   'val'=>ucfirst(strtolower($order->type)), 'icon'=>'mdi-shape'],
        ];
      @endphp
      @foreach($info as $i)
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card border-0 shadow-sm">
          <div class="card-body d-flex align-items-center">
            <i class="mdi {{ $i['icon'] }} mdi-24px mr-3 text-primary"></i>
            <div>
              <small class="text-muted text-uppercase">{{ $i['lbl'] }}</small>
              <p class="mb-0">{{ $i['val'] }}</p>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    {{-- Items & Extras --}}
    <div class="row mt-4">
      <div class="col-12 grid-margin stretch-card">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title mb-3"><i class="mdi mdi-format-list-bulleted"></i> Order Items</h5>
            <div class="table-responsive">
              <table class="table table-striped">
                {{-- <thead class="thead-light"> --}}
                  <tr>
                    <th>Item</th>
                    <th>Notes</th>
                    <th>Price</th>
                    <th>Extras</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($order->details as $d)
                  <tr>
                    <td><i class="mdi mdi-silverware-fork-knife"></i> {{ $d->food->name }}</td>
                    <td>{{ $d->notes ?? '-' }}</td>
                    <td>Rp{{ number_format($d->price,0,',','.') }}</td>
                    <td>
                      @if($d->options->isEmpty())
                        <span class="text-muted">—</span>
                      @else
                        @foreach($d->options as $opt)
                          <label class="badge badge-info">{{ $opt->foodItem->name }}</label>
                        @endforeach
                      @endif
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
</div>
@endsection

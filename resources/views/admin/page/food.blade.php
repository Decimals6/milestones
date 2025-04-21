@extends('admin.index')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Menu Table</h4>
                            <p class="card-description">
                                List Menu
                            </p>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Deskripsi</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($foods as $food)
                                            <tr>
                                                <td>{{ $food->name }}</td>
                                                <td>{{ $food->desc }}</td>
                                                <td>{{ $food->base_price }}</td>
                                                <td><label class="badge badge-success">Active</label></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">Belum ada data makanan.</td>
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

@extends('admin.layouts.master')
@section('title', 'Foods Data')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Foods Data</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Foods Tables</li>
    <li class="breadcrumb-item active">Foods</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Foods Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3>Zero Configuration</h3><span>DataTables has most features enabled by default, so all you need to
                            do to use it with your own tables is to call the construction
                            function:<code>$().DataTable();</code>.</span><span>Searching, ordering and paging goodness will
                            be immediately added to the table, as shown in this example.</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($foods as $food)
                                        <tr>
                                            <td>{{ $food->name }}</td>
                                            <td>Rp {{ number_format($food->base_price, 0, ',', '.') }}</td>
                                            <td>{{ $food->is_active ? 'Yes' : 'No' }}</td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="{{ route('foods.edit', $food->id) }}"><i
                                                                class="icon-pencil-alt"></i></a>
                                                    </li>
                                                    <li class="delete">
                                                        <form action="{{ route('foods.destroy', $food->id) }}"
                                                            method="POST">
                                                            @csrf @method('DELETE')
                                                            <button style="border: none; background: none;" type="submit">
                                                                <i class="icon-trash"></i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Foods Ends-->
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
@endsection

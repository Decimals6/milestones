@extends('admin.index')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Food Menu</h4>
                            <p class="card-description">
                                List of all available food items
                            </p>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($foods as $food)
                                            <tr>
                                                <td>{{ $food->name }}</td>
                                                <td>{{ $food->desc }}</td>
                                                <td>{{ $food->base_price }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-primary btn-icon-text"
                                                        data-toggle="modal" data-target="#categoryModal{{ $food->id }}">
                                                        <i class="ti-file btn-icon-prepend"></i>
                                                        View Categories
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="4">No food data available.</td>
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

    @foreach ($foods as $food)
        <!-- Category Modal -->
        <div class="modal fade" id="categoryModal{{ $food->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalLabel{{ $food->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel{{ $food->id }}">Categories for {{ $food->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($food->categories->count())
                            <ul>
                                @foreach ($food->categories as $category)
                                    <li>{{ $category->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">No categories available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

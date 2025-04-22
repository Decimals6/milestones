@extends('admin.index')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            @if (session('success'))
                <div class="position-fixed" style="top: 1rem; left: 50%; transform: translateX(-50%); z-index: 1055;">
                    <div class="toast bg-success text-white w-auto" role="alert" aria-live="assertive" aria-atomic="true"
                        data-delay="3000">
                        <div class="toast-header bg-success text-white">
                            <strong class="mr-auto">Success</strong>
                            <small>Now</small>
                            <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="toast-body text-center">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Food Menu</h4>
                            <p class="card-description">
                                List of all available food items
                                <button type="button" class="btn btn-outline-primary btn-icon-text" data-toggle="modal"
                                    data-target="#createFoodModal">
                                    <i class="ti-plus btn-icon-prepend"></i>
                                    Add New Food
                                </button>
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

    <!-- Create Food Modal -->
    <div class="modal fade" id="createFoodModal" tabindex="-1" role="dialog" aria-labelledby="createFoodModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.food.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createFoodModalLabel">Add New Food</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="foodName">Name</label>
                            <input type="text" class="form-control" name="name" id="foodName" required>
                        </div>
                        <div class="form-group">
                            <label for="foodDesc">Description</label>
                            <textarea class="form-control" name="desc" id="foodDesc" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="foodPrice">Base Price</label>
                            <input type="number" class="form-control" name="base_price" id="foodPrice" required>
                        </div>
                        <div class="form-group">
                            <label for="categories">Categories</label>
                            <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                                <div class="row">
                                    @foreach ($categories as $category)
                                        <div class="col-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="categories[]"
                                                    value="{{ $category->id }}" id="cat{{ $category->id }}">
                                                <label class="custom-control-label"
                                                    for="cat{{ $category->id }}">{{ $category->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const toastEl = document.querySelector('.toast');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl);
                $('.toast').toast('show');
            }
        });
    </script>
@endsection

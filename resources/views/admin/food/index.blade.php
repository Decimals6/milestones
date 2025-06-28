@extends('admin.layouts.master')
@section('title', 'Foods Data')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Foods Data</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data</li>
    <li class="breadcrumb-item active">Foods</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3>Foods</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createFoodModal">
                                <i class="icon-plus"></i> Add Food
                            </button>

                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Nutrition Info</th>
                                        <th>Active</th>
                                        <th>Categories</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($foods as $food)
                                        <tr id="food-row-{{ $food->id }}">
                                            <td>{{ $food->name }}</td>
                                            <td>$ {{ number_format($food->base_price, 2, ',', '.') }}</td>
                                            <td>{{ $food->description }}</td>
                                            <td>{{ $food->nutrition_info }}</td>
                                            <td>{{ $food->is_active ? 'Yes' : 'No' }}</td>
                                            <td>
                                                <a href="#" class="text-info show-categories-btn"
                                                    data-bs-toggle="modal" data-bs-target="#showCategoriesModal"
                                                    data-json='@json($food->categories->pluck('name'))'>
                                                    <i class="icon-list"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="javascript:void(0)" class="text-success edit-food-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editFoodModal{{ $food->id }}"
                                                            data-id="{{ $food->id }}"
                                                            data-json='@json($food)'>
                                                            <i class="icon-pencil-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li class="delete">
                                                        <a href="javascript:void(0)" class="text-danger delete-food"
                                                            data-id="{{ $food->id }}">
                                                            <i class="icon-trash"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editFoodModal{{ $food->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $food->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form class="edit-food-form" data-id="{{ $food->id }}">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel{{ $food->id }}">
                                                                Edit Food</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label>Name</label>
                                                                <input type="text" name="name" class="form-control"
                                                                    value="{{ $food->name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Base Price</label>
                                                                <input type="number" step="0.01" name="base_price"
                                                                    class="form-control" value="{{ $food->base_price }}"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Description</label>
                                                                <textarea name="description" class="form-control">{{ $food->description }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Nutrition Info</label>
                                                                <textarea name="nutrition_info" class="form-control">{{ $food->nutrition_info }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Categories</label>
                                                                <div class="form-group">
                                                                    @foreach ($categories as $category)
                                                                        <div class="form-check">
                                                                            <label
                                                                                class="form-check-label">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input"
                                                                                    name="category_ids[]"
                                                                                    value="{{ $category->id }}"
                                                                                    id="cat_{{ $category->id }}">{{ $category->name }}</label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="form-check mb-3">
                                                                <label class="form-check-label">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="is_active" value="1"
                                                                        {{ $food->is_active ? 'checked' : '' }}>Active</label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Update</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal Create -->
    <div class="modal fade" id="createFoodModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="createFoodForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Food</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Base Price</label>
                            <input type="number" step="0.01" name="base_price" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Nutrition Info</label>
                            <textarea name="nutrition_info" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Categories</label>
                            <div class="form-group">
                                @foreach ($categories as $category)
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="category_ids[]"
                                                value="{{ $category->id }}"
                                                id="cat_{{ $category->id }}">{{ $category->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-check mb-3">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="is_active"
                                    value="1">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Show Categories Modal -->
    <div class="modal fade" id="showCategoriesModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Categories</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <ul id="categoriesList"></ul>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            });
        </script>
    @endif

    <script>
        // Tampilkan alert sukses setelah reload
        $(document).ready(function() {
            const successMessage = sessionStorage.getItem('foods_success');
            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: successMessage,
                    timer: 2000,
                    showConfirmButton: false
                });
                sessionStorage.removeItem('foods_success');
            }
        });

        // Delete
        $(document).ready(function() {
            const deleteUrl = "{{ route('foods.destroy', ':id') }}";

            $(document).on('click', '.delete-food', function() {
                const foodId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl.replace(':id', foodId),
                            type: 'POST',
                            data: {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                sessionStorage.setItem('foods_success', response
                                    .message || 'Food deleted successfully');
                                location.reload();
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed!',
                                    text: 'Failed to delete food item.'
                                });
                            }
                        });
                    }
                });
            });
        });

        // Edit
        $(document).ready(function() {
            const updateUrl = "{{ route('foods.update', ':id') }}";

            $(document).on('click', '.edit-food-btn', function() {
                const data = $(this).data('json');
                const id = $(this).data('id');
                const modal = $('#editFoodModal' + id);

                modal.find('input[name="name"]').val(data.name);
                modal.find('input[name="base_price"]').val(data.base_price);
                modal.find('textarea[name="description"]').val(data.description);
                modal.find('textarea[name="nutrition_info"]').val(data.nutrition_info);
                modal.find('input[name="is_active"]').prop('checked', data.is_active ? true : false);

                const categoryIds = (data.categories || []).map(cat => cat.id);
                modal.find('input[name="category_ids[]"]').each(function() {
                    const checkbox = $(this);
                    checkbox.prop('checked', categoryIds.includes(parseInt(checkbox.val())));
                });
            });

            $(document).on('submit', '.edit-food-form', function(e) {
                e.preventDefault();

                const form = $(this);
                const foodId = form.data('id');
                const formData = form.serialize() + '&_method=PUT';

                $.ajax({
                    url: updateUrl.replace(':id', foodId),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        sessionStorage.setItem('foods_success', response.message ||
                            'Food updated successfully');
                        location.reload();
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: 'Update failed, please try again.'
                        });
                    }
                });
            });
        });

        // Create
        $('#createFoodForm').on('submit', function(e) {
            e.preventDefault();

            const form = $(this);
            const formData = form.serialize();

            $.ajax({
                url: "{{ route('foods.store') }}",
                method: 'POST',
                data: formData,
                success: function(response) {
                    sessionStorage.setItem('foods_success', response.message ||
                        'Food created successfully');
                    location.reload();
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: 'Create failed, please try again.'
                    });
                }
            });
        });

        $('#createFoodModal').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
        });

        // Show categories list
        $(document).on('click', '.show-categories-btn', function() {
            const categories = $(this).data('json');
            const $list = $('#categoriesList');
            $list.empty();

            $list.append(`<li><strong>Total Categories:</strong> ${categories.length}</li>`);

            if (categories.length === 0) {
                $list.append('<li><em>No categories assigned.</em></li>');
            } else {
                categories.forEach(cat => {
                    $list.append(`<li>${cat}</li>`);
                });
            }
        });
    </script>

@endsection

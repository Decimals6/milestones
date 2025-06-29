@extends('admin.layouts.master')
@section('title', 'Foods Data')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/datatables.css') }}">

    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            font-size: 0;
            width: 100%;
            height: 100%;
            position: absolute;
            right: 0;
            top: 0;
            cursor: pointer;
            z-index: 1;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            position: relative;
            overflow: hidden;
        }
    </style>

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
                                        <th>Image</th>
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
                                                <a href="javascript:void(0)" class="text-info view-image-btn"
                                                    data-bs-toggle="modal" data-bs-target="#imageModal"
                                                    data-image="{{ $food->image_path ? asset('storage/' . $food->image_path) : '' }}"
                                                    data-has-image="{{ $food->image_path ? '1' : '0' }}">
                                                    <i class="icon-image"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="javascript:void(0)" class="text-success edit-food-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editFoodModal{{ $food->id }}"
                                                            data-id="{{ $food->id }}">
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
                                                                <label
                                                                    for="edit-cat-{{ $food->id }}">Categories</label>
                                                                <select name="category_ids[]"
                                                                    id="edit-cat-{{ $food->id }}"
                                                                    class="form-control category-select"
                                                                    multiple="multiple">
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{ $category->id }}"
                                                                            {{ $food->categories->contains($category->id) ? 'selected' : '' }}>
                                                                            {{ $category->name }}
                                                                        </option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Image</label>
                                                                <input type="file" name="image" class="form-control"
                                                                    accept="image/*">
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

    <!-- Modal View Image -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title">Food Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="imageWrapper">
                        <img id="imagePreview" class="img-fluid d-none mb-3" alt="Food Image">
                        <p id="noImageText" class="text-white">No image available</p>

                        <button type="button" id="deleteImageBtn" class="btn btn-danger d-none" data-id="">
                            <i class="icon-trash"></i> Delete Image
                        </button>
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
                            <select name="category_ids[]" multiple="multiple" id="category-select"
                                class="form-control select2">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
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

    <script>
        $(document).ready(function() {
            $('#category-select').select2({
                placeholder: "Select categories",
                allowClear: true
            });
            $('.category-select').each(function() {
                $(this).select2({
                    dropdownParent: $(this).closest('.modal'),
                    placeholder: "Select categories",
                    width: '100%'
                });
            });

        });
        $(document).on('click', '.view-image-btn', function() {
            const hasImage = $(this).data('has-image') == 1;
            const imageUrl = $(this).data('image');
            const foodId = $(this).closest('tr').attr('id').replace('food-row-', '');

            if (hasImage) {
                $('#imagePreview').attr('src', imageUrl).removeClass('d-none');
                $('#noImageText').addClass('d-none');
                $('#deleteImageBtn').removeClass('d-none').attr('data-id', foodId);
            } else {
                $('#imagePreview').addClass('d-none').attr('src', '');
                $('#noImageText').removeClass('d-none');
                $('#deleteImageBtn').addClass('d-none').attr('data-id', '');
            }
        });
    </script>

    <script id="food-json-{{ $food->id }}" type="application/json">
        {!! json_encode([
            'id' => $food->id,
            'name' => $food->name,
            'base_price' => $food->base_price,
            'description' => $food->description,
            'nutrition_info' => $food->nutrition_info,
            'is_active' => $food->is_active,
            'categories' => $food->categories->pluck('id')->toArray(),
        ]) !!}
    </script>


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

        // Delete food
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
                const foodId = $(this).data('id');
                const modal = $('#editFoodModal' + foodId);
                const data = JSON.parse(document.getElementById('food-json-' + foodId).textContent);

                modal.find('input[name="name"]').val(data.name);
                modal.find('input[name="base_price"]').val(data.base_price);
                modal.find('textarea[name="description"]').val(data.description);
                modal.find('textarea[name="nutrition_info"]').val(data.nutrition_info);
                modal.find('input[name="is_active"]').prop('checked', data.is_active);

                $('#editModal-{{ $food->id }}').on('shown.bs.modal', function() {
                    $(this).find('.category-select').select2({
                        dropdownParent: $(this)
                    });
                });

            });

            $('.modal').on('hidden.bs.modal', function() {
                $(this).find('.category-select').val(null).trigger('change');
            });

            $(document).on('submit', '.edit-food-form', function(e) {
                e.preventDefault();
                const form = this;
                const foodId = $(form).data('id');
                const formData = new FormData(form);
                formData.append('_method', 'PUT');

                $.ajax({
                    url: updateUrl.replace(':id', foodId),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
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
            const form = this;
            const formData = new FormData(form);

            $.ajax({
                url: "{{ route('foods.store') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
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
            const form = $(this).find('form')[0];
            form.reset();
            $(form).find('select[name="category_ids[]"]').val(null).trigger('change');
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

        // delete image
        $(document).on('click', '#deleteImageBtn', function() {
            const foodId = $(this).data('id');

            Swal.fire({
                title: 'Delete image?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('foods.update', ':id') }}".replace(':id', foodId),
                        method: 'POST',
                        data: {
                            _method: 'PATCH',
                            _token: '{{ csrf_token() }}',
                            delete_image: true
                        },
                        success: function(res) {
                            sessionStorage.setItem('foods_success', res.message ||
                                'Image deleted successfully');
                            location.reload();
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed',
                                text: 'Failed to delete image.'
                            });
                        }
                    });
                }
            });
        });
    </script>

@endsection

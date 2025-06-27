@extends('admin.layouts.master')
@section('title', 'Category Data')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Categories</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Data</li>
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
    <style>
        .action li {
            display: inline-block;
            margin-right: 8px;
        }

        .action li:last-child {
            margin-right: 0;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3>Categories</h3>
                        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                            <i class="icon-plus"></i> Add Category
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Foods</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $cat)
                                        <tr id="cat-row-{{ $cat->id }}">
                                            <td>{{ $cat->name }}</td>
                                            <td>{{ $cat->description }}</td>
                                            <td>
                                                <a href="#" class="text-info show-foods-btn" data-bs-toggle="modal"
                                                    data-bs-target="#showFoodsModal"
                                                    data-json='@json($cat->foods->pluck('name', 'id'))'>
                                                    <i class="icon-list"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="#" class="text-success edit-cat-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editCatModal{{ $cat->id }}"
                                                            data-id="{{ $cat->id }}"
                                                            data-json='@json($cat)'>
                                                            <i class="icon-pencil-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li class="delete">
                                                        <a href="javascript:void(0)" class="text-danger delete-cat"
                                                            data-id="{{ $cat->id }}">
                                                            <i class="icon-trash"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editCatModal{{ $cat->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <form class="edit-cat-form" data-id="{{ $cat->id }}">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Category</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label>Name</label>
                                                                <input type="text" name="name" class="form-control"
                                                                    value="{{ $cat->name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Description</label>
                                                                <textarea name="description" class="form-control">{{ $cat->description }}</textarea>
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="createCategoryForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control"
                                required></div>
                        <div class="mb-3"><label>Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Show Foods Modal -->
    <div class="modal fade" id="showFoodsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Category Foods List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="max-height:400px; overflow-y:auto">
                    <ul id="foodsList"></ul>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>

    <script>
        $(function() {
            const alertSuccess = (msg) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: msg,
                    timer: 2000,
                    showConfirmButton: false
                });
            }

            const alertFail = (msg = 'Something went wrong') => {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed!',
                    text: msg
                });
            }

            // Create
            $('#createCategoryForm').on('submit', function(e) {
                e.preventDefault();
                $.post("{{ route('categories.store') }}", $(this).serialize())
                    .done(res => {
                        sessionStorage.setItem('category_success', res.message);
                        location.reload();
                    })
                    .fail(() => alertFail());
            });

            // Tampilkan alert sukses setelah reload
            const msg = sessionStorage.getItem('category_success');
            if (msg) {
                alertSuccess(msg);
                sessionStorage.removeItem('category_success');
            }

            // Edit: show
            $('body').on('click', '.edit-cat-btn', function() {
                const data = $(this).data('json');
                const id = $(this).data('id');
                const modal = $('#editCatModal' + id);
                modal.find('[name=name]').val(data.name);
                modal.find('[name=description]').val(data.description);
            });

            // Update
            $('body').on('submit', '.edit-cat-form', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                $.ajax({
                    url: "{{ url('admin/categories') }}/" + id,
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: function(res) {
                        sessionStorage.setItem('category_success', res.message);
                        location.reload();
                    },
                    error: () => alertFail()
                });
            });

            // Delete
            $('body').on('click', '.delete-cat', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action can't be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("{{ url('admin/categories') }}/" + id, {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            })
                            .done(res => {
                                sessionStorage.setItem('category_success', res.message);
                                location.reload();
                            })
                            .fail(() => alertFail());
                    }
                });
            });

            // Show foods list
            $(document).on('click', '.show-foods-btn', function() {
                const foods = $(this).data('json');
                const $list = $('#foodsList');
                $list.empty();

                $list.append(`<li><strong>Total Foods:</strong> ${Object.keys(foods).length}</li>`);

                if (Object.keys(foods).length === 0) {
                    $list.append('<li><em>No foods available.</em></li>');
                } else {
                    Object.entries(foods).forEach(([id, name]) => {
                        $list.append(`<li>${name}</li>`);
                    });
                }
            });
        });
    </script>
@endsection

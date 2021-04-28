@extends('dashboard')
@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('categories.create') }}" type="button" class="btn btn-success btn-sm mb-3">Create Category</a>
    </div>
    <div class="card">
        @if($categories->count() > 0)
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('categories.edit', $category->id) }}"
                               role="button">Edit</a>
                            <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $category->id }})">Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h5 class="text-center mt-2">No Categories Yet!</h5>
        @endif
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" method="POST" id="deleteCategoryForm">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <p class="text-center text-bold">
                            Are you sure you want to delete this Category?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No, Go Back</button>
                        <button type="submit" class="btn btn-danger btn-sm">Yes, Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function handleDelete(id) {
            var form = document.getElementById('deleteCategoryForm');
            form.action = '/categories/' + id;
            $('#deleteModal').modal('show');
        }
    </script>
@endsection

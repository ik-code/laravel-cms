@extends('dashboard')
@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('posts.create') }}" type="button" class="btn btn-success btn-sm mb-3">Create Post</a>
    </div>
    <div class="card">
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Image</th>
                <th scope="col">Post Title</th>
                <th scope="col">Edit/Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <th scope="row"><img src="{{ asset( 'storage/'. $post->image ) }}" width="50px"  alt="{{ $post->title }}"></th>
                    <td>{{ $post->title }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('categories.edit', $post->id) }}"
                           role="button">Edit</a>
                        <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $post->id }})">Trash</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" method="POST" id="deletePostForm">
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
                            Are you sure you want to delete this Post?
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
            var form  = document.getElementById('deletePostForm');
            form.action = '/posts/'+id;
            $('#deleteModal').modal('show');
        }
    </script>
@endsection


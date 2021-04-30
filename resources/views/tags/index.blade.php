@extends('dashboard')
@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('tags.create') }}" type="button" class="btn btn-success btn-sm mb-3">Create Tag</a>
    </div>
    <div class="card" style="overflow-x:auto;">
        @if($tags->count() > 0)
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tag Name</th>
                    <th scope="col">Posts Count</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <th scope="row">{{ $tag->id }}</th>
                        <td>{{ $tag->name }}</td>
                        <td>0</td>
                        <td class="d-flex">
                            <a class="btn btn-info btn-sm mr-2" href="{{ route('tags.edit', $tag->id) }}"
                               role="button">Edit</a>
                            <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $tag->id }})">Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h5 class="text-center mt-2">No Tags Yet!</h5>
        @endif
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" method="POST" id="deleteTagForm">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Tag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <p class="text-center text-bold">
                            Are you sure you want to delete this Tag?
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
            var form = document.getElementById('deleteTagForm');
            form.action = '/tags/' + id;
            $('#deleteModal').modal('show');
        }
    </script>
@endsection

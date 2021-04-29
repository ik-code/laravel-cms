@extends('dashboard')
@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('posts.create') }}" type="button" class="btn btn-success btn-sm mb-3">Create Post</a>
    </div>
    <div class="card">
        @if($posts->count() > 0)
            <h5 class="text-center mt-2">{{ $trashed ? 'Trashed Post List' : 'Post List' }}</h5>
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Post Title</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <th scope="row"><img src="{{ asset( 'storage/'. $post->image ) }}" width="50px"
                                             alt="{{ $post->title }}"></th>
                        <td>{{ $post->title }}</td>
                        <td class="d-flex">
                            @if( ! $post->trashed() )
                                <a class="btn btn-info btn-sm mr-2" href="{{ route('posts.edit', $post->id) }}"
                                   role="button">Edit</a>
                            @endif
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-danger btn-sm">{{ $post->trashed() ? 'Delete' : 'Trash' }}</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <h5 class="text-center mt-2">No Posts Yet!</h5>
        @endif
    </div>
@endsection


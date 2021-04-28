@extends('dashboard')
@section('content')
    <div class="card" >
        <div class="card-header">
            {{ isset($post) ? 'Edit Post' : 'Create Post' }}
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ isset($post) ? route('posts.update', $post->id)  : route('posts.store') }}" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ isset($post) ? $post->title : '' }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" class="form-control" id="description" name="description" cols="5" rows="5" >{{ isset($post) ? $post->description : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="post_content">Content</label>
                    <textarea type="text" class="form-control" id="post_content" name="post_content" cols="5" rows="5" >{{ isset($post) ? $post->post_content : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="published_at">Published at</label>
                    <input type="date" class="form-control" id="published_at" name="published_at" value="{{ isset($post) ? $post->published_at : '' }}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image" value="{{ isset($post) ? $post->image : '' }}">
                </div>
                <div class="form-group d-flex justify-content-end">
                    <button type="sumbit" class="btn btn-success btn-sm">
                        {{ isset($post) ? 'Update Post' : 'Add Post' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('dashboard')
@section('content')
    <div class="card" >
        <div class="card-header">
           {{ isset($tag) ? 'Edit Tag' : 'Create Tag' }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ isset($tag) ? route('tags.update', $tag->id)  : route('tags.store') }}">
                @csrf
                @if(isset($tag))
                     @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ isset($tag) ? $tag->name : '' }}">
                </div>
                <div class="form-group d-flex justify-content-end">
                    <button type="sumbit" class="btn btn-success btn-sm">
                        {{ isset($tag) ? 'Update Tag' : 'Add Tag' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('dashboard')
@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('categories.create') }}" type="button" class="btn btn-success btn-sm mb-3">Create Category</a>
    </div>
    <div class="card" >
        <div class="card-header">
            Categories
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">An item</li>
            <li class="list-group-item">A second item</li>
            <li class="list-group-item">A third item</li>
        </ul>
    </div>
    @endsection

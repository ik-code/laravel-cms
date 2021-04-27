@extends('dashboard')
@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('categories.create') }}" type="button" class="btn btn-success btn-sm mb-3">Create Category</a>
    </div>
    <div class="card" >
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Category Name</th>
                <th scope="col">Edit</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
            <tr>
                <th scope="row">{{ $category->id }}</th>
                <td>{{ $category->name }}</td>
                <td><a class="btn btn-info btn-sm" href="{{ route('categories.edit', $category->id) }}" role="button">Edit</a></td>
            </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

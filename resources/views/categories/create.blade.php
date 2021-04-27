@extends('dashboard')
@section('content')
    <div class="card" >
        <div class="card-header">
           Create Category
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group d-flex justify-content-end">
                    <button type="sumbit" class="btn btn-success btn-sm">Add Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection

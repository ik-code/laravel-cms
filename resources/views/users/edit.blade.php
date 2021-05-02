@extends('dashboard')
@section('content')
    <div class="card" >
        <div class="card-header">
           My Profile
        </div>
        <div class="card-body">
            <form action="{{ route( 'users.update', $user->id ) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group d-flex justify-content-start mb-3 ">
                    <div>
                        <img src="{{ Gravatar::get($user->email) }}" width="70px" style="border-radius: 50%"
                             alt="{{ $user->name }}">
                    </div>

                    <div class="d-flex flex-column justify-content-center ml-2">
                        <div class="">Role: {{ $user->role }} </div>
                        <div class="">Email: {{ $user->email }}</div>
                    </div>

                </div>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                </div>

                <div class="form-group">
                    <label for="about">About</label>
                    <textarea type="text" class="form-control" cols="5" rows="5" name="about" id="about" >{{ $user->about }}</textarea>
                </div>

                <button type="submit" class="btn btn-success btn-sm float-right">Update Profile</button>
            </form>

        </div>
    </div>
@endsection

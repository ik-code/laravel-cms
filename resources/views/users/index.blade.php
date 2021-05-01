@extends('dashboard')
@section('content')
    <div class="card" style="overflow-x:auto;">
        @if($users->count() > 0)
            <h5 class="text-center mt-2">{{ 'User List' }}</h5>
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Gravatar</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <th scope="row"><img src="{{ Gravatar::get($user->email) }}" width="40px" height="40px" style="border-radius: 50%"
                                             alt="{{ $user->name }}"></th>
                        <td>{{ $user->name }}</td>
                        <td>
                           {{ $user->email }}
                        </td>
                        <td>
                            {{ $user->role }}
                        </td>
                        <td class="">
                            @if(!$user->isAdmin())
                                <form action="{{ route('users.make-admin', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm mr-2">Make Admin</button>
                                </form>
                                @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h5 class="text-center mt-2">No Users Yet!</h5>
        @endif
    </div>
@endsection


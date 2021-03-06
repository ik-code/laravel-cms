<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container-fluid mt-4">

        <div class="row">
            <div class="col-md-3">
                <ul class="list-group mb-2">
                    @if(auth()->user()->isAdmin())
                        <li class="list-group-item">
                            <a href="{{ route('users.index') }}">Users({{ count(\App\Models\User::all()) }})</a>
                        </li>
                        @endif

                    <li class="list-group-item">
                        <a href="{{ route('posts.index') }}">Posts({{ count(\App\Models\Post::all()) }})</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('tags.index') }}">Tags({{ count(\App\Models\Tag::all()) }})</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('categories.index') }}">Categories({{ count(\App\Models\Category::all()) }})</a>
                    </li>
                </ul>
                <ul class="list-group mb-2">
                    <li class="list-group-item">
                        <a href="{{ route('trashed-posts.index') }}">Trashed Posts({{ count(\App\Models\Post::onlyTrashed()->get()) }})</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
                @include('partials.session_success')
                @include('partials.session_error')
                @include('partials.errors')
                <div class="card">
                    <div class="card-body">
                        @if(isset($dashboard) && $dashboard===true )
                        <h5 class="text-center mt-2" >You are logged in!</h5>
                        @endif
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

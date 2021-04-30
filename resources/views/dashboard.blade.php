<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mt-4">

        <div class="row">
            <div class="col-md-3">
                <ul class="list-group mb-2">
                    <li class="list-group-item">
                        <a href="{{ route('posts.index') }}">Posts({{ count(\App\Models\Post::all()) }})</a>
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
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                       {{ session()->get('success') }}
                    </div>
                @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                <div class="card">
                    <div class="card-body">
                        <h6 class="text-center">You're logged in!</h6>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

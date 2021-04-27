<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mt-4">

        <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="">Posts</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('categories.index') }}">Categories</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-8">
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                       {{ session()->get('success') }}
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

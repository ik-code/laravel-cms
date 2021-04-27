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
                        <a href="/posts">Posts</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/categories">Categories</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

@extends('layouts.blog')
@section('title')
    Author: {{ $user->name }}
@endsection
@section('header')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('/img/home-bg.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-10 mx-auto">
                    <div class="site-heading">
                        <img class="mx-auto" src="{{ Gravatar::get($user->email) }}" width="80px" style="border-radius: 50%" alt="{{ $user->name }}">
                        <h1>Author: {{ $user->name }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <!-- Main Content-->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 mx-auto">

                @forelse($posts as $post)
                    <div class="post-preview">
                        <a href="{{ route('blog.post', $post->id) }}">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                            <h3 class="title mt-3">{{ $post->title }}</h3>
                            <h5 class="post-subtitle">{{ $post->description }}</h5>
                        </a>
                        <h6 class="post-subtitle">
                            Category:<a href="{{ route('blog.category', $post->category->id) }}" class="lead"> {{ $post->category->name }}</a> &nbsp;&nbsp;
                            Tags:
                            @foreach($post->tags()->get() as $tag)
                                <a class="badge badge-secondary px-3 py-2" href="{{ route('blog.tag', $tag->id) }}">{{ $tag->name }}</a>
                            @endforeach
                            Posted by: {{ substr($post->published_at, 0, -3) }}
                        </h6>
                    </div>
                    <hr/>
                @empty
                    <p class="lead text-center">
                        No results found for Search: <strong>{{ request()->query('search') }}</strong>
                    </p>
            @endforelse

            <!-- Pager-->
                <div class="clearfix">
                    {{ $posts->appends(['search' => request()->query('search')])->links() }}
                </div>
            </div>
            <div class="col-lg-4 col-md-4 mx-auto">
                @include('partials.sidebar')
            </div>
        </div>
    </div>
    <hr/>
@endsection


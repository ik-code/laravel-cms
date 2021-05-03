@extends('layouts.blog')
@section('title')
    Clean Blog
    @endsection
@section('header')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url('/img/home-bg.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Clean Blog</h1>
                        <span class="subheading">A Simple Blog Theme</span>
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
                            Category: {{ $post->category->name }} &nbsp;&nbsp;
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
                <div class="sidebar px-4 py-md-0">

                    <h6 class="post-title uppercase">Search</h6>
                    <form class="input-group" action="{{ route('website') }}"  method="GET">
                        <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request()->query('search') }}">
                        <div class="input-group-addon">
                            <button type="submit" class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </form>

                    <hr>

                    <h6 class="post-title uppercase">Categories</h6>
                    <div class="row link-color-default fs-14 lh-24">
                        @foreach($categories as $category)
                            <div class="col-6"><a href="#" class="lead">{{ $category->name }}</a></div>
                        @endforeach
                    </div>

                    <hr>

                    <h5 class="post-title uppercase">Tags</h5>
                    <div class="gap-multiline-items-1">
                        @foreach($tags as $tag)
                            <a class="badge badge-secondary px-3 py-2" href="#">{{ $tag->name }}</a>
                        @endforeach
                    </div>

                    <hr>

                </div>
            </div>
        </div>
    </div>
    <hr/>
    @endsection

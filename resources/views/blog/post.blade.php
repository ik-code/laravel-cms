@extends('layouts.blog')
@section('title')
    {{ $post->title }}
    @endsection
@section('header')
    <!-- Page Header-->
    <header class="masthead" style="background-image: url({{ asset('storage/' . $post->image) }})">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1>{{ $post->title }}</h1>
                        <span class="subheading">{{ $post->description }}</span>
                        <p class="lead">
                            Category: <a href="{{ route('blog.category', $post->category->id) }}" class="text-white lead"> {{ $post->category->name }}</a>
                            <br> Posted by: {{ substr($post->published_at, 0, -3) }}
                            </p>
                        <p class="lead d-flex align-items-center" >Author:<span class="d-flex"><img class="mx-3" src="{{ Gravatar::get($post->user->email) }}" width="40px" style="border-radius: 50%"
                                                         alt="{{ $post->user->name }}"> <a class="text-white align-self-center" href="{{ route( 'blog.author' , $post->user->id ) }}">{{ $post->user->name }}</a></span></p>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                   {!! $post->post_content !!}
                    <div class="gap-multiline-items-1">
                        <p class="lead">Tags:
                            @foreach($post->tags()->get() as $tag)
                                <a class="badge badge-secondary px-3 py-2" href="{{ route('blog.tag', $tag->id) }}">{{ $tag->name }}</a>
                            @endforeach
                        </p>
                    </div>
                    <div id="disqus_thread"></div>
                    <script>

                        var disqus_config = function () {
                            this.page.url = "{{ config('app.url') }}/blog/{{ $post->id }}";  // Replace PAGE_URL with your page's canonical URL variable
                            this.page.identifier = {{ $post->id }}; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                        };

                        (function() { // DON'T EDIT BELOW THIS LINE
                            var d = document, s = d.createElement('script');
                            s.src = 'https://clean-blog-3.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

                </div>
            </div>
        </div>
    </article>
    <hr />
    @endsection

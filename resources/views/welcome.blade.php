@include('partials.frontend.header')

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-8 mx-auto">

            @foreach($posts as $post)
                <div class="post-preview">
                    <a href="post.html">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                        <h3 class="title mt-3">{{ $post->title }}</h3>
                        <h5 class="post-subtitle">{{ $post->description }}</h5>
                    </a>
                    <h6 class="post-subtitle">
                        Category: {{ $post->category->name }},
                        Posted by: {{ substr($post->published_at, 0, -3) }}
                    </h6>
                </div>
                <hr/>
        @endforeach

        <!-- Pager-->
            <div class="clearfix"><a class="btn btn-primary float-right" href="#!">Older Posts →</a></div>
        </div>
        <div class="col-lg-4 col-md-4 mx-auto">
            <div class="sidebar px-4 py-md-0">

                <h6 class="post-title uppercase">Search</h6>
                <form class="input-group" target="#" method="GET">
                    <input type="text" class="form-control" name="s" placeholder="Search">
                    <div class="input-group-addon">
                        <span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span>
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

@include('partials.frontend.footer')

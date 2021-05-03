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
            <div class="col-6"><a href="{{ route('blog.category', $category->id) }}" class="lead">{{ $category->name }}</a></div>
        @endforeach
    </div>

    <hr>

    <h5 class="post-title uppercase">Tags</h5>
    <div class="gap-multiline-items-1">
        @foreach($tags as $tag)
            <a class="badge badge-secondary px-3 py-2" href="{{ route('blog.tag', $tag->id) }}">{{ $tag->name }}</a>
        @endforeach
    </div>

    <hr>

    <h5 class="post-title uppercase">Authors</h5>
    <div class="row link-color-default fs-14 lh-24">
        @foreach($users_have_posts as $author )
            <div class="col-12 d-flex mb-2"><img src="{{ Gravatar::get($author->email) }}" width="30px" style="border-radius: 50%" alt="{{ $author->name }}"><a href="{{ route('blog.author', $author->id) }}" class="ml-2 lead">{{ $author->name }}</a></div>
        @endforeach
    </div>

    <hr>

</div>

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class WelcomeController extends Controller {
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {

        return view( 'welcome' )
            ->with( 'posts',  Post::searched()->simplePaginate(2) )
            ->with( 'categories', Category::all() )
            ->with( 'tags', Tag::all() )
            ->with('users_have_posts', User::users_have_posts());
    }

    public function author($id){

        return view( 'blog.author' )
            ->with('user', User::find($id))
            ->with('posts', Post::where('user_id', '=', $id)->searched()->simplepaginate(2))
            ->with( 'categories', Category::all() )
            ->with( 'tags', Tag::all() )
            ->with('users_have_posts', User::users_have_posts());
    }

    /**
     * @param Category $category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function category(Category $category){

        return view('blog.category')
            ->with('category', $category)
            ->with('categories', Category::all())
            ->with('posts', $category->posts()->searched()->simplePaginate(1))
            ->with('tags', Tag::all())
            ->with('users_have_posts', User::users_have_posts());
    }

    /**
     * @param Tag $tag
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function tag(Tag $tag){

        return view('blog.tag')
            ->with('tag', $tag)
            ->with('categories', Category::all())
            ->with('posts', $tag->posts()->searched()->simplePaginate(1))
            ->with('tags', Tag::all())
            ->with('users_have_posts', User::users_have_posts());
    }

}

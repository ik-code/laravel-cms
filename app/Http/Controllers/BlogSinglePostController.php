<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class BlogSinglePostController extends Controller
{
    /**
     * @param Post $post
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Post $post){
        return view('blog.post')->with('post', $post);
    }

    /**
     * @param Category $category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function category(Category $category){

        $users = new User();

        return view('blog.category')
            ->with('category', $category)
            ->with('categories', Category::all())
            ->with('posts', $category->posts()->simplePaginate(1))
            ->with('tags', Tag::all())
            ->with('users_have_posts',$users->users_have_posts());
    }

    /**
     * @param Tag $tag
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function tag(Tag $tag){

        $users = new User();

        return view('blog.tag')
            ->with('tag', $tag)
            ->with('categories', Category::all())
            ->with('posts', $tag->posts()->simplePaginate(1))
            ->with('tags', Tag::all())
            ->with('users_have_posts', $users->users_have_posts());
    }


}

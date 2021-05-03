<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller {
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {

        $search = request()->query('search');

        if($search){
            $posts = Post::where('title', 'LIKE', "%{$search}%")->simplepaginate(2);
        }else{
            $posts = Post::simplepaginate( 2 );
        }

        $users = new User();

        return view( 'welcome' )
            ->with( 'posts',  $posts )
            ->with( 'categories', Category::all() )
            ->with( 'tags', Tag::all() )
            ->with('users_have_posts', $users->users_have_posts());
    }

    public function author($id){

        $posts = Post::where('user_id', '=', $id)->simplepaginate(2);
        $users = new User();
        return view( 'blog.author' )
            ->with('user', User::find($id))
            ->with('posts', $posts)
            ->with( 'categories', Category::all() )
            ->with( 'tags', Tag::all() )
            ->with('users_have_posts', $users->users_have_posts());
    }
}

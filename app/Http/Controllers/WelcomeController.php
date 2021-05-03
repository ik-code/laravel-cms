<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

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

        return view( 'welcome' )
            ->with( 'posts',  $posts )
            ->with( 'categories', Category::all() )
            ->with( 'tags', Tag::all() );
    }
}

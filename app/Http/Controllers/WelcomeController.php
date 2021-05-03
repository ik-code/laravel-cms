<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        return view('welcome')
            ->with('posts', Post::simplepaginate(2))
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogSinglePostController extends Controller
{
    public function show(Post $post){
        return view('blog.post')->with('post', $post);
    }
}

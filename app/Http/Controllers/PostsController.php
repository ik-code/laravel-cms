<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreatePostsRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view( 'posts.index' )->with( 'posts', Post::all() )->with('trashed', false);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view( 'posts.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store( CreatePostsRequest $request ) {
        //upload image
        $image = $request->image->store('posts');

        //create the post
        Post::create( [
            'title'        => $request->title,
            'description'  => $request->description,
            'post_content' => $request->post_content,
            'published_at' => $request->published_at,
            'image'        => $image
        ] );
        //flash image
        session()->flash( 'success', 'Post created successfully' );
        //redirect user
        return redirect( route( 'posts.index' ) );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit( Post $post ) {
        return view( 'posts.create' )->with( 'post', $post );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id ) {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {

        $post = Post::withTrashed()->where('id', '=', $id)->firstOrFail();

        if($post->trashed() ) {
            Storage::delete( $post->image );
            $post->forceDelete();
        }else {
            $post->delete();
        }

        session()->flash( 'success', 'Post deleted successfully' );

        return redirect( route( 'posts.index' ) );
    }

    /**
     * Displays all list trashed posts
     */
    public function trashed(){

        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with('posts', $trashed)->with('trashed', true);
    }
}

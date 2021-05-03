<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;

class PostsController extends Controller {

    /**
     * PostsController constructor.
     */
    public function __construct() {
        //applies this middleware only for methods create and store
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view( 'posts.index' )->with( 'posts', Post::all() )->with( 'trashed', false );;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view( 'posts.create' )->with('categories', Category::all())->with('tags', Tag::all());
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
        $image = $request->image->store( 'posts' );

        //create the post
        $post = Post::create( [
            'title'        => $request->title,
            'description'  => $request->description,
            'post_content' => $request->post_content,
            'published_at' => $request->published_at,
            'image'        => $image,
            'category_id'  => $request->category_id,
            'user_id'      => auth()->user()->id,
        ] );

        //to attach(associate) tags to the post for many to many relationships
        if($request->tags){
            $post->tags()->attach($request->tags);
        }

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
        return view( 'posts.create' )->with( 'post', $post )->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update( UpdatePostRequest $request, Post $post ) {

        $data = $request->only( [ 'title', 'description', 'post_content', 'published_at', 'category_id' ] );

        //check if image uploaded
        if ( $request->hasFile( 'image' ) ) {
            //upload it
            $image = $request->image->store( 'posts' );
            //delete the old one
            $post->deleteImage();

            $data['image'] = $image;
        }

        //sync for many to many relationships
        if($request->tags){
            $post->tags()->sync($request->tags);
        }

        //update attributes
        $post->update( $data );
        //flash message
        session()->flash( 'success', 'Post updated successfully' );

        //redirect user
        return view( 'posts.create' )->with( 'post', $post )->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {

        $post = Post::withTrashed()->where( 'id', '=', $id )->firstOrFail();

        if ( $post->trashed() ) {
            $post->deleteImage();
            $post->forceDelete();
            session()->flash( 'success', 'Post deleted successfully' );
        } else {
            $post->delete();
            session()->flash( 'success', 'Post trashed successfully' );
        }

        return redirect( route( 'posts.index' ) );
    }

    /**
     * Displays all list trashed posts
     */
    public function trashed() {

        $trashed = Post::onlyTrashed()->get();

        return view( 'posts.index' )->with( 'posts', $trashed )->with( 'trashed', true );
    }

    /**
     * Restore the post
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore( $id ) {

        $post = Post::withTrashed()->where( 'id', '=', $id )->firstOrFail();
        $post->restore();
        session()->flash( 'success' , 'Post restored successfully' );

        return redirect()->back();
    }
}

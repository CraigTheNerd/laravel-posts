<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index()
    {
        //  Get posts from the database
        //  There are a number of ways to pull this data from the database

        //  Where
//        $posts = Post::where();

        //  Find - Find a post by id
//        $posts = Post::find(1);

        //  Get - Returns all posts in their natural order * ALL POSTS
        //  This will give us a Laravel Collection
//        $posts = Post::get();

        //  Paginate posts
//        $posts = Post::Paginate(2);
//        $posts = Post::simplePaginate(4)->latest();
//        $posts = Post::simplePaginate(3)->sortByDesc("id");
//        $posts = Post::simplePaginate(3);
//        $posts = Post::Paginate(2)->sortByDesc("id");

//        $posts = Post::orderBy('id', 'desc')->simplePaginate(2);
//        $posts = Post::orderBy('id', 'desc')->Paginate(4);

//        $posts = Post::Paginate(2);

//        dd($posts);

//        Eager Loading
        $posts = Post::with(['user', 'likes'])->orderBy('created_at', 'desc')->Paginate(4);

        //  Load the posts page view
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function store(Request $request)
    {
        //  Validate
        $this->validate($request, [
           'body' => 'required'
        ]);

        //  Create post through user
//        $request->user()->posts()->create([
//            'body' => $request->body
//        ]);

        //  Another option of how to do this without user an array
        $request->user()->posts()->create($request->only('body'));

        return back();
    }

    //    Delete
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return back();
    }

}

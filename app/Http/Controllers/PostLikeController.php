<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    //  Route Model Binding
    public function store(Post $post, Request $request)
    {
        //  User can only like a post once
        if ($post->likedBy($request->user())) {
            return response(null, 409);
        }

        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        //  Only if this is a new like
        //  If a user previously liked a post, unliked it and then likes it again, the mail will not be sent again
        //  The mail is only sent on the initial like

        if (!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()) {
            //  Send email
            Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        }

        return back();
    }

    //  Route Model Binding
    public function destroy(Post $post, Request $request)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}

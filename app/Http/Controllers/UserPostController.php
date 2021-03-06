<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    //  Get currently authenticated user
    //  Show their posts
    //  Show their information
    public function index(User $user)
    {
        $posts = $user->posts()->with(['user', 'likes'])->paginate(4);
        return view('users.posts.index', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}

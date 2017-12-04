<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::latest()
        ->with('user.profile', 'comments.user.profile')
        ->get();
        return response(['posts' => $posts], 200);
    }
    
    public function store(Request $request)
    {
        $request['user_id'] = Auth::user()->id;
        $post = Post::create($request->all());
        $post->user->profile;
        $post->comments;
        return response(['post' => $post], 201);
    }
}

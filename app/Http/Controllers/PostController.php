<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::latest()
        ->with('user.profile', 'comments.user.profile');

        if ($request['limit']) {
            $posts = $posts->limit($request['limit']);
        }
        $posts = $posts->get();
        return response(['posts' => $posts], 200);
    }
    
    public function store(PostRequest $request)
    {
        $request['user_id'] = Auth::user()->id;
        $post = Post::create($request->all());
        $post->user->profile;
        $post->comments;
        return response(['post' => $post], 201);
    }

    public function update(PostRequest $request)
    {
        $post = Post::find($request->id);
        $post->update($request->all());
        $post->user->profile;
        $post->comments;
        return response(['post' => $post], 201);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response(['msg' => 'success'], 200);
    }
}

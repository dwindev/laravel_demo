<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request['user_id'] = Auth::user()->id;
        $comment = Comment::create($request->all());
        $comment->user->profile;
    return response(['comment' => $comment], 201);
    }
}

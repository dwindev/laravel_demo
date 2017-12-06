<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Comment;
use App\Post;
use Auth;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $request['user_id'] = Auth::user()->id;
        $comment = Comment::create($request->all());
        $comment->user->profile;
    return response(['comment' => $comment], 201);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return response(['msg' => 'success'], 200);
    }

    public function update(CommentRequest $request)
    {
        $comment = Comment::find($request->id);
        $comment->update($request->all());
        $comment->user->profile;
        return response(['comment' => $comment], 201);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return response()->json([
            'success' => true,
            'comment' => view('public.posts._comment', compact('comment'))->render()
        ]);
    }

    public function reply(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $reply = $comment->replies()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return response()->json([
            'success' => true,
            'reply' => view('public.posts._reply', compact('reply'))->render()
        ]);
    }
}
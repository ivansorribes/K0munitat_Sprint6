<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\commentsPosts; // Asegúrate de usar el namespace correcto
use Illuminate\Support\Facades\Validator;

class commentsPostsController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_post' => 'required|integer|exists:posts,id',
            'id_user' => 'required|integer|exists:users,id',
            'comment' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $comment = new commentsPosts;
        $comment->id_post = $request->id_post;
        $comment->id_user = $request->id_user;
        $comment->comment = $request->comment;
        $comment->save();

        return response()->json($comment, 201);
    }

    public function edit(Request $request, $editingCommentId)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $comment = commentsPosts::find($editingCommentId);
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $comment->comment = $request->comment;
        $comment->save();

        return response()->json($comment, 200);
    }
}

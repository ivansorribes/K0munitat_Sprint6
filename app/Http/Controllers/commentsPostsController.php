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
        $comment->id_user = $request->id_user; // Utiliza el valor de la solicitud
        $comment->comment = $request->comment;
        $comment->save();

        return response()->json($comment, 201);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\likesPosts;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        $postId = $request->id_post;

        $like = likesPosts::where('id_post', $postId)->where('id_user', Auth::id())->first();

        if ($like) {
            $like->delete();
        } else {
            $newLike = new likesPosts();
            $newLike->id_post = $postId;
            $newLike->id_user = Auth::id();
            $newLike->save();
        }

        return response()->json(['success' => true]);
    }
}

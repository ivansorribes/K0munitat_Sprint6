<?php

namespace App\Http\Controllers;

use App\Models\LikeComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeCommentController extends Controller
{
    public function like(Request $request)
    {
        $commentId = $request->id_comment;

        $like = LikeComment::where('id_comment', $commentId)->where('id_user', Auth::id())->first();

        if ($like) {
            $like->delete();
        } else {
            $newLike = new LikeComment();
            $newLike->id_comment = $commentId;
            $newLike->id_user = Auth::id();
            $newLike->save();
        }

        return response()->json(['success' => true]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LikeComment $likeComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LikeComment $likeComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LikeComment $likeComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LikeComment $likeComment)
    {
        //
    }
}

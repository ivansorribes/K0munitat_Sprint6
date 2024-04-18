<?php

namespace App\Http\Controllers;

use App\Models\LikeReplyComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeReplyCommentController extends Controller
{
    public function likeReply(Request $request, $replyId) // Include $replyId here
    {
        $like = LikeReplyComment::where('id_reply', $replyId)
            ->where('id_user', Auth::id())
            ->first();

        if ($like) {
            $like->delete();
        } else {
            $newLike = new LikeReplyComment();
            $newLike->id_reply = $replyId;
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
    public function show(LikeReplyComment $likeReplyComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LikeReplyComment $likeReplyComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LikeReplyComment $likeReplyComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LikeReplyComment $likeReplyComment)
    {
        //
    }
}

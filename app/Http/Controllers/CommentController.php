<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, Topic $topic)
    {
        $comment = $topic->comments()->create(['user_id' => Auth::id()] + $request->input());
        return $this->success('评论新增成功!', new CommentResource($comment->load(['topic', 'user', 'reply_comments', 'belong_to_comment', 'reply_user'])->refresh()));
    }

    public function show(Comment $comment) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}

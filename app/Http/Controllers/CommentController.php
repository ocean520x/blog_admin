<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Topic $topic)
    {
        $comments = $topic->comments()->whereNull('reply_comment_id')->with(['topic', 'reply_comments'])->get();
        return $this->success(data: CommentResource::collection($comments));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, Topic $topic)
    {
        $comment = $topic->comments()->create(['user_id' => Auth::id()] + $request->input());
        return $this->success('评论新增成功!', new CommentResource($comment->load(['topic', 'user', 'reply_comments', 'belong_to_comment', 'reply_user'])->refresh()));
    }

    // 回复评论
    public function replyComment(StoreCommentRequest $request, Topic $topic, Comment $comment)
    {
        // 区分被评论帖子的评论还是被回复的评论
        $reply_comment_id = $comment->reply_comment_id ?? $comment->id;
        $reply_user_id = $comment->user_id;
        $comment = $topic->comments()->create([
            'user_id' => Auth::id(),
            'reply_comment_id' => $reply_comment_id,
            'reply_user_id' => $reply_user_id,
        ] + $request->input());
        return $this->success('回复评论新增成功!', new CommentResource($comment->load(['topic', 'user', 'reply_comments', 'belong_to_comment', 'reply_user'])->refresh()));
    }

    public function show(Comment $comment) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        Gate::authorize('delete', $comment);
        $comment->delete();
        return $this->success('评论删除成功!');
    }

    public function get_one_user_comments()
    {
        $comments = Comment::when(request('u_id'), function ($query) {
            return $query->where('user_id', request('u_id'));
        })->latest()->paginate(5);
        return CommentResource::collection($comments);
    }

    public function allComments()
    {
        return CommentResource::collection(Comment::with(['topic'])->paginate(10));
    }
}

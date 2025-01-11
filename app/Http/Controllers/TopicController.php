<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TopicController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->except(['index', 'show','perCategory']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topics = Topic::orderBy('sort')->with(['user', 'category'])->latest()->paginate(8);
        return TopicResource::collection($topics);
    }

    public function perCategory($c_id)
    {
        $topics = Topic::where('category_id', $c_id)->orderBy('sort')->with(['user', 'category'])->latest()->paginate(8);
        return TopicResource::collection($topics);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTopicRequest $request, Topic $topic)
    {
        $topic->fill($request->input());
        $topic->user_id = Auth::id();
        $topic->save();
        return $this->success('发布帖子成功',data: new TopicResource($topic->load(['user', 'category'])));
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        return $this->success(data: new TopicResource($topic->load(['user', 'category'])));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTopicRequest $request, Topic $topic)
    {
        Gate::authorize('update', $topic);
        $topic->fill($request->input())->save();
        return $this->success('帖子修改成功!', new TopicResource($topic->load(['user', 'category'])));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        Gate::authorize('delete', $topic);
        $topic->delete();
        return $this->success('帖子删除成功!');
    }
}

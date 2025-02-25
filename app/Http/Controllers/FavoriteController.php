<?php

namespace App\Http\Controllers;

use App\Http\Resources\TopicResource;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function toggle(Topic $topic)
    {
        $user = Auth::user();
        $user->userTopics()->toggle($topic);
        return $this->success('操作成功', [
            'total' => $user->userTopics()->count(),
            'is_favorite' => $topic->topicUsers()->wherePivot('user_id', $user->id)->exists()
        ]);
    }

    public function is_favorite(User $user, Topic $topic)
    {
        return $this->success(data: [
            'is_favorite' => $topic->topicUsers()->wherePivot('user_id', $user->id)->exists()
        ]);
    }

    public function getOneUserFavoriteTopics()
    {
        $user = User::find(request('u_id'));
        $topics = $user->userTopics()->latest()->paginate(5);
        return TopicResource::collection($topics);
    }
}

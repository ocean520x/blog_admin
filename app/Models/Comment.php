<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment query()
 * @property int $id
 * @property int $user_id
 * @property int $topic_id
 * @property int|null $reply_comment_id
 * @property int|null $reply_user_id
 * @property string $content 评论内容
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Comment|null $belong_to_comment
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Comment> $reply_comments
 * @property-read int|null $reply_comments_count
 * @property-read \App\Models\User|null $reply_user
 * @property-read \App\Models\Topic $topic
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\CommentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereReplyCommentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereReplyUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereTopicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Comment whereUserId($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id', 'reply_comment_id', 'reply_user_id'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reply_comments()
    {
        return $this->hasMany(Comment::class, 'reply_comment_id');
    }

    public function belong_to_comment()
    {
        return $this->belongsTo(Comment::class, 'reply_comment_id');
    }

    public function reply_user()
    {
        return $this->belongsTo(User::class, 'reply_user_id');
    }
}

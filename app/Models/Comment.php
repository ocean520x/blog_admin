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

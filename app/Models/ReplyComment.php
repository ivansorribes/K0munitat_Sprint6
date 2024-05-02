<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyComment extends Model
{
    use HasFactory;

    protected $table = 'reply_comments';

    protected $fillable = [
        'reply',
        'id_user',
        'id_comment'
    ];

    protected $appends = ['likes_count'];

    public function likes()
    {
        return $this->hasMany(LikeReplyComment::class, 'id_reply');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Atributo calculado para el conteo de likes
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeReplyComment extends Model
{
    use HasFactory;

    protected $table = 'like_reply_comments';

    protected $fillable = [
        'id_user',
        'id_reply'
    ];

    public function reply()
    {
        return $this->belongsTo(ReplyComment::class, 'id_reply');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

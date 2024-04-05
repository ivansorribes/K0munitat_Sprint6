<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeComment extends Model
{
    use HasFactory;

    protected $table = 'like_comments';

    protected $fillable = [
        'id_user',
        'id_comment'
    ];

    public function comment()
    {
        return $this->belongsTo(commentsPosts::class, 'id_comment');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

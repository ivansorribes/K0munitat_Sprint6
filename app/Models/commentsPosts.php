<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class commentsPosts extends Model
{
    use HasFactory;

    protected $table = 'commentsPosts';

    protected $fillable = [
        'id_post',
        'id_user', // Asegúrate de incluir todas las columnas fillable necesarias
        'comment',
    ];

    // Define la relación con el modelo Post
    public function post(): BelongsTo
    {
        return $this->belongsTo(posts::class, 'id_post');
    }

    // Define la relación con el modelo User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    protected $appends = ['likes_count'];

    public function likes()
    {
        return $this->hasMany(LikeComment::class, 'id_comment');
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    public function replies()
    {
        return $this->hasMany(ReplyComment::class, 'id_comment', 'id');
    }

    public function comment()
    {
        return $this->belongsTo('App\Models\comments', 'id_comment');
    }
}

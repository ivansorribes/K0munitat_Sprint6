<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class likesPosts extends Model
{
    use HasFactory;

    protected $table = 'likesPosts';

    protected $fillable = [
        'id_user',
        'id_post'
    ];

    public function post()
    {
        return $this->belongsTo(posts::class, 'id_post');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

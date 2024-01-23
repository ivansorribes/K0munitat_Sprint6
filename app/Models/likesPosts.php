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

    public function user(): BelongsTo
    {
        return $this->belongsTo(users::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(posts::class);
    }
}

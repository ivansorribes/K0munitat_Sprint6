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
        'id_comment'       
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(posts::class);
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(comments::class);
    }
}

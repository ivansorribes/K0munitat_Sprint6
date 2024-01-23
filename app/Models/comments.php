<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class comments extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'id_user',
        'comment'       
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(users::class);
    }
}

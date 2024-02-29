<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;
    protected $table = 'event';

    protected $fillable = [
        'id_community',
        'id_user',
        'title',
        'start',
        'end',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function community(): BelongsTo
    {
        return $this->belongsTo(communities::class);
    }
}

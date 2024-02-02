<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class posts extends Model
{
    use HasFactory;
    protected $table = 'posts';

    protected $fillable = [
        'id_user',
        'id_category',
        'id_community',
        'title',
        'description',
        'category',
        'isactive',
        'private',
        'type',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(categories::class);
    }

    public function community(): BelongsTo
    {
        return $this->belongsTo(communities::class);
    }


}

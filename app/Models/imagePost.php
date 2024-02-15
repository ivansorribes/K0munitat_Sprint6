<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class imagePost extends Model
{
    use HasFactory;

    protected $table = 'imagePost';

    protected $fillable = [
        'id_post',
        'name',
        'front_page'
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(posts::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(imagePost::class, 'id_post');
    }
}

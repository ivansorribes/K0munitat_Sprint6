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
        'isActive',
        'private',
        'type',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function community()
    {
        return $this->belongsTo(communities::class, 'id_community');
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(categories::class);
    }

    public function images()
    {
        return $this->hasMany(imagePost::class, 'id_post');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(categories::class, 'id_category');
    }
    public function comments()
    {
        return $this->hasMany(commentsPosts::class, 'id_post');
    }

    public function likes()
    {
        return $this->hasMany(likesPosts::class, 'id_post');
    }
}

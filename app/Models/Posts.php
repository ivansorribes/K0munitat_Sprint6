<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Posts extends Model
{
    use HasFactory;
    protected $table = 'posts';

    protected $fillable = [
        'id_community',
        'id_user',
        'title',
        'description',
        'category',
        'date_published',
        'isactive',
        'type'        
    ];

    public function community(): BelongsTo
    {
        return $this->belongsTo(Communities::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}

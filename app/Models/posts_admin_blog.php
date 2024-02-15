<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class posts_admin_blog extends Model
{
    use HasFactory;

    protected $table = 'posts_admin_blog';

    protected $fillable = [
        
        'title',
        'description',
        'post_image',

    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post_admin_blog extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        
        'title',
        'description',
        'post_image',

    ];
}

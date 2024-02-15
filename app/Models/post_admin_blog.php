<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post_admin_blog extends Model
{
    use HasFactory;

    protected $table = 'post_admin_blog';

    protected $fillable = [
        
        'title',
        'description',
        'post_image',

    ];
}
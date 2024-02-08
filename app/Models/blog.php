<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Blog extends Model
{
    use HasFactory;

    protected $table = 'post_admin__blog';

    protected $fillable = [
        'title', 'description', 'post_image',
    ];
}

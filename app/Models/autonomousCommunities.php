<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class autonomousCommunities extends Model
{
    use HasFactory;

    protected $table = 'autonomousCommunities';

    protected $fillable = [
        'name',
    ];
}

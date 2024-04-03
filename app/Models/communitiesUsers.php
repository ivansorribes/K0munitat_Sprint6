<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class communitiesUsers extends Model
{
    use HasFactory;

    protected $table = 'communitiesUsers';

    protected $fillable = [
        'id_community',
        'id_user'    
    ];

}

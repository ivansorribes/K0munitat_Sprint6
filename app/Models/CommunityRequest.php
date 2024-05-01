<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_community', 
        'id_user',
        'status'
    ];

    protected $table = 'community_requests';

}

<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



class communitiesUsers extends Model
{
    use HasFactory;

    protected $table = 'communitiesUsers';

    protected $fillable = [
        'id_community',
        'id_user'    
    ];

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

}

<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class communities extends Model
{
    use HasFactory;
    protected $table = 'communities';

    protected $fillable = [
        'id_admin',
        'name',
        'description',
        'id_autonomousCommunity',
        'id_region',
        'private',
        'created_at',
        'isActive'
    ];

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

   
}
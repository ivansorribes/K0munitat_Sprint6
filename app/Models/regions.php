<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class regions extends Model
{
    use HasFactory;
    protected $table = 'regions';

    protected $fillable = [
        'id_autonomousCommunity',
        'name',        
    ];

    public function autonomousCommunities(): BelongsTo
    {
        return $this->belongsTo(autonomousCommunities::class, 'id_autonomousCommunity');
    }

}

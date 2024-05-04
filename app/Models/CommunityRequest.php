<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\communities;
use App\Models\autonomousCommunities;

class CommunityRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_community', 
        'id_user',
        'status'
    ];

    protected $table = 'community_requests';

    public function admin()
    {
        return $this->community->admin();
    }

    public function community()
    {
        return $this->belongsTo(Communities::class, 'id_community');
    }

    public function autonomousCommunity()
    {
        return $this->belongsTo(autonomousCommunities::class, 'id_autonomousCommunity');   
    }


    public static function getPendingRequests()
    {
        return static::with(['community', 'autonomousCommunity']) // Cargar la relación autonomousCommunity
        ->where('status', 'pending')
        ->get();
    }
}

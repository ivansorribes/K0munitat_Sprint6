<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contactMessagesClient extends Model
{
    use HasFactory;

    protected $table = 'contactMessagesClient';


    protected $fillable = [
        'sender_name',
        'email',
        'message',
        'read',
        'id_user',
        'isActive'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

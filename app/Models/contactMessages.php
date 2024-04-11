<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contactMessages extends Model
{
    use HasFactory;

    protected $table = 'contactMessages';


    protected $fillable = [
        'sender_name',
        'phone',
        'email',
        'subject',
        'message',
        'read',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

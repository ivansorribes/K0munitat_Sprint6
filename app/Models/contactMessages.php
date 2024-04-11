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
        'message'
    ];
}

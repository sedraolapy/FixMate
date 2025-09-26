<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $fillable = [
        'user_name',
        'phone_number',
        'message',
        'status',
    ];

}

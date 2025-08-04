<?php

namespace App\Models;

use App\Enums\GovernmentEntityStatusEnum;
use Illuminate\Database\Eloquent\Model;

class GovernmentEntity extends Model
{
    protected $fillable =[
        'name',
        'image',
        'phone_numbers',
        'facebook',
        'instagram',
        'status',
    ];

    protected $casts = [
        'status' => GovernmentEntityStatusEnum::class,
        'phone_numbers' => 'array',
    ];
}

<?php

namespace App\Models;

use App\Enums\CustomerStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable =[
        'first_name',
        'last_name',
        'phone_number',
        'image',
        'state_id',
        'city_id',
        'status',
    ];

    protected $casts = [
        'status' => CustomerStatusEnum::class,
    ];

    public function state() {
        return $this->belongsTo(State::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }
}

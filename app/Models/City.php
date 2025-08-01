<?php

namespace App\Models;

use App\Enums\CityStatusEnum;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable =[
        'name',
        'state_id',
        'status',
    ];

    protected $cast = [
        'status' => CityStatusEnum::class,
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

}

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

    protected $casts = [
        'status' => CityStatusEnum::class,
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function scopeActiveByState($query, $stateId)
{
    return $query->where('state_id', $stateId)
                 ->where('status', CityStatusEnum::ACTIVE->value);
}


}

<?php

namespace App\Models;

use App\Enums\StateStatusEnum;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable =[
        'name',
        'status',
    ];

    protected $cast = [
        'status' => StateStatusEnum::class,
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

}

<?php

namespace App\Models;

use App\Enums\TagStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable =[
        'name',
        'status',
    ];

    protected $casts=[
        'status' => TagStatusEnum::class
    ];

    public function serviceProviders()
    {
        return $this->belongsToMany(ServiceProvider::class);
    }


}

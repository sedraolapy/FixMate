<?php

namespace App\Models;

use App\Enums\CategorystatusEnum;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =[
        'name',
        'thumbnail',
        'description',
        'status',
    ];

    protected $casts=[
        'status' => CategorystatusEnum::class
    ];


    public function subcategories()
{
    return $this->hasMany(Subcategory::class);
}

//scopes
public function scopeActive($query)
{
    return $query->where('status', CategorystatusEnum::ACTIVE);
}

}

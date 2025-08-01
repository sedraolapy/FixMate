<?php

namespace App\Models;

use App\Enums\SubCategoryStatusEnum;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{

    protected $fillable =[
        'name',
        'thumbnail',
        'description',
        'status',
        'category_id',
    ];

    protected $casts=[
        'status' => SubCategoryStatusEnum::class
    ];

    public function category()
{
    return $this->belongsTo(Category::class);
}

}

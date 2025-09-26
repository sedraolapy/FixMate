<?php

namespace App\Models;

use App\Enums\SubCategoryStatusEnum;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SubCategory extends Model
{
    use HasTranslations;

    public $translatable = ['name','description'];

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

public function serviceProviders()
{
    return $this->hasMany(ServiceProvider::class, 'sub_category_id');
}

//global scopes
protected static function boot()
{
    parent::boot();

    self::addGlobalScope(ActiveScope::class);
}



}

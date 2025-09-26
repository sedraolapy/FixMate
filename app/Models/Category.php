<?php

namespace App\Models;

use App\Enums\CategorystatusEnum;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;

    public $translatable = ['name','description'];

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

public function serviceProviders()
{
    return $this->hasMany(ServiceProvider::class);
}

public function scopeTagFilter(Builder $query, $tagId): Builder
    {
        return $query->whereHas('serviceProviders.tags', function ($q) use ($tagId) {
            $q->where('tags.id', $tagId);
        });
    }


protected static function boot()
{
    parent::boot();

    self::addGlobalScope(ActiveScope::class);
}

}

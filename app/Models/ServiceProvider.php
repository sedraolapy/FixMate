<?php

namespace App\Models;

use App\Enums\ServiceProviderStatusEnum;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class ServiceProvider extends Model
{
    use HasRoles;

    protected $fillable =[
        'name',
        'shop_name',
        'thumbnail',
        'gallery',
        'views',
        'status',
        'description',
        'category_id',
        'sub_category_id',
        'state_id',
        'city_id',
        'phone_number',
        'whatsapp',
        'facebook',
        'instagram',
        'start_date',
        'end_date',
    ];

    protected $casts=[
        'status' => ServiceProviderStatusEnum::class,
        'start_date' => 'date',
        'end_date' => 'date',
        'gallery' => 'array',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category()
{
    return $this->belongsTo(Category::class);
}

public function subcategory()
{
    return $this->belongsTo(SubCategory::class, 'sub_category_id');
}


public function state() {
    return $this->belongsTo(State::class);
}

public function city() {
    return $this->belongsTo(City::class);
}

public function offers() {
    return $this->hasMany(Offer::class);
}

public function sliders()
{
    return $this->hasMany(Slider::class);
}

public function notifications()
{
     return $this->morphMany(NotificationRecipient::class, 'recipient');
}

//global scopes
protected static function boot()
{
    parent::boot();

    self::addGlobalScope(ActiveScope::class);
}

//local scopes
public function scopeCategoryFilter($query, $categoryId)
{
    return $query->when($categoryId, fn($q) => $q->where('category_id', $categoryId));
}

public function scopeSubCategoryFilter($query, $subCategoryId)
{
    return $query->when($subCategoryId, fn($q) => $q->where('sub_category_id', $subCategoryId));
}

public function scopeStateFilter($query, $stateId)
{
    return $query->when($stateId, fn($q) => $q->where('state_id', $stateId));
}

public function scopeCityFilter($query, $cityId)
{
    return $query->when($cityId, fn($q) => $q->where('city_id', $cityId));
}

public function scopeTagFilter($query, $tag)
{
    return $query->when($tag, function ($q) use ($tag) {
        $q->whereHas('tags', fn($subQuery) => $subQuery->where('name', $tag));
    });
}

public function scopeSortFilter($query, $sort)
{
    return $query->when($sort, function ($q) use ($sort) {
        if ($sort === 'views_asc') {
            $q->orderBy('views', 'asc');
        } elseif ($sort === 'views_desc') {
            $q->orderBy('views', 'desc');
        }
    });
}

}

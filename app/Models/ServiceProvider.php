<?php

namespace App\Models;

use App\Enums\ServiceProviderStatusEnum;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    protected $fillable =[
        'name',
        'shop_name',
        'thumbnail',
        'views',
        'status',
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


}

<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class ServiceProviderRequest extends Model
{

    protected $table = 'service_provider_requests';


    public $fillable = [
        'customer_id',
        'name',
        'shop_name',
        'category_id',
        'sub_category_id',
        'thumbnail',
        'description',
        'state_id',
        'city_id',
        'phone_number',
        'whatsapp',
        'facebook',
        'instagram',
        'status',
        'notes',
    ];


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


    protected static function boot()
{
    parent::boot();

    self::addGlobalScope(ActiveScope::class);
}
}

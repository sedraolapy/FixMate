<?php

namespace App\Models;

use App\Enums\OfferStatusEnum;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'title',
        'image',
        'service_provider_id',
        'start_date',
        'expire_date',
        'status',
    ];

    protected $casts = [
        'status' => OfferStatusEnum::class,
        'start_date' => 'datetime',
        'expire_date' => 'datetime',
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    protected static function boot()
{
    parent::boot();

    self::addGlobalScope(ActiveScope::class);
}

}

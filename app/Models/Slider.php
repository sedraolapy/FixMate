<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable =[
        'title',
        'image',
        'service_provider_id',
        'status'
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

<?php

namespace App\Models;

use App\Enums\GovernmentEntityStatusEnum;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class GovernmentEntity extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable =[
        'name',
        'image',
        'phone_numbers',
        'facebook',
        'instagram',
        'status',
    ];

    protected $casts = [
        'status' => GovernmentEntityStatusEnum::class,
        'phone_numbers' => 'array',
    ];

    protected static function boot()
{
    parent::boot();

    self::addGlobalScope(ActiveScope::class);
}
}

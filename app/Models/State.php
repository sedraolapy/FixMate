<?php

namespace App\Models;

use App\Enums\StateStatusEnum;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class State extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable =[
        'name',
        'status',
    ];

    protected $casts = [
        'status' => StateStatusEnum::class,
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    protected static function boot()
{
    parent::boot();

    self::addGlobalScope(ActiveScope::class);
}
}

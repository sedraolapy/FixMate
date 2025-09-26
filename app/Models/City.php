<?php

namespace App\Models;

use App\Enums\CityStatusEnum;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class City extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $fillable =[
        'name',
        'state_id',
        'status',
    ];

    protected $casts = [
        'status' => CityStatusEnum::class,
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function scopeActiveByState($query, $stateId)
{
    return $query->where('state_id', $stateId)
                 ->where('status', CityStatusEnum::ACTIVE->value);
}

protected static function boot()
{
    parent::boot();

    self::addGlobalScope(ActiveScope::class);
}


}

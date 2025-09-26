<?php

namespace App\Models;

use App\Enums\CustomerStatusEnum;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use HasRoles, Notifiable;

    protected $fillable =[
        'first_name',
        'last_name',
        'phone_number',
        'image',
        'state_id',
        'city_id',
        'status',
        'password',
        'verification_code',
        'verified_at',
        'verification_code_sent_at',
    ];

    protected $casts = [
        'status' => CustomerStatusEnum::class,
        'password' => 'hashed',
        'notifications_enabled' => 'boolean',
    ];

    public function state() {
        return $this->belongsTo(State::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function notifications()
    {
        return $this->morphMany(NotificationRecipient::class, 'recipient');
    }


    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    protected static function boot()
{
    parent::boot();

    self::addGlobalScope(ActiveScope::class);
}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class Admin  extends Authenticatable implements HasAvatar
{
    use HasRoles, Notifiable;

    protected $fillable =[
        'email',
        'password',
        'name',
        'phone_number',
        'avatar_url'
    ];

    protected $guard_name = 'admin';

    public function notifications()
    {
        return $this->morphMany(NotificationRecipient::class, 'recipient');
    }

    public function getFilamentAvatarUrl(): ?string
    {
        $avatarColumn = config('filament-edit-profile.avatar_column', 'avatar_url');
        return $this->$avatarColumn ? Storage::url($this->$avatarColumn) : null;
    }

    public function canAccessChangePassword(): bool
{
    return true;
}


}

<?php

namespace App\Models;

use Althinect\FilamentSpatieRolesPermissions\Commands\Permission;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $fillable = [
        'name',
        'guard_name',
        'status', // Add this field
    ];


    public function customers()
{
    return $this->morphedByMany(Customer::class, 'model', 'model_has_roles', 'role_id', 'model_id');
}

public function serviceProviders()
{
    return $this->morphedByMany(ServiceProvider::class, 'model', 'model_has_roles', 'role_id', 'model_id');
}

public function admins()
{
    return $this->morphedByMany(Admin::class, 'model', 'model_has_roles', 'role_id', 'model_id');
}

protected static function boot()
{
    parent::boot();

    self::addGlobalScope(ActiveScope::class);
}

}

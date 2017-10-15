<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Define relationship with the permission model
     * @return QueryBuilder
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Define relationship with the cart model
     * @return QueryBuilder
     */
    public function carts()
    {
        return $this->hasMany(Permission::class);
    }

    /**
     * Get administrative privilege of authenticated user
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->permissions()->whereAction('admin')->first();
    }

    /**
     * Check if user has permission to perform an action
     * @param  String  $action
     * @return boolean
     */
    public function hasPermission($action)
    {
        return $this->permissions()->whereAction($action)->first();
    }
}

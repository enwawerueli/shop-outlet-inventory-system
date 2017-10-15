<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

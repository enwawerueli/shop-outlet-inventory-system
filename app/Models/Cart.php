<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Cart extends Model
{
    protected $table = 'carts';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

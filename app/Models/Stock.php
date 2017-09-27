<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

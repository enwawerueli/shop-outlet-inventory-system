<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Associated database table name
    protected $table = 'products';
    // Fields protected from mass assignment
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}

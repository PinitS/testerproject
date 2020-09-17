<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productinfo extends Model
{
    protected $fillable = ['category_id' , 'active_count' , 'count_quatity' , 'active' , 'name' , 'cost' , 'price' , 'promotion_id' , 'product_type'];

    public function Category()
    {
        return $this->belongsTo(category::class);
    }

    public function quatityreport()
    {
        return $this->hasMany(QuatityReport::class);
    }

    public function promotion()
    {
        return $this->hasMany(Promotion::class);
    }
}

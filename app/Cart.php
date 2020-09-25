<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['productinfo_id' , 'productname' , 'price' , 'quatity', 'totalprice' , 'user_id' , 'note' , 'textpromotion'];

    public function cartDetail()
    {
        return $this->hasMany(CartDetail::class);
    }

    public function productinfo()
    {
        return $this->belongsTo(Productinfo::class);
    }
    //
}

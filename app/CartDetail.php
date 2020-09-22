<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    protected $fillable = ['cart_id' , 'material_id' , 'price' , 'total_price' , 'user_id' , 'quatity'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function Material()
    {
        return $this->belongsTo(material::class);
    }


    //
}

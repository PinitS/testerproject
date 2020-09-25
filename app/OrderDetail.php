<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['order_id' , 'order_detail_id', 'order_set_id' , 'productinfo_id' ,'productname' , 'price' , 'quatity', 'totalprice' , 'user_id' , 'note' , 'textpromotion'];

    public function orderDetailmaterial()
    {
        return $this->hasMany(OrderDetailmaterial::class , 'order_detail_id' , 'order_detail_id');
    }

    public function productinfo()
    {
        return $this->belongsTo(Productinfo::class);
    }


    public function orderset()
    {
        return $this->belongsTo(OrderSet::class);
    }



    //
}

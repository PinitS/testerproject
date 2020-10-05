<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderSet extends Model
{
    protected $fillable = ['order_id' , 'user_id' , 'status' , 'times'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function orderDetailmaterial()
    {
        return $this->hasMany(OrderDetailmaterial::class);
    }




    //
}

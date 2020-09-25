<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetailmaterial extends Model
{
    protected $fillable = ['order_id' , 'order_set_id' , 'materialName' , 'order_detail_id' ,'material_id' , 'price' , 'total_price' , 'user_id' , 'quatity'];
    //

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class , 'order_detail_id' , 'order_detail_id');
    }

    public function Material()
    {
        return $this->belongsTo(material::class);
    }

    public function orderset()
    {
        return $this->belongsTo(OrderSet::class);
    }
}

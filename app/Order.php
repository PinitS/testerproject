<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id' , 'status'];

    public function orderSet()
    {
        return $this->hasMany(OrderSet::class);
    }


    //
}

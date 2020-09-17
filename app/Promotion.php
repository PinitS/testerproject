<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Promotion extends Model
{
    protected $fillable = ['productinfo_id' , 'start' , 'end' , 'discount' , 'active'];


    public function productinfo()
    {
        return $this->belongsTo(Productinfo::class);
        
    }

    //
}

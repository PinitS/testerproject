<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class material extends Model
{
    protected $fillable = ['materialname' , 'materialprice'];

    public function cartDetail()
    {
        return $this->hasMany(CartDetail::class);
    }
}

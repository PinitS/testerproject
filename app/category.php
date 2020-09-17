<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = ['categoryname'];

    public function product()
    {
        return $this->hasMany(Productinfo::class, 'category_id');
    }

}

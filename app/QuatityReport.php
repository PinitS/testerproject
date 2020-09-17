<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuatityReport extends Model
{
    protected $fillable = ['productinfo_id' , 'old_quatity' , 'quatity' , 'type'];

    public function productinfo()
    {
        return $this->belongsTo(Productinfo::class);
    }

    //
}

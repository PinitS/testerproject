<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class job extends Model
{
    protected $fillable = ['jobname'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

}

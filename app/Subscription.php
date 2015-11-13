<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    //
    public function films()
    {
        $this->belongsToMany('App/Films');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
     public function offre()
    {
        return $this->hasMany('App\Offre');
    }
}

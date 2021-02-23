<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
     public function Offre()
    {
        return $this->hasMany('App\Offre');
    }
}

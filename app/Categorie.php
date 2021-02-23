<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
     public function offre()
    {
        return $this->hasMany('App\Offre');
    }
     public function profil()
    {
        return $this->hasMany('App\Profil');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
     public function type()
    {
        return $this->hasOne('App\Type');
    }
     public function profil_postuler()
    {
        return $this->belongsToMany('App\Profil');
    }
    public function categorie()
    {
        return $this->hasOne('App\Categorie');
    }
}

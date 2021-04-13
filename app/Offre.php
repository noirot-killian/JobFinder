<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    public function type()
    {
        return $this->belongsTo('App\Type');
    }
    public function profil_postuler()
    {
        return $this->belongsToMany('App\Profil','offre_profil_postuler');
    }

    public function profil_favoriser()
    {
        return $this->belongsToMany('App\Profil','offre_profil_favoris');
    }

    public function categorie()
    {
        return $this->belongsTo('App\Categorie');
    }
}

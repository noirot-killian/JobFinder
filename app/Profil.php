<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    public function profil_postuler()
    {
        return $this->belongsToMany('App\Offre');
    }

    public function profil_favoriser()
    {
        return $this->belongsToMany('App\Offre','offre_profil_favoris');
    }

    public function categorie()
    {
        return $this->belongsTo('App\Categorie');
    }

    public function message_expedier()
    {
        return $this->hasMany('App\Message');
    }

    public function message_destiner()
    {
        return $this->belongsToMany('App\Message');
    }

    public function users()
    {
        return $this->hasOne('App\users');
    }
}

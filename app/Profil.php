<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    public function profil_postule()
    {
        return $this->belongsToMany('App\Profil');
    }
    public function categorie()
    {
        return $this->hasOne('App\Categorie');
    }
    public function message_expedie()
    {
        return $this->hasMany('App\Message');
    }
    public function message_destine()
    {
        return $this->belongsToMany('App\Message');
    }
}
}

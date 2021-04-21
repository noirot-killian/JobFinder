<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function profil_emetteur()
    {
        return $this->belongsTo('App\Profil','emetteur_id');
    }
    public function profil_destinataire()
    {
        return $this->belongsToMany('App\Profil','destinataire_id');
    }
}

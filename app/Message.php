<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function profil_expedier()
    {
        return $this->hasOne('App\Profil');
    }
    public function profil_destiner()
    {
        return $this->belongsToMany('App\Profil');
    }
}

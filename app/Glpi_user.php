<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Glpi_user  extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function coordinateur()
    {
        return $this->hasone('App\Glpiplugindemandeoutillagecoordinateur');
    }
    public function projteur()
    {
        return $this->hasone('App\Glpiplugindemandeoutillageprojeteur');
    }

    public function atelier()
    {
        return $this->hasone('App\Glpiplugindemandeoutillageatelier');
    }
}

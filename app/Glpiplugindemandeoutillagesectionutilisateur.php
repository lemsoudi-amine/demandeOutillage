<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Glpiplugindemandeoutillagesectionutilisateur extends Model
{
    use SoftDeletes;

    protected $dates=["deleted_at"];
   
    public function demandes()
    {
        return $this->hasMany('App\Glpiplugindemandeoutillagedemande');
    }

    public function user()
    {
        return $this->hasOne('App\Glpi_user', 'Glpi_user_id');
    }

}

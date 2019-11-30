<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Glpiplugindemandeoutillagedemande extends Model
{
   
    use SoftDeletes;
    protected $dates=["deleted_at"];
    public function glpiplugindemandeoutillagedemandefiles()
    {
        return $this->hasMany('App\Glpiplugindemandeoutillagedemandefile');
    }
    public function section()
    {
        return $this->belongsTo('App\Glpiplugindemandeoutillagesectionutilisateur', 'glpiplugindemandeoutillagesectionutilisateur_id');
    }
    public function porteur()
    {
        return $this->belongsTo('App\Glpiplugindemandeoutillageporteur', 'glpiplugindemandeoutillageporteur_id');
    }
    public function projteur()
    {
        return $this->belongsTo('App\Glpiplugindemandeoutillageprojeteur', 'glpiplugindemandeoutillageprojeteur_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Glpi_user', 'Glpi_user_id');
    }
    public function partieetude()
    {
        return $this->belongsTo('App\Glpiplugindemandeoutillagedemandepartieetude', 'glpiplugindemandeoutillagedemandepartieetude_id');
    }
    public function partiefab()
    {
        return $this->belongsTo('App\Glpiplugindemandeoutillagedemandepartiefab', 'glpiplugindemandeoutillagedemandepartiefab_id');
    }
}

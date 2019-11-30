<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Glpiplugindemandeoutillagedemandepartiefab extends Model
{
       
    use SoftDeletes;
    protected $dates=["deleted_at"];
  
    public function demande()
    {
        return $this->belongsTo('App\Glpiplugindemandeoutillagedemande');
    }
    public function atelier()
    {
        return $this->belongsTo('App\Glpiplugindemandeoutillageatelier','glpiplugindemandeoutillageatelier_id');
    }
}

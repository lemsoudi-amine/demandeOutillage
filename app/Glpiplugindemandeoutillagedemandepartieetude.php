<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Glpiplugindemandeoutillagedemandepartieetude extends Model
{
       
    use SoftDeletes;
    protected $dates=["deleted_at"];
    public function demande()
    {
        return $this->belongsTo('App\Glpiplugindemandeoutillagedemande');
    }
}

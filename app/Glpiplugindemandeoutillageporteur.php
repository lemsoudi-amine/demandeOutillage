<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Glpiplugindemandeoutillageporteur extends Model
{
    use SoftDeletes;

    protected $dates=["deleted_at"];
    public function demandes()
    {
        return $this->hasMany('App\Glpiplugindemandeoutillagedemande');
    }
}

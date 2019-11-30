<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Glpiplugindemandeoutillageatelier extends Model
{
    use SoftDeletes;

    protected $dates=["deleted_at"];

    public function user()
    {
        return $this->hasOne('App\Glpi_user', 'Glpi_user_id');
    }
}

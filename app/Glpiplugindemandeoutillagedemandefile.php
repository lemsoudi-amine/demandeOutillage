<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Glpiplugindemandeoutillagedemandefile extends Model
{
    
    use SoftDeletes;
    protected $dates=["deleted_at"];
    protected $fillable = [
        'demandeID','path_File', 'name_File',
    ];
    public function demande()
    {
        return $this->belongsTo('App\Glpiplugindemandeoutillagedemande');
    }
}

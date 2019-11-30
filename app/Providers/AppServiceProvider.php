<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Glpiplugindemandeoutillageporteur;
use App\Glpiplugindemandeoutillagesectionutilisateur;
use App\Glpiplugindemandeoutillagedemande;
use App\Glpiplugindemandeoutillagedemandefile;
use App\Glpiplugindemandeoutillagecoordinateur;
use App\Glpiplugindemandeoutillageprojeteur;
use App\Glpiplugindemandeoutillageatelier;
use App\Glpi_user;
use App\Glpiplugindemandeoutillagedemandepartieetude;
const  GLPIID ="glpiID";
const  COORDINATEURBE = "COORDINATEUR BE";

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       view()->composer('layouts.master',function($view){
           //list pour profil coordinateur
    $user=Glpi_user::find($_SESSION[GLPIID]);
    $coordinateur=$user->coordinateur;
    $isCoordinateur = false;
    if(!empty($coordinateur)){
        $isCoordinateur = true;
        $listdemandesparcoordi= Glpiplugindemandeoutillagedemande::where("etap","=",COORDINATEURBE)->get();
}
    else{
        $listdemandesparcoordi=new \Illuminate\Database\Eloquent\Collection;
    }
    //list pour profil projteur
    $projteur=$user->projteur;
    if(!empty($projteur)){
        $listdemandesparprojteur= Glpiplugindemandeoutillagedemande::where([["etap","=","PROJETEUR"],['glpiplugindemandeoutillageprojeteur_id','=',$projteur->id]])->get();
    }
    else{$listdemandesparprojteur=new \Illuminate\Database\Eloquent\Collection;}
    if(empty($listdemandesparprojteur)){
        $listdemandesparprojteur=new \Illuminate\Database\Eloquent\Collection;
    }
    //list pour profil REF outillage
    $listdemandesparsection=new \Illuminate\Database\Eloquent\Collection;
    $listofsection=Glpiplugindemandeoutillagesectionutilisateur::where("Glpi_user_id","=",$_SESSION[GLPIID])->get();
    foreach ($listofsection as $section) {
        foreach ($section->demandes as $demande) {
            if( $demande->etap==="REFERENT OUTILLAGE")
                {
                    $listdemandesparsection->push($demande); 
                }   
        }  
    }
    //list pour profil METHODE FAB
    $atelier=$user->atelier;
    if(!empty($atelier)){
        $listdemandesparatelier= Glpiplugindemandeoutillagedemande::where("etap","=","METHODE FAB")->get();
    }
    else{
        $listdemandesparatelier=new \Illuminate\Database\Eloquent\Collection;
    }

    //list pour profil demandeur
   
    $listdemandespardemandeur= Glpiplugindemandeoutillagedemande::where([["Glpi_user_id","=",$_SESSION[GLPIID]],["etap","=","LIVRAISON"],["statusofdemande","=","SOUMIS LIVRAISON"]])
    ->orWhere([["Glpi_user_id","=",$_SESSION[GLPIID]],["etap","=","DEMANDEUR"],["statusfdevalidation","=","Rejetée"],["rejeterpar","=","REFERENT OUTILLAGE"]])
    ->get();
    if(empty($listdemandespardemandeur)){
        $listdemandespardemandeur=new \Illuminate\Database\Eloquent\Collection;
    }
    $nbrdedemandesatraiter = sizeof($listdemandesparsection)+sizeof($listdemandesparcoordi)+sizeof($listdemandesparprojteur)+sizeof($listdemandesparatelier)+sizeof($listdemandespardemandeur);

            $view->with(['nbraction'=>$nbrdedemandesatraiter,'isCoordinateur'=>$isCoordinateur]);
       }) ;
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

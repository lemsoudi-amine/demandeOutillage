<?php

namespace App\Http\Controllers;
use \Datetime;
use Illuminate\Http\Request;
use App\Glpiplugindemandeoutillagedemande;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    //show dashboard
public function home(){
    $conteDemandeall=Glpiplugindemandeoutillagedemande::all()->count();
    $conteDemandenew=Glpiplugindemandeoutillagedemande::where('etap','=',"REFERENT OUTILLAGE")->count();
    $conteDemandeenattente=Glpiplugindemandeoutillagedemande::where('statusfdevalidation','=',"En attente")->count();
    $conteDemandesoumislivraison=Glpiplugindemandeoutillagedemande::where('statusofdemande','=',"SOUMIS LIVRAISON")->count();
    $conteDemandeEncoursFAB=Glpiplugindemandeoutillagedemande::where('statusofdemande','=',"En cours Fab")->count();
    $conteDemandelivre=Glpiplugindemandeoutillagedemande::where('statusofdemande','=',"Livré Client")->count();
    $conteDemandebymonth=Glpiplugindemandeoutillagedemande::selectRaw('count(*) AS cnt, datecreation')->groupBy('datecreation')->get();

    //Demande par étape
    $contDEMANDEUR=Glpiplugindemandeoutillagedemande::where('etap','=',"DEMANDEUR")->count();
    $contREF=Glpiplugindemandeoutillagedemande::where('etap','=',"REFERENT OUTILLAGE")->count();
    $contCORD=Glpiplugindemandeoutillagedemande::where('etap','=',"COORDINATEUR BE")->count();
    $contPROJ=Glpiplugindemandeoutillagedemande::where('etap','=',"PROJETEUR")->count();
    $contFAB=Glpiplugindemandeoutillagedemande::where('etap','=',"METHODE FAB")->count();
    $contLIVRAISON=Glpiplugindemandeoutillagedemande::where('etap','=',"LIVRAISON")->count();

    //Demande par type
    $contCreation=Glpiplugindemandeoutillagedemande::where('type_intervention','=',"C")->count();
    $contDuplication=Glpiplugindemandeoutillagedemande::where('type_intervention','=',"D")->count();
    $contmodification=Glpiplugindemandeoutillagedemande::where('type_intervention','=',"M")->count();
    $contrepartition=Glpiplugindemandeoutillagedemande::where('type_intervention','=',"R")->count();

    $demandescount = array();
    $demandemois = array();
    for($i=0;$i<=11;$i++){
        $demandecount=Glpiplugindemandeoutillagedemande::where([["created_at",">=",date("Y-m-d", mktime(0, 0, 0, date("m")-$i, 1))],
        ['created_at','<=',date("Y-m-d", mktime(0, 0, 0, date("m")-($i-1),0))]])->count();
        $mois = array(1=>'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
        setlocale(LC_TIME, "fr");
        array_push($demandemois,date("Y-m-d", mktime(0, 0, 0, date("m")-$i, 1)));
        array_push($demandescount,$demandecount);
        if($i==0){
            $thismonthdemandecount = $demandecount;
        }
        if($i==1){
            $previousmonthdemandecount = $demandecount;
        }
    }
    $ecart=100;
    if($previousmonthdemandecount!=0){
    $ecart = ($thismonthdemandecount*100/$previousmonthdemandecount)-100;}

    //calcul délai étude
    $demandesparservice="";
    $alldemandes=Glpiplugindemandeoutillagedemande::all();
    $delaietudelist = array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0);
    $delaifablist =   array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0,6=>0);
    foreach($alldemandes as $demande){
        $partieetude = $demande->partieetude;
        $partiefab = $demande->partiefab;
        $delaietude=0;
        $delaifab=0;
        if($partieetude->datededutetude!=null and $partieetude->datefinetude!=null){
        $delaietude = intval(((new DateTime(($partieetude->datededutetude)))->diff(new DateTime($partieetude->datefinetude)))->format('%a'))+1;
        switch ($delaietude) {
            case 1:
                $delaietudelist[0]++;
                break;
            case 2:
            $delaietudelist[1]++;
                break;
            case 3:
            $delaietudelist[2]++;
                break;
            case 4:
            $delaietudelist[3]++;
                break;
            case 5:
            $delaietudelist[4]++;
                break;
            case 6:
            $delaietudelist[5]++;
                break;
            default :
            $delaietudelist[6]++;
                break;
        }
        }
        //calcul delai fabrication
        if($partiefab->datededutfab!=null && $partiefab->datefinfab){
        $delaifab = intval(((new DateTime($partiefab->datededutfab))->diff(new DateTime($partiefab->datefinfab)))->format('%a'))+1;
        switch ($delaifab) {
            case 1:
            $delaifablist[0]++;
                break;
            case 2:
            $delaifablist[1]++;
                break;
            case 3:
            $delaifablist[2]++;
                break;
            case 4:
            $delaifablist[3]++;
                break;
            case 5:
            $delaifablist[4]++;
                break;
            case 6:
            $delaifablist[5]++;
                break;
            default :
            $delaifablist[6]++;
                break;
        }
    }
        
    // calcule demandes par service
    $demandesparservice = DB::table('glpiplugindemandeoutillagedemandes')
    ->leftjoin('glpiplugindemandeoutillagesectionutilisateurs','glpiplugindemandeoutillagedemandes.glpiplugindemandeoutillagesectionutilisateur_id','=','glpiplugindemandeoutillagesectionutilisateurs.id')
    ->select(DB::raw('count(*) as demande_count,glpiplugindemandeoutillagesectionutilisateurs.service'))
    ->groupBy('glpiplugindemandeoutillagesectionutilisateurs.service')->get(); 
    }
    return view('home',['conteDemandenew'=>$conteDemandenew,'conteDemandeenattente'=>$conteDemandeenattente,'conteDemandesoumislivraison'=>$conteDemandesoumislivraison,'conteDemandeEncoursFAB'=>$conteDemandeEncoursFAB,'conteDemandelivre'=>$conteDemandelivre,
    'conteDemandeall'=>$conteDemandeall,'conteDemandebymonth'=>$conteDemandebymonth,
    'contDEMANDEUR'=>$contDEMANDEUR,'contREF'=>$contREF,'contCORD'=>$contCORD,'contPROJ'=>$contPROJ,'contFAB'=>$contFAB,'contLIVRAISON'=>$contLIVRAISON,
    'contCreation'=>$contCreation,'contDuplication'=>$contDuplication,'contmodification'=>$contmodification,'contrepartition'=>$contrepartition,
    'thismonthdemandecount'=>$thismonthdemandecount,'demandescount'=>$demandescount,'ecart'=>$ecart,
    'demandemois'=>$demandemois,'delaietudelist'=>$delaietudelist,'delaifablist'=>$delaifablist,'demandesparservice'=>$demandesparservice]);
}
}
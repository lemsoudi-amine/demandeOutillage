<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Glpiplugindemandeoutillageporteur;
use App\Glpiplugindemandeoutillagesectionutilisateur;
use App\Glpiplugindemandeoutillagedemande;
use App\Glpiplugindemandeoutillagedemandefile;
use App\Glpiplugindemandeoutillagedemandepartiefab;
use App\Glpiplugindemandeoutillagedemandepartieetude;
use App\Glpiplugindemandeoutillageatelier;
use App\Glpi_user;
class DemandeController extends Controller
{ 
   //lister les demandes
   public function index($statcode=null){
    //list pour profil coordinateur
    $user=Glpi_user::find($_SESSION["glpiID"]);
    $coordinateur=$user->coordinateur;
    if(!empty($coordinateur)){
    $listdemandesparcoordi= Glpiplugindemandeoutillagedemande::all();
    }
    else{
        $listdemandesparcoordi=new \Illuminate\Database\Eloquent\Collection;
    }
    //list pour profil projteur
    $projteur=$user->projteur;
    if(!empty($projteur)){
    $listdemandesparprojteur= $projteur->demandes;}
    else{$listdemandesparprojteur=new \Illuminate\Database\Eloquent\Collection;}
    if(empty($listdemandesparprojteur)){
        $listdemandesparprojteur=new \Illuminate\Database\Eloquent\Collection;
    }
    //list pour profil REF outillage
    $listdemandesparsection=new \Illuminate\Database\Eloquent\Collection;
    $listofsection=Glpiplugindemandeoutillagesectionutilisateur::where("Glpi_user_id","=",$_SESSION["glpiID"])->get();
    foreach ($listofsection as $section) {
        foreach ($section->demandes as $demande) {
                $listdemandesparsection->push($demande); 
        }  
    }
    //list pour profil METHODE FAB
    $atelier=$user->atelier;
    if(!empty($atelier)){
    $listdemandesparatelier= Glpiplugindemandeoutillagedemande::all();
    }
    else{
        $listdemandesparatelier=new \Illuminate\Database\Eloquent\Collection;
    }

    // list pour profile demandeur
    $listdemandesdemandeur= Glpiplugindemandeoutillagedemande::where("Glpi_user_id",$_SESSION['glpiID'])->get();
    if(empty($listdemandesdemandeur)){
        $listdemandesdemandeur=new \Illuminate\Database\Eloquent\Collection;
    }

    $listdemandes=new \Illuminate\Database\Eloquent\Collection;
    foreach($listdemandesparcoordi as $demande){
        $listdemandes->put($demande->id,$demande);
    }
    foreach($listdemandesparprojteur as $demande){
        $listdemandes->put($demande->id,$demande);
    }
    foreach($listdemandesparsection as $demande){
        $listdemandes->put($demande->id,$demande);
    }
    foreach($listdemandesparatelier as $demande){
        $listdemandes->put($demande->id,$demande);
    }
    foreach($listdemandesdemandeur as $demande){
        $listdemandes->put($demande->id,$demande);
    }
   return view('demande.index',['listdemandes'=>$listdemandes,'sizelist'=>sizeof($listdemandes)]);
}
//affiche les formulaire de creation de la demande
public function create(){
    $listsections=Glpiplugindemandeoutillagesectionutilisateur::all();
    $listporteurs=Glpiplugindemandeoutillageporteur::all();
    $today = date("Y-m-d");
     $nbcommandejour=Glpiplugindemandeoutillagedemande::whereDate('created_at','=',$today)->count();
    if($nbcommandejour+1<10)
    {
         $nbcommandejour="0".($nbcommandejour+1);
    }
    else 
    {
        $nbcommandejour=$nbcommandejour+1;
    }
    return view('demande/create',['listsections'=>$listsections,'listporteurs'=>$listporteurs,'nbcommandejour'=>$nbcommandejour]);
}


//enregistrer la demande 
public function store(Request $request){

    $demande=new Glpiplugindemandeoutillagedemande();
    $demande->glpiplugindemandeoutillageporteur_id=$request->input('porteur');
    $demande->num_CAPEX=$request->input('capex');
    $demande->code_project=$request->input('codeprojet');
    $demande->ref_pn_impacte=$request->input('refpnimpacte');
    $demande->pn=$request->input('pn');
    $demande->datecreation=date("Y-m-d");
    $demande->date_souhaite=$request->input('datesouhaite');
    $demande->date_prev_OF=$request->input('dateprevue');
    $demande->quantite=$request->input('quantite');
    $demande->Glpi_user_id=$_SESSION['glpiID'];
    $demande->glpiplugindemandeoutillagesectionutilisateur_id=$request->input('section');
    $demande->fonctions_outillage=$request->input('fonctionoutil');
    $demande->gain_attendu=$request->input('gainattendu');
    $demande->gain_attendu_value=$request->input('montant');
    $demande->comments=$request->input('comments');
    if($request->input('typedintervenetion')=="C" OR $request->input('typedintervenetion')=="M" ){
        $demande->statusfdevalidation='En attente';
        $demande->etap='REFERENT OUTILLAGE';
        $demande->statusofdemande='_';
    }
    else {
        $demande->statusfdevalidation='Approuvée';
        $demande->etap='METHODE FAB';
        $demande->approuverpar="PROJETEUR";
        $demande->statusofdemande='EN COURS FAB';
    }
    
    
   
    $demande->type_intervention=$request->input('typedintervenetion');
    $demande->degre_priorite=$request->input('degrepriorite');

    $today=date("Y-m-d");
    $nbcommandejour=Glpiplugindemandeoutillagedemande::whereDate('created_at','=',$today)->count();
    $demande->nb_commande_du_jour=$nbcommandejour;
    
    $demande->ref_outillage=$request->input('refoutillage');

    


    if(($nbcommandejour+1)<10)
    {
         $Nbdemande="0".($nbcommandejour+1);
    }
    else 
    {
        $Nbdemande=$nbcommandejour+1;
    }

    $section=Glpiplugindemandeoutillagesectionutilisateur::find($request->input('section'));

    $refcommande=$section->num_section."_".substr( date("Y/m/d"), -8)."_N".$Nbdemande.$request->input('typedintervenetion');
    $demande->ref_commande=$refcommande;
    $partieetude=new Glpiplugindemandeoutillagedemandepartieetude();
    $partiefab=new Glpiplugindemandeoutillagedemandepartiefab();
    $partieetude->save();
    $partiefab->save();
    $demande->glpiplugindemandeoutillagedemandepartieetude_id=$partieetude->id;
    $demande->glpiplugindemandeoutillagedemandepartiefab_id=$partiefab->id;
    if($request->input('typedintervenetion')!="C" AND $request->input('typedintervenetion')!="M" ){
        $atelierId = Glpiplugindemandeoutillageatelier::pluck('id')->first();
        $partiefab->glpiplugindemandeoutillageatelier_id = $atelierId; 
        $partiefab->save();       
    }
    Schema::disableForeignKeyConstraints();
       $demande->save();
    Schema::enableForeignKeyConstraints();
   //if($request->has(myfiles)){
    if(isset($request->myfiles)){
    foreach ($request->myfiles as $file) {
        $filename = $file->store('files');
        Glpiplugindemandeoutillagedemandefile::create([
            'demandeID' => $demande->id,
            'path_File' => $filename,
            'name_File' => $file->getClientOriginalName()
        ]);
    }
}

return redirect()->action(
    'DemandeController@index', ['statcode' => '200']);
}


//show demande
public function show($id){
    $icons = [
        'pdf' => 'pdf',
        'doc' => 'word',
        'docx' => 'word',
        'xls' => 'excel',
        'xlsx' => 'excel',
        'xlsm' => 'excel',
        'ppt' => 'powerpoint',
        'pptx' => 'powerpoint',
        'txt' => 'text',
        'png' => 'image',
        'jpg' => 'image',
        'jpeg' => 'image',
    ];
    $demande=Glpiplugindemandeoutillagedemande::find($id);
    $today = date("Y-m-d");
    $nbcommandejour=Glpiplugindemandeoutillagedemande::whereDate('created_at','=',$today)->count();
    if($nbcommandejour+1<10)
    {
         $nbcommandejour="0".($nbcommandejour+1);
    }
    else 
    {
        $nbcommandejour=$nbcommandejour+1;
    }
    //get files of demande
    $filesofdemande = Glpiplugindemandeoutillagedemandefile::where('demandeID','=',$id)->get();
    // check if is coordinateur or not
    $user=Glpi_user::find($_SESSION["glpiID"]);
    $coordinateur=$user->coordinateur;
    if(!empty($coordinateur)){
    $isCoordinateur = true;
    }
    else{
       $isCoordinateur = false;
    }

    return view('demande.show',['demande'=>$demande,'nbcommandejour'=>$nbcommandejour,'filesofdemande'=>$filesofdemande,'isCoordinateur'=>$isCoordinateur,'icons'=>$icons]);
}
public function notedesuivi(Request $request,$id){
    $demande=Glpiplugindemandeoutillagedemande::find($id);
    $demande->note_suivi = $request->input('notedesuivi');
    Schema::disableForeignKeyConstraints();
    $demande->save();
    Schema::enableForeignKeyConstraints();

    return redirect()->action(
        'DemandeController@show', ['id' => $demande->id]);
}
}

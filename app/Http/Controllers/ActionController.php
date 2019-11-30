<?php

namespace App\Http\Controllers;

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
class ActionController extends Controller
{
      //lister les demandes

   public function index(){

    //list pour profil coordinateur
    $user=Glpi_user::find($_SESSION[GLPIID]);
    $coordinateur=$user->coordinateur;
    if(!empty($coordinateur)){
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
    return view('action.index',['listdemandes'=>$listdemandesparsection,'listdemandesparcoordi'=>$listdemandesparcoordi,'listdemandesparprojteur'=>$listdemandesparprojteur,'listdemandesparatelier'=>$listdemandesparatelier,'listdemandespardemandeur'=>$listdemandespardemandeur,'nbrdedemandesatraiter'=>$nbrdedemandesatraiter]);
    }
    //show demande
    public function show($id){
        $icons = [
            'pdf' => 'pdf',
            'doc' => 'word',
            'docx' => 'word',
            'xls' => 'excel',
            'CSV' => 'excel',
            'csv' => 'excel',
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
        $listdesprojteurs=Glpiplugindemandeoutillageprojeteur::all();
        $listporteurs=Glpiplugindemandeoutillageporteur::all();
        //get files of demande
        $filesofdemande = Glpiplugindemandeoutillagedemandefile::where('demandeID','=',$id)->get();
        return view('action.show',['demande'=>$demande,'listdesprojteurs'=>$listdesprojteurs,'filesofdemande'=>$filesofdemande,'listporteurs'=>$listporteurs,'icons'=>$icons]);
    }
    //show demande par coordinateur
    public function showCoord($id){
        $icons = [
            'pdf' => 'pdf',
            'doc' => 'word',
            'docx' => 'word',
            'xls' => 'excel',
            'xlsx' => 'excel',
            'CSV' => 'excel',
            'csv' => 'excel',
            'xlsm' => 'excel',
            'ppt' => 'powerpoint',
            'pptx' => 'powerpoint',
            'txt' => 'text',
            'png' => 'image',
            'jpg' => 'image',
            'jpeg' => 'image',
        ];
        $demande=Glpiplugindemandeoutillagedemande::find($id);
        $listdesprojteurs=Glpiplugindemandeoutillageprojeteur::all();
        $listporteurs=Glpiplugindemandeoutillageporteur::all();
        //get files of demande
        $filesofdemande = Glpiplugindemandeoutillagedemandefile::where('demandeID','=',$id)->get();
        return view('action.showCoord',['demande'=>$demande,'listdesprojteurs'=>$listdesprojteurs,'filesofdemande'=>$filesofdemande,'listporteurs'=>$listporteurs,'icons'=>$icons]);
    }
    //show demande par projeteur
    public function showProj($id){
        $icons = [
            'pdf' => 'pdf',
            'doc' => 'word',
            'docx' => 'word',
            'xls' => 'excel',
            'xlsx' => 'excel',
            'CSV' => 'excel',
            'csv' => 'excel',
            'xlsm' => 'excel',
            'ppt' => 'powerpoint',
            'pptx' => 'powerpoint',
            'txt' => 'text',
            'png' => 'image',
            'jpg' => 'image',
            'jpeg' => 'image',
        ];
        $demande=Glpiplugindemandeoutillagedemande::find($id);
        $listdesateliers=Glpiplugindemandeoutillageatelier::all();
        $resAtelier = Glpiplugindemandeoutillageatelier::where('id','=',$demande->partiefab->glpiplugindemandeoutillageatelier_id)->pluck('nameofatelier')->first();
        //get files of demande
        $filesofdemande = Glpiplugindemandeoutillagedemandefile::where('demandeID','=',$id)->get();
        return view('action.showProj',['demande'=>$demande,'filesofdemande'=>$filesofdemande,'listdesateliers'=>$listdesateliers,'resAtelier'=>$resAtelier,'icons'=>$icons]);
    }
     //show demande par METHODE FAB
     public function showAtelier($id){
        $icons = [
            'pdf' => 'pdf',
            'doc' => 'word',
            'docx' => 'word',
            'xls' => 'excel',
            'xlsx' => 'excel',
            'xlsm' => 'excel',
            'CSV' => 'excel',
            'csv' => 'excel',
            'ppt' => 'powerpoint',
            'pptx' => 'powerpoint',
            'txt' => 'text',
            'png' => 'image',
            'jpg' => 'image',
            'jpeg' => 'image',
        ];
        $demande=Glpiplugindemandeoutillagedemande::find($id);
        //get files of demande
        $filesofdemande = Glpiplugindemandeoutillagedemandefile::where('demandeID','=',$id)->get();
        return view('action.showAtelier',['demande'=>$demande,'filesofdemande'=>$filesofdemande,'icons'=>$icons]);
    }
    //show demande par demandeur
    public function showDemandeur($id){
        $icons = [
            'pdf' => 'pdf',
            'doc' => 'word',
            'docx' => 'word',
            'xls' => 'excel',
            'xlsx' => 'excel',
            'CSV' => 'excel',
            'csv' => 'excel',
            'xlsm' => 'excel',
            'ppt' => 'powerpoint',
            'pptx' => 'powerpoint',
            'txt' => 'text',
            'png' => 'image',
            'jpg' => 'image',
            'jpeg' => 'image',
        ];
        $demande=Glpiplugindemandeoutillagedemande::find($id);
        $listdesprojteurs=Glpiplugindemandeoutillageprojeteur::all();
        $listporteurs=Glpiplugindemandeoutillageporteur::all();
        //get files of demande
        $filesofdemande = Glpiplugindemandeoutillagedemandefile::where('demandeID','=',$id)->get();
        return view('action.showDemandeur',['demande'=>$demande,'listdesprojteurs'=>$listdesprojteurs,'filesofdemande'=>$filesofdemande,'listporteurs'=>$listporteurs,'icons'=>$icons]);
    }
    //approuver demande
    public function approverByRefOutile(Request $request,$id){

        $demande=Glpiplugindemandeoutillagedemande::find($id);
        $demande->statusfdevalidation="Approuvée";
        $demande->etap=COORDINATEURBE;
        $demande->commentvalidation=$request->input('comment');
        $demande->approuverpar="REFERENT OUTILLAGE";
        $demande->statusofdemande="_";
        $demande->affecterpar=NULL;

        $demande->save();

        return redirect()->action(
            'ActionController@show', ['demande' => $demande]);

        }
            //approuver demande
    public function rejeterByRefOutile(Request $request,$id){

        $demande=Glpiplugindemandeoutillagedemande::find($id);
        $demande->statusfdevalidation="Rejetée";
        $demande->rejeterpar="REFERENT OUTILLAGE";
        $demande->commentvalidation=$request->input('comment');
        $demande->etap="DEMANDEUR";
        $demande->statusofdemande="_";
        $demande->affecterpar=NULL;
        $demande->save();
        return redirect()->action(
            'ActionController@show', ['id' => $demande->id]);
        }
 //approuver demande par coordinateur
 public function approverByCoord(Request $request,$id){

    $demande=Glpiplugindemandeoutillagedemande::find($id);
    $demande->statusfdevalidation="Approuvée";
    $demande->approuverpar=COORDINATEURBE;
    $demande->commentvalidation=$request->input('comment');
    $demande->coordinateurvalidateurID=$_SESSION[GLPIID];
    $demande->etap="COORDINATEUR BE";
    $demande->statusofdemande="_";
    $demande->affecterpar=NULL;
    Schema::disableForeignKeyConstraints();
    $demande->save();
    Schema::enableForeignKeyConstraints();

    return redirect()->action(
        'ActionController@showCoord', ['id' => $id]);
    }
    //Assign projeteur by coordinateur
 public function assigneByCoord(Request $request){

    $demande=Glpiplugindemandeoutillagedemande::find($request->id);
    $demande->coordinateurvalidateurID=$_SESSION[GLPIID];
    $demande->glpiplugindemandeoutillageprojeteur_id=$request->projteur;
    $demande->etap="PROJETEUR";
    $demande->statusofdemande="BE Pas commencé";
    Schema::disableForeignKeyConstraints();
    $demande->save();
    Schema::enableForeignKeyConstraints();

    return "BE Pas commencé";
    //redirect()->action(
      //  'ActionController@showCoord', ['id' => $request->id]);""

    }

        //Assign projeteur by coordinateur
 public function saveAndassigneByCoord(Request $request){

    $demande=Glpiplugindemandeoutillagedemande::find($request->id);
    $demande->coordinateurvalidateurID=$_SESSION[GLPIID];
    $demande->glpiplugindemandeoutillageprojeteur_id=$request->projteur;
    $demande->num_CAPEX=$request->capex;
    $demande->code_project=$request->codeprojet;
    $demande->ref_pn_impacte=$request->refpnimpacte;
    $demande->pn=$request->pn;
    $demande->ref_outillage=$request->refoutillage;
    $demande->degre_priorite=$request->degrepriorite;
    $demande->date_souhaite=$request->datesouhaite;
    $demande->date_prev_OF=$request->dateprevue;
    $demande->quantite=$request->quantite;
    $demande->fonctions_outillage=$request->fonctionoutil;
    $demande->gain_attendu=$request->gainattendu;
    $demande->gain_attendu_value=$request->montant;
    $demande->comments=$request->summernoteComment; 
    $demande->periodicite=$request->periodicite;

    $partieetude=$demande->partieetude;
    $partieetude->datededutetude=$request->datededutetude;
    $partieetude->delaisfinetude=$request->delaisfinetude;
    $partieetude->glpiplugindemandeoutillageprojeteur_id=$request->projteur;
    $partieetude->estimationetude3D=$request->estimationetude3D;
    $partieetude->estimationlaisse2D=$request->estimationlaisse2D;
    $partieetude->estimationverification2D=$request->estimationverification2D;
    $partieetude->estimationtotal=$request->estimationtotal;
    $partieetude->save();
    
    $demande->etap="PROJETEUR";
    $demande->statusofdemande="BE Pas commencé";
    Schema::disableForeignKeyConstraints();
    $demande->save();
    Schema::enableForeignKeyConstraints();

    return "BE Pas commencé";
    //redirect()->action(
      //  'ActionController@showCoord', ['id' => $request->id]);""

    }

    // assign atelier by projeteur
    public function assigneByProj(Request $request){

        $demande=Glpiplugindemandeoutillagedemande::find($request->id);
        $demande->coordinateurvalidateurID=$_SESSION[GLPIID];
        $demande->partiefab->glpiplugindemandeoutillageatelier_id=$request->atelier;
        $demande->etap="METHODE FAB";
        $demande->statusofdemande="En cours Fab";
        $partieetude=$demande->partieetude;
        $partieetude->datefinetude=date("Y-m-d");
        $partieetude->save();
        Schema::disableForeignKeyConstraints();
        $demande->save();
        Schema::enableForeignKeyConstraints();
    
        return "En cours Fab";
        //redirect()->action(
          //  'ActionController@showCoord', ['id' => $request->id]);""
    
        }

        public function saveAndassigneByProj(Request $request){

            $demande=Glpiplugindemandeoutillagedemande::find($request->id);
            $demande->coordinateurvalidateurID=$_SESSION[GLPIID];
            $demande->partiefab->glpiplugindemandeoutillageatelier_id=$request->atelier;
            $demande->etap="METHODE FAB";
            $demande->statusofdemande="En cours Fab";
            $partieetude=$demande->partieetude;
            $partieetude->reeletude3D = $request->reeletude3D;
            $partieetude->percentetude3D = $request->percentetude3D;
            $partieetude->reellaisse2D = $request->reellaisse2D;
            $partieetude->percentlaisse2D = $request->percentlaisse2D;
            $partieetude->reelverification2D = $request->reelverification2D;
            $partieetude->percentverification2D = $request->percentverification2D;
            $partieetude->reeltotal = $request->reeltotal;
            $partieetude->percenttotal = $request->percenttotal;
            $partieetude->datefinetude=date("Y-m-d");
            $partieetude->save();
            Schema::disableForeignKeyConstraints();
            $demande->save();
            Schema::enableForeignKeyConstraints();
        
            return "En cours Fab";
            //redirect()->action(
              //  'ActionController@showCoord', ['id' => $request->id]);""
        
            }

        public function saveAndsoumettre(Request $request){

                $demande=Glpiplugindemandeoutillagedemande::find($request->id);
                $demande->etap="LIVRAISON";
                $demande->statusofdemande="SOUMIS LIVRAISON";

                $partiefab=$demande->partiefab;
                $partiefab->datededutfab=$request->datedebutfab;
                $partiefab->estimationfab=$request->estimationtotal;
                $partiefab->reelfab=$request->reeltotal;
                $partiefab->cout_outil=$request->coutoutil;
                $demande->commentvalidation=$request->comment;
                $partiefab->delaisfinfab=$request->delaiestimelivr;
                $partiefab->datefinfab=$request->datefinfab;
                $partiefab->percenttotal=floatval(substr($request->pourcentage, 0, -1));

                $partiefab->save();
                Schema::disableForeignKeyConstraints();
                $demande->save();
                Schema::enableForeignKeyConstraints();
            
                return "LIVRAISON SOUMISE";
            
                }


                public function savebeforeapprouvebyref(Request $request){

                    $demande=Glpiplugindemandeoutillagedemande::find($request->id);
                    $demande->glpiplugindemandeoutillageporteur_id=$request->porteurID;
                    $demande->num_CAPEX=$request->capex;
                    $demande->code_project=$request->codeprojet;
                    $demande->ref_pn_impacte=$request->refpnimpacte;
                    $demande->pn=$request->pn;
                    $demande->ref_outillage=$request->refoutillage;
                    $demande->degre_priorite=$request->degrepriorite;
                    $demande->date_souhaite=$request->datesouhaite;
                    $demande->date_prev_OF=$request->dateprevue;
                    $demande->quantite=$request->quantite;
                    $demande->fonctions_outillage=$request->fonctionoutil;
                    $demande->gain_attendu=$request->gainattendu;
                    $demande->gain_attendu_value=$request->montant;
                    Schema::disableForeignKeyConstraints();
                    $demande->save();
                    Schema::enableForeignKeyConstraints();
                
                    }
                    public function savebeforeapprouvebycoord(Request $request){

                        $demande=Glpiplugindemandeoutillagedemande::find($request->id);
                        $demande->glpiplugindemandeoutillageporteur_id=$request->porteurID;
                        $demande->num_CAPEX=$request->capex;
                        $demande->code_project=$request->codeprojet;
                        $demande->ref_pn_impacte=$request->refpnimpacte;
                        $demande->pn=$request->pn;
                        $demande->ref_outillage=$request->refoutillage;
                        $demande->degre_priorite=$request->degrepriorite;
                        $demande->date_souhaite=$request->datesouhaite;
                        $demande->date_prev_OF=$request->dateprevue;
                        $demande->quantite=$request->quantite;
                        $demande->fonctions_outillage=$request->fonctionoutil;
                        $demande->gain_attendu=$request->gainattendu;
                        $demande->gain_attendu_value=$request->montant;
                        Schema::disableForeignKeyConstraints();
                        $demande->save();
                        Schema::enableForeignKeyConstraints();
                    
                        }

                public function soumettre(Request $request){
                    $demande=Glpiplugindemandeoutillagedemande::find($request->id);
                    $demande->etap="LIVRAISON";
                    $demande->statusofdemande="SOUMIS LIVRAISON";
                    $demande->commentvalidation=$request->input('comment');
                    Schema::disableForeignKeyConstraints();
                    $demande->save();
                    Schema::enableForeignKeyConstraints();
                
                    return "LIVRAISON SOUMISE";
                
                    }
        //rejeter la demande par coordinateur
public function rejeterByCoord(Request $request,$id){

    $demande=Glpiplugindemandeoutillagedemande::find($id);
    $demande->statusfdevalidation="Rejetée";
    $demande->rejeterpar=COORDINATEURBE;
    $demande->commentvalidation=$request->input('comment');
    $demande->coordinateurvalidateurID=$_SESSION[GLPIID];
    $demande->etap="REFERENT OUTILLAGE";
    $demande->statusofdemande="_";
    Schema::disableForeignKeyConstraints();
    $demande->save();
    Schema::enableForeignKeyConstraints();
    return redirect()->action(
        'ActionController@showCoord',['id' => $id]);
    }

     //set stat to BE PAS COMMENCE
public function setstattoBEPASCOMMENCE(Request $request){

    $demande=Glpiplugindemandeoutillagedemande::find($request->id);
    $demande->statusofdemande="BE Pas commencé";
    $demande->save();
    return "BE Pas commencé";
    }
         //set stat to EN COURS
public function setstattoENCOURS(Request $request){

    $demande=Glpiplugindemandeoutillagedemande::find($request->id);
    $demande->statusofdemande="BE En cours";
    $demande->save();
    return "BE En cours";
    }
         //set stat to BE STAND-BY
public function setstattoSTANDBY(Request $request){

    $demande=Glpiplugindemandeoutillagedemande::find($request->id);
    $demande->statusofdemande="BE Stand-By";
    $demande->save();
    return "BE Stand-By";
    }
     //set stat to BE STAND-BY
public function setstattoWithout(Request $request){

    $demande=Glpiplugindemandeoutillagedemande::find($request->id);
    $demande->statusofdemande="_";
    $demande->save();
    return "_";
    }
     //set stat to BE STAND-BY
public function setstattoANNULE(Request $request){

    $demande=Glpiplugindemandeoutillagedemande::find($request->id);
    $demande->statusofdemande="Annulée";
    $demande->etap="DEMANDEUR";
    $demande->save();
    return "La demande a été Annulée";
    }
         //set stat to CLOSE BE
public function setstattoCLOSEBE(Request $request){

    $demande=Glpiplugindemandeoutillagedemande::find($request->id);
    if( $demande->partieetude->datefinetude!=null)
    {
        $demande->statusofdemande="En cours Fab";
        $demande->etap="METHODE FAB";
        $demande->save();
        return "En cours Fab";
    }
    else
    {
        return "Specifier la date fin d'etude";
    }
   
    }

             //set stat to EN COURS FAB
public function setstattoENCOURSFAB(Request $request){
    $demande=Glpiplugindemandeoutillagedemande::find($request->id);
    $demande->statusofdemande="En cours Fab";
    $demande->save();
    return "En cours Fab";
    }

                 //set stat to STAND-BY FAB
public function setstattoSTANDBYFAB(Request $request){

    $demande=Glpiplugindemandeoutillagedemande::find($request->id);
    $demande->statusofdemande="Fab Stand-By";
    $demande->save();
    return "Fab Stand-By";
    }

     //actionProj add etude  donnees
     public function actionProj(Request $request,$id){
        $demande=Glpiplugindemandeoutillagedemande::find($id);
        $partieetude=$demande->partieetude;
        $partieetude->datededutetude=$request->input('datededutetude');
        $partieetude->delaisfinetude=$request->input('delaisfinetude');
        $partieetude->glpiplugindemandeoutillageprojeteur_id=$demande->glpiplugindemandeoutillageprojeteur_id;
        $partieetude->reeletude3D=$request->input('reeletude3D');
        $partieetude->reellaisse2D=$request->input('reellaisse2D');
        $partieetude->reelverification2D=$request->input('reelverification2D');
        $partieetude->percentetude3D=floatval(substr($request->input('percentetude3D'), 0, -1));
        $partieetude->percentlaisse2D=floatval(substr($request->input('percentlaisse2D'), 0, -1));
        $partieetude->percentverification2D=floatval(substr($request->input('percentverification2D'), 0, -1));
        $partieetude->reeltotal=$request->input('reeltotal');
        $partieetude->percenttotal=floatval(substr($request->input('percenttotal'), 0, -1));
        $partieetude->save();
        return redirect()->action(
            'ActionController@showProj',['id' => $id]);
        }

    //action COORDINNATEUR add etude  donnees
    public function actionCoord(Request $request,$id){
        $demande=Glpiplugindemandeoutillagedemande::find($id);
        $partieetude=$demande->partieetude;
        $partieetude->datededutetude=$request->input('datededutetude');
        $partieetude->delaisfinetude=$request->input('delaisfinetude');
        $partieetude->datefinetude=$request->input('datefinetude');
        $user=Glpi_user::find($_SESSION[GLPIID]);
        $partieetude->glpiplugindemandeoutillagecoordinateur_id=$user->coordinateur->id;
        $partieetude->estimationetude3D=$request->input('estimationetude3D');
        $partieetude->estimationlaisse2D=$request->input('estimationlaisse2D');
        $partieetude->estimationverification2D=$request->input('estimationverification2D');
        $partieetude->estimationtotal=$request->input('estimationetude3D')+$request->input('estimationlaisse2D')+$request->input('estimationverification2D');
        $partieetude->percentetude3D=(floatval(substr($request->input('percentetude3D'), 0, -1))!=0)?floatval(substr($request->input('percentetude3D'), 0, -1)):null;
        $partieetude->percentlaisse2D=(floatval(substr($request->input('percentlaisse2D'), 0, -1))!=0)?floatval(substr($request->input('percentlaisse2D'), 0, -1)):null;
        $partieetude->percentverification2D=(floatval(substr($request->input('percentverification2D'), 0, -1))!=0)?floatval(substr($request->input('percentverification2D'), 0, -1)):null;
        $partieetude->percenttotal=(floatval(substr($request->input('percenttotal'), 0, -1))!=0)?floatval(substr($request->input('percenttotal'), 0, -1)):null;
        $partieetude->save();
        return redirect()->action(
            'ActionController@showCoord',['id' => $id]);
        }
           //action COORDINNATEUR add bilan
    public function actionCoordBilan(Request $request,$id){
        $demande=Glpiplugindemandeoutillagedemande::find($id);
        $demande->periodicite = $request->input('periodicite');
        Schema::disableForeignKeyConstraints();
        $demande->save();
        Schema::enableForeignKeyConstraints();
        return redirect()->action(
            'ActionController@showCoord',['id' => $id]);
        }

        //actionAtelier add partie fabrication
     public function actionAtelier(Request $request,$id){
        $demande=Glpiplugindemandeoutillagedemande::find($id);
        $partiefab=$demande->partiefab;
        $partiefab->datededutfab=$request->input('datedebutfab');
        $partiefab->estimationfab=$request->input('estimationtotal');
        $partiefab->reelfab=$request->input('reeltotal');
        $partiefab->cout_outil=$request->input('coutoutil');
        $partiefab->delaisfinfab=$request->input('delaiestimelivr');
        $partiefab->datefinfab=$request->input('datefinfab');
        $partiefab->percenttotal=floatval(substr($request->input('pourcentage'), 0, -1));
        $user=Glpi_user::find($_SESSION[GLPIID]);
        $partiefab->glpiplugindemandeoutillageatelier_id=$user->atelier->id;

        $partiefab->save();
        return redirect()->action(
            'ActionController@showAtelier',['id' => $id]);
        }

 //Soumis livraison by methode fab
 public function soumisbymethodefab(Request $request,$id){

    $demande=Glpiplugindemandeoutillagedemande::find($id);
    $demande->coordinateurvalidateurID=$_SESSION[GLPIID];
    $demande->etap="LIVRAISON";
    $demande->statusofdemande="SOUMIS LIVRAISON";
    Schema::disableForeignKeyConstraints();
    $demande->save();
    Schema::enableForeignKeyConstraints();

    return redirect()->action(
        'ActionController@showAtelier', ['id' => $id]);

    }

 //approuver demande livraison  par demande
 public function approverLivraisonBydemandeur(Request $request,$id){

    $demande=Glpiplugindemandeoutillagedemande::find($id);
    $demande->statusfdevalidation="Approuvée";
    $demande->approuverpar="DEMANDEUR";
    $demande->commentvalidation=$request->input('comment');
    $demande->etap="LIVRAISON";
    $demande->statusofdemande="Livré Client";
    Schema::disableForeignKeyConstraints();
    $demande->save();
    Schema::enableForeignKeyConstraints();

    return redirect()->action(
        'ActionController@showDemandeur', ['id' => $id]);

    }
     //approuver demande livraison  par demande
 public function approverBydemandeur(Request $request,$id){

    $demande=Glpiplugindemandeoutillagedemande::find($id);
    $demande->statusfdevalidation="En attente";
    $demande->approuverpar="DEMANDEUR";
    $demande->etap="REFERENT OUTILLAGE";
    $demande->statusofdemande="_";
    Schema::disableForeignKeyConstraints();
    $demande->save();
    Schema::enableForeignKeyConstraints();

    return redirect()->action(
        'ActionController@showDemandeur', ['id' => $id]);

    }

 //rejeter demande livraison  par demande
 public function rejeterLivraisonBydemandeur(Request $request,$id){

    $demande=Glpiplugindemandeoutillagedemande::find($id);
    $demande->statusfdevalidation="Rejetée";
    $demande->rejeterpar="DEMANDEUR";
    $demande->commentvalidation=$request->input('comment');
    $demande->etap="METHODE FAB";
    $demande->statusofdemande="En cours Fab";
    Schema::disableForeignKeyConstraints();
    $demande->save();
    Schema::enableForeignKeyConstraints();

    return redirect()->action(
        'ActionController@showDemandeur', ['id' => $id]);

    }
    //modify demande by coord 
public function modifydemandebycoord(Request $request,$id){
    $icons = [
        'pdf' => 'pdf',
        'doc' => 'word',
        'docx' => 'word',
        'xls' => 'excel',
        'xlsx' => 'excel',
        'CSV' => 'excel',
        'csv' => 'excel',
        'xlsm' => 'excel',
        'ppt' => 'powerpoint',
        'pptx' => 'powerpoint',
        'txt' => 'text',
        'png' => 'image',
        'jpg' => 'image',
        'jpeg' => 'image',
    ];

    $demande=Glpiplugindemandeoutillagedemande::find($id);
    $demande->glpiplugindemandeoutillageporteur_id=$request->input('porteur');
    $demande->num_CAPEX=$request->input('capex');
    $demande->code_project=$request->input('codeprojet');
    $demande->ref_pn_impacte=$request->input('refpnimpacte');
    $demande->pn=$request->input('pn');
    $demande->datecreation=date("Y-m-d");
    $demande->date_souhaite=$request->input('datesouhaite');
    $demande->date_prev_OF=$request->input('dateprevue');
    $demande->quantite=$request->input('quantite');
    $demande->fonctions_outillage=$request->input('fonctionoutil');
    $demande->gain_attendu=$request->input('gainattendu');
    $demande->gain_attendu_value=$request->input('montant');
    $demande->comments=$request->input('comments'); 
    $demande->degre_priorite=$request->input('degrepriorite');

    $today=date("Y-m-d");
    $nbcommandejour=Glpiplugindemandeoutillagedemande::whereDate('created_at','=',$today)->count();
    $demande->nb_commande_du_jour=$nbcommandejour;
    
    $demande->ref_outillage=$request->input('refoutillage');
    Schema::disableForeignKeyConstraints();
       $demande->save();
    $nbcommandejour=Glpiplugindemandeoutillagedemande::whereDate('created_at','=',$today)->count();
    $demande->nb_commande_du_jour=$nbcommandejour;
    
    $demande->ref_outillage=$request->input('refoutillage');
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
    
$listdesprojteurs=Glpiplugindemandeoutillageprojeteur::all();
$listporteurs=Glpiplugindemandeoutillageporteur::all();
//get files of demande
$filesofdemande = Glpiplugindemandeoutillagedemandefile::where('demandeID','=',$id)->get();

   return view('action.showCoord',['demande'=>$demande,'listdesprojteurs'=>$listdesprojteurs,'filesofdemande'=>$filesofdemande,'listporteurs'=>$listporteurs,'icons'=>$icons]);
}
// modifer demande par referent
public function modifydemandebyreferent(Request $request,$id){
    $icons = [
        'pdf' => 'pdf',
        'doc' => 'word',
        'docx' => 'word',
        'xls' => 'excel',
        'xlsx' => 'excel',
        'CSV' => 'excel',
        'csv' => 'excel',
        'xlsm' => 'excel',
        'ppt' => 'powerpoint',
        'pptx' => 'powerpoint',
        'txt' => 'text',
        'png' => 'image',
        'jpg' => 'image',
        'jpeg' => 'image',
    ];

    $demande=Glpiplugindemandeoutillagedemande::find($id);
    $demande->glpiplugindemandeoutillageporteur_id=$request->input('porteur');
    $demande->num_CAPEX=$request->input('capex');
    $demande->code_project=$request->input('codeprojet');
    $demande->ref_pn_impacte=$request->input('refpnimpacte');
    $demande->pn=$request->input('pn');
    $demande->datecreation=date("Y-m-d");
    $demande->date_souhaite=$request->input('datesouhaite');
    $demande->date_prev_OF=$request->input('dateprevue');
    $demande->quantite=$request->input('quantite');
    $demande->fonctions_outillage=$request->input('fonctionoutil');
    $demande->gain_attendu=$request->input('gainattendu');
    $demande->gain_attendu_value=$request->input('montant');
    $demande->comments=$request->input('comments'); 
    $demande->degre_priorite=$request->input('degrepriorite');

    $today=date("Y-m-d");
    $nbcommandejour=Glpiplugindemandeoutillagedemande::whereDate('created_at','=',$today)->count();
    $demande->nb_commande_du_jour=$nbcommandejour;
    
    $demande->ref_outillage=$request->input('refoutillage');
    Schema::disableForeignKeyConstraints();
       $demande->save();
    $nbcommandejour=Glpiplugindemandeoutillagedemande::whereDate('created_at','=',$today)->count();
    $demande->nb_commande_du_jour=$nbcommandejour;
    
    $demande->ref_outillage=$request->input('refoutillage');
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
    
$listdesprojteurs=Glpiplugindemandeoutillageprojeteur::all();
$listporteurs=Glpiplugindemandeoutillageporteur::all();
//get files of demande
$filesofdemande = Glpiplugindemandeoutillagedemandefile::where('demandeID','=',$id)->get();

   return view('action.show',['demande'=>$demande,'listdesprojteurs'=>$listdesprojteurs,'filesofdemande'=>$filesofdemande,'listporteurs'=>$listporteurs,'icons'=>$icons]);
}
//affecter au referent by coordinateur BE
public function affecteraureferent(Request $request,$id){

    $demande=Glpiplugindemandeoutillagedemande::find($id);
    $demande->statusfdevalidation="En attente";
    $demande->etap="REFERENT OUTILLAGE";
    $demande->commentvalidation=$request->input('comment');
    $demande->statusofdemande="_";
    $demande->affecterpar="COORDINATEUR BE";

    $demande->save();

    return redirect()->action(
        'ActionController@showCoord', ['id' => $demande->id]);

    }

    //affecter au referent by methode fab
public function affecteraureferentbymethodefab(Request $request,$id){

    $demande=Glpiplugindemandeoutillagedemande::find($id);
    $demande->statusfdevalidation="En attente";
    $demande->etap="REFERENT OUTILLAGE";
    $demande->commentvalidation=$request->input('comment');
    $demande->statusofdemande="_";
    $demande->affecterpar="METHODE FAB";

    $demande->save();

    return redirect()->action(
        'ActionController@showAtelier', ['id' => $demande->id]);

    }

    //affecter au coordinateur BE by methode fab
public function affecteraucoordbymethodefab(Request $request,$id){

    $demande=Glpiplugindemandeoutillagedemande::find($id);
        $demande->statusfdevalidation="Approuvée";
        $demande->etap="COORDINATEUR BE";
        $demande->commentvalidation=$request->input('comment');
        $demande->approuverpar="REFERENT OUTILLAGE";
        $demande->statusofdemande="_";
        $demande->affecterpar="METHODE FAB";

    $demande->save();

    return redirect()->action(
        'ActionController@showAtelier', ['id' => $demande->id]);

    }
        // permet de supprimer le porteur
        public function supprimerDemande(Request $request){
            $demande=Glpiplugindemandeoutillagedemande::find($request->id);
            $demandefiles=Glpiplugindemandeoutillagedemandefile::where('demandeID',$demande->id);
            foreach ($demandefiles as $file) {
                $file->delete();
            }
            $partieetude=$demande->partieetude;
            $partieetude->delete(); 
            $partiefab=$demande->partiefab;
            $partiefab->delete(); 
            Schema::disableForeignKeyConstraints();
            $demande->save();
            Schema::enableForeignKeyConstraints();
            $demande->delete(); 
        }
}



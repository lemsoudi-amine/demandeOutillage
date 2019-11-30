<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Illuminate\Support\Facades\Storage;
use App\Glpiplugindemandeoutillagesectionutilisateur;
use App\Glpiplugindemandeoutillagecoordinateur;
use App\Glpiplugindemandeoutillageatelier;
use App\Glpiplugindemandeoutillageporteur;
use App\Glpiplugindemandeoutillageprojeteur;
use App\Glpiplugindemandeoutillagedemande;
use Illuminate\Support\Facades\Schema;
use App\Glpi_user;
use Illuminate\Support\Facades\Input;
use App\Glpiplugindemandeoutillagedemandepartieetude;
use App\Glpiplugindemandeoutillagedemandepartiefab;

class UploadFileController extends Controller
{
    public function import(Request $request){
        if(Input::hasFile('fileParametres') and !Input::hasFile('fileCommandes')){
            $a=$this->importParametres($request);
            // redirection à la page des sections
            $listsections=Glpiplugindemandeoutillagesectionutilisateur::all();
            return view('section.index',['listsections'=>$listsections,'sizelist'=>sizeof($listsections),'statcode'=>$a]);
        }

        else if(!Input::hasFile('fileParametres') and Input::hasFile('fileCommandes')){
            $b=$this->importCommandes($request);
            // redirection à la page des sections
            $listsections=Glpiplugindemandeoutillagesectionutilisateur::all();
            return view('section.index',['listsections'=>$listsections,'sizelist'=>sizeof($listsections),'statcode'=>$b[0],'detail'=>$b]);
        }
        else if(Input::hasFile('fileParametres') and Input::hasFile('fileCommandes')){
            $a=$this->importParametres($request);
            $b=$this->importCommandes($request);
            // redirection à la page des sections
            $listsections=Glpiplugindemandeoutillagesectionutilisateur::all();
            return view('section.index',['listsections'=>$listsections,'sizelist'=>sizeof($listsections),'statcode'=>($a==500 or $b==800)?500:400]);
        }
        else {
            $listsections=Glpiplugindemandeoutillagesectionutilisateur::all();
            return view('section.index',['listsections'=>$listsections,'sizelist'=>sizeof($listsections),'statcode'=>600]);
        }
    }

    public function importParametres(Request $request){
        $file = $request->file('fileParametres')->store('upload');
        $reader = new Xlsx();
        $spreadsheet = $reader->load(realpath(Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix().$file));

        // Tester si le format du fichier est bon
        $isBadFormat=0;
        $spreadsheet->setActiveSheetIndex(0);
        $worksheet = $spreadsheet->getActiveSheet();
        $spreadsheetdata = $worksheet->getCellByColumnAndRow(1,1)->getValue();
        if(strcasecmp($spreadsheetdata,"n° sections")<>0){
            $isBadFormat=1;
        }
        else{
            $spreadsheet->setActiveSheetIndex(1);
            $worksheet = $spreadsheet->getActiveSheet();
            $spreadsheetdata = $worksheet->getCellByColumnAndRow(1,1)->getValue();
            if(strcasecmp($spreadsheetdata,"porteur")<>0){
                $isBadFormat=1;
            }
            else{
                $spreadsheet->setActiveSheetIndex(2);
                $worksheet = $spreadsheet->getActiveSheet();
                $spreadsheetdata = $worksheet->getCellByColumnAndRow(1,1)->getValue();
                if(strcasecmp($spreadsheetdata,"projeteur")<>0){
                    $isBadFormat=1;
                }
                else{
                    $spreadsheet->setActiveSheetIndex(3);
                    $worksheet = $spreadsheet->getActiveSheet();
                    $spreadsheetdata = $worksheet->getCellByColumnAndRow(1,1)->getValue();
                    if(strcasecmp($spreadsheetdata,"atelier")<>0){
                        $isBadFormat=1;
                    }
                    else{

                    $spreadsheet->setActiveSheetIndex(4);
                    $worksheet = $spreadsheet->getActiveSheet();
                    $spreadsheetdata = $worksheet->getCellByColumnAndRow(1,1)->getValue();
                    if(strcasecmp($spreadsheetdata,"COORDINATEUR BE")<>0){
                        $isBadFormat=1;
                    }
                    }
                }
            }
        }
        
        if($isBadFormat==1){
            return 500;
        } 

        else {
            // get Sections
            $spreadsheet->setActiveSheetIndex(0);
            $spreadsheetdata = $spreadsheet->getActiveSheet()->toArray(NULL,FALSE,FALSE);
            for ($i = 1; $i <sizeof($spreadsheetdata); $i++) {
                $sectionBD = Glpiplugindemandeoutillagesectionutilisateur::where('num_section',$spreadsheetdata[$i][0])->first();
                if($sectionBD==null){
                    $section = new Glpiplugindemandeoutillagesectionutilisateur();
                    $section->num_section=$spreadsheetdata[$i][0];
                    $section->nameofsection=$spreadsheetdata[$i][2];
                    $section->refeent_secteur=$spreadsheetdata[$i][1];
                    $section->service=$spreadsheetdata[$i][3];
                    $refsecteu=$section->refeent_secteur;
                    $splitName = explode('.', $refsecteu, 2); // Restricts it to only 2 values, for names like Billy Bob Jones
                
                    $first_name = $splitName[0];
                    $last_name = !empty($splitName[1]) ? $splitName[1] : $first_name; // If last name doesn't exist, make it empty
                    
                    $glpiuser=Glpi_user::where('realname',"=",$last_name)->first();
                    empty($glpiuser) ? $section->Glpi_user_id=null: $section->Glpi_user_id=$glpiuser->id;
                    
                    Schema::disableForeignKeyConstraints();
                    $section->save();
                    Schema::enableForeignKeyConstraints();
                }
                else{
                    if($sectionBD->nameofsection<>$spreadsheetdata[$i][2] or $sectionBD->refeent_secteur<>$spreadsheetdata[$i][1]){
                        $sectionBD->nameofsection=$spreadsheetdata[$i][2];
                        $sectionBD->refeent_secteur=$spreadsheetdata[$i][1];
                        $refsecteu=$sectionBD->refeent_secteur;
                        $splitName = explode('.', $refsecteu, 2); // Restricts it to only 2 values, for names like Billy Bob Jones
                    
                        $first_name = $splitName[0];
                        $last_name = !empty($splitName[1]) ? $splitName[1] : $first_name; // If last name doesn't exist,
                        $glpiuser=Glpi_user::where('realname',"=",$last_name)->first();
                        empty($glpiuser) ? $sectionBD->Glpi_user_id=null: $sectionBD->Glpi_user_id=$glpiuser->id;
                        
                        Schema::disableForeignKeyConstraints();
                        $sectionBD->save();
                        Schema::enableForeignKeyConstraints();
                    }

                }
                
            }    
            // get Porteurs
            $spreadsheet->setActiveSheetIndex(1);
            $spreadsheetdata = $spreadsheet->getActiveSheet()->toArray(NULL,FALSE,FALSE);
            for ($i = 1; $i <sizeof($spreadsheetdata); $i++) {
                $porteurBD = Glpiplugindemandeoutillageporteur::where('nameofporteur',$spreadsheetdata[$i][0])->first();
                if($porteurBD==null){
                    $porteur = new Glpiplugindemandeoutillageporteur();
                    $porteur->nameofporteur=$spreadsheetdata[$i][0];
                    $porteur->save();
                }
            }

            // get Projeteurs
            $spreadsheet->setActiveSheetIndex(2);
            $spreadsheetdata = $spreadsheet->getActiveSheet()->toArray(NULL,FALSE,FALSE);
            for ($i = 1; $i <sizeof($spreadsheetdata); $i++) {
                $projeteurBD = Glpiplugindemandeoutillageprojeteur::where('nameofprojeteur',$spreadsheetdata[$i][0])->first();
                if($projeteurBD==null){
                    $projeteur = new Glpiplugindemandeoutillageprojeteur();
                    $projeteur->nameofprojeteur=$spreadsheetdata[$i][0];
                    $nameofprojeteur = $projeteur->nameofprojeteur;

                    $splitName = explode('.', $nameofprojeteur, 2); // Restricts it to only 2 values, for names like Billy Bob Jones
                
                    $first_name = $splitName[0];
                    $last_name = !empty($splitName[1]) ? $splitName[1] : $first_name; // If last name doesn't exist, make it empty
                    $glpiuser=Glpi_user::where('realname',"=",$last_name)->first();
                    empty($glpiuser) ? $projeteur->Glpi_user_id=null: $projeteur->Glpi_user_id=$glpiuser->id;

                    Schema::disableForeignKeyConstraints();
                    $projeteur->save();
                    Schema::enableForeignKeyConstraints();                   
                }
            }
            // get Ateliers
            $spreadsheet->setActiveSheetIndex(3);
            $spreadsheetdata = $spreadsheet->getActiveSheet()->toArray(NULL,FALSE,FALSE);
            for ($i = 1; $i <sizeof($spreadsheetdata); $i++) {
                $atelierBD = Glpiplugindemandeoutillageatelier::where('nameofatelier',$spreadsheetdata[$i][0])->first();
                if($atelierBD==null){
                    $atelier = new Glpiplugindemandeoutillageatelier();
                    $atelier->nameofatelier=$spreadsheetdata[$i][0];
                    
                    $nameofatelier=$atelier->nameofatelier;
                    $splitName = explode('.', $nameofatelier, 2); // Restricts it to only 2 values, for names like Billy Bob Jones
                
                    $first_name = $splitName[0];
                    $last_name = !empty($splitName[1]) ? $splitName[1] : $first_name; // If last name doesn't exist, make it empty
                    $glpiuser=Glpi_user::where('realname',"=",$last_name)->first();
                    empty($glpiuser) ? $atelier->Glpi_user_id=null: $atelier->Glpi_user_id=$glpiuser->id;

                    Schema::disableForeignKeyConstraints();
                    $atelier->save();
                    Schema::enableForeignKeyConstraints();
                }
            }

            // get Coordinateurs
            $spreadsheet->setActiveSheetIndex(4);
            $spreadsheetdata = $spreadsheet->getActiveSheet()->toArray(NULL,FALSE,FALSE);
            for ($i = 1; $i <sizeof($spreadsheetdata); $i++) {
                $coordinateurBD = Glpiplugindemandeoutillagecoordinateur::where('nameofcoordinateur',$spreadsheetdata[$i][0])->first();
                if($coordinateurBD==null){
                    $coordinateur = new Glpiplugindemandeoutillagecoordinateur();
                    $coordinateur->nameofcoordinateur=$spreadsheetdata[$i][0];
                    
                    $nameofcoordinateur=$coordinateur->nameofcoordinateur;
                    $splitName = explode('.', $nameofcoordinateur, 2); // Restricts it to only 2 values, for names like Billy Bob Jones
                
                    $first_name = $splitName[0];
                    $last_name = !empty($splitName[1]) ? $splitName[1] : $first_name; // If last name doesn't exist, make it empty
                    $glpiuser=Glpi_user::where('realname',"=",$last_name)->first();
                    empty($glpiuser) ? $coordinateur->Glpi_user_id=null: $coordinateur->Glpi_user_id=$glpiuser->id;

                    Schema::disableForeignKeyConstraints();
                    $coordinateur->save();
                    Schema::enableForeignKeyConstraints();
                }
            }

            // Suppresion du fichier

            Storage::delete($file);
            return 400;
        }
    }

    public function importCommandes(Request $request){
        $file = $request->file('fileCommandes')->store('upload');
        $reader = new Xlsx();
        
        $spreadsheet = $reader->load(realpath(Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix().$file));
        $spreadsheet->setActiveSheetIndex(0);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();

        // Tester si le format du fichier est bon
        $isBadFormat=0;
        $spreadsheetdata = $worksheet->getCellByColumnAndRow(4,9)->getValue();
        if(strcasecmp($spreadsheetdata,"RÉFÉRENCE DEMANDE")<>0){
            $isBadFormat=1;
        }

        if($isBadFormat==0){
            $log = array();
            $nombreDeLigneInserees=0;
            $nombreDeLigneRejetees=0;
            for ($i = 10; $i <= $highestRow; $i++) {
                if($worksheet->getCellByColumnAndRow(4, $i)->getValue()<>''){
                    $sectionBD = Glpiplugindemandeoutillagesectionutilisateur::where('num_section',$worksheet->getCellByColumnAndRow(7, $i)->getValue())->first();
                    $porteurBD = Glpiplugindemandeoutillageporteur::where('nameofporteur',$worksheet->getCellByColumnAndRow(8, $i)->getValue())->first();
                    if($sectionBD<>null and $porteurBD<>null){
                        $ref_demande_array = explode('_',$worksheet->getCellByColumnAndRow(4, $i)->getValue());
                        if(count($ref_demande_array)==7){
                            $ref_demande = $ref_demande_array[1].'_'.substr($ref_demande_array[2],2,2).'/'.str_pad($ref_demande_array[3],2, "0",STR_PAD_LEFT).'/'.str_pad($ref_demande_array[4],2, "0",STR_PAD_LEFT).'_'.$ref_demande_array[5].''.$ref_demande_array[6];
                            $demandeBD = Glpiplugindemandeoutillagedemande::where('ref_commande',$ref_demande)->first();
                            if($demandeBD==null){
                                $demande = new Glpiplugindemandeoutillagedemande();
                                $demande->ref_commande=$ref_demande;
                                $demande->type_intervention=$worksheet->getCellByColumnAndRow(5, $i)->getValue();
                                $demande->glpiplugindemandeoutillagesectionutilisateur_id=$sectionBD->id;
                                $demande->glpiplugindemandeoutillageporteur_id=$porteurBD->id;
                                $demande->ref_pn_impacte=$worksheet->getCellByColumnAndRow(9, $i)->getValue();
                                $demande->fonctions_outillage=$worksheet->getCellByColumnAndRow(10, $i)->getValue();
                                $demande->statusofdemande=$worksheet->getCell('K'.$i)->getValue();
                                $demande->comments=$worksheet->getCellByColumnAndRow(12, $i)->getValue();
                                $demande->code_project=$worksheet->getCell('AB'.$i)->getValue();
                                $demande->num_CAPEX=$worksheet->getCell('AC'.$i)->getValue();
                                $demande->pn=$worksheet->getCell('AD'.$i)->getValue();
                                $demande->ref_outillage=$worksheet->getCell('AE'.$i)->getValue();
                                $demande->quantite=$worksheet->getCell('AK'.$i)->getValue();
                                if($worksheet->getCell('K'.$i)->getValue()=="BE En cours" OR $worksheet->getCell('K'.$i)->getValue()=="BE Pas commencé"){
                                    $demande->etap="PROJETEUR";
                                }
                                elseif($worksheet->getCell('K'.$i)->getValue()=="BE Stand-By"){
                                    if($worksheet->getCell('M'.$i)->getValue()!=null){
                                        $demande->etap="PROJETEUR";
                                    }
                                    else{
                                    $demande->etap="COORDINATEUR BE";}
                                }
                                elseif($worksheet->getCell('K'.$i)->getValue()=="Clos BE/En cours Fab"){
                                    $demande->etap="METHODE FAB";
                                }
                                elseif($worksheet->getCell('K'.$i)->getValue()=="Livré Client"){
                                    $demande->etap="LIVRAISON";
                                }
                                else{
                                    $demande->etap="DEMANDEUR";
                                }
                                if(strcasecmp($worksheet->getCell('AL'.$i)->getValue(),"En € à l'année")==0){
                                    $gainAttendu = 1;
                                }
                                else if(strcasecmp($worksheet->getCell('AL'.$i)->getValue(),"en ergonomie")==0){
                                    $gainAttendu = 2;
                                }
                                else if(strcasecmp($worksheet->getCell('AL'.$i)->getValue(),"En sécurité")==0){
                                    $gainAttendu = 3;
                                }
                                else if(strcasecmp($worksheet->getCell('AL'.$i)->getValue(),"Réparation")==0){
                                    $gainAttendu = 4;
                                }
                                else if(strcasecmp($worksheet->getCell('AL'.$i)->getValue(),"Maîtrise des procédés")==0){
                                    $gainAttendu = 5;
                                }
                                else{
                                    $gainAttendu = 1;
                                }                            
                                $demande->gain_attendu=  $gainAttendu;
                                $demande->gain_attendu_value=$worksheet->getCell('AM'.$i)->getValue();
                                $demande->datecreation=\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($worksheet->getCell('Z'.$i)->getValue());
                                $demande->date_souhaite=\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($worksheet->getCell('AA'.$i)->getValue());
                                //$demande->date_prev_OF='2018-01-01';
                                $nombreDeLigneInserees++;
                                // add projeteur of demande
                                $projeteurname = $worksheet->getCell('M'.$i)->getValue();
                                // Restricts it to only 2 values, for names like Billy Bob Jones
                                $splitName = explode(' ', $projeteurname, 2);
                                if(sizeof($splitName)==2){
                                    $projeteur = Glpiplugindemandeoutillageprojeteur::where('nameofprojeteur','like',$splitName[1].'%'.$splitName[0])->first();
                                if(!empty($projeteur)){
                                    $demande->glpiplugindemandeoutillageprojeteur_id=$projeteur->id;
                                }

                                }
                                
                                $partieetude=new Glpiplugindemandeoutillagedemandepartieetude();
                                $partiefab=new Glpiplugindemandeoutillagedemandepartiefab();
                                $partieetude->save();
                                $partiefab->save();
                                $demande->glpiplugindemandeoutillagedemandepartieetude_id=$partieetude->id;
                                $demande->glpiplugindemandeoutillagedemandepartiefab_id=$partiefab->id;
                                // partie etude
                                                              
                                if(!empty($projeteur)){
                                    $partieetude->glpiplugindemandeoutillageprojeteur_id=$projeteur->id;
                                }
                                //if($worksheet->getCell('BE'.$i)->getValue()!=null){
                                //$partieetude->estimationetude3D=$worksheet->getCell('BE'.$i)->getValue();
                                //}
                                //if($worksheet->getCell('BF'.$i)->getValue()!=null){
                                //$partieetude->estimationlaisse2D=$worksheet->getCell('BF'.$i)->getValue();
                                //}
                                //if($worksheet->getCell('BG'.$i)->getValue()!=null){
                                //$partieetude->estimationverification2D=$worksheet->getCell('BG'.$i)->getValue();}
                                $partieetude->estimationtotal=intval($worksheet->getCell('S'.$i)->getValue());
                                //if($worksheet->getCell('BH'.$i)->getValue()!=null){
                                //$partieetude->reeletude3D=$worksheet->getCell('BH'.$i)->getValue();}
                                //if($worksheet->getCell('BI'.$i)->getValue()!=null){
                                //$partieetude->reellaisse2D=$worksheet->getCell('BI'.$i)->getValue();}
                                //if($worksheet->getCell('BJ'.$i)->getValue()!=null){
                                //$partieetude->reelverification2D=$worksheet->getCell('BJ'.$i)->getValue();}
                                $partieetude->reeltotal=intval($worksheet->getCell('T'.$i)->getValue());
                                if(intval($worksheet->getCell('S'.$i)->getValue())!=0 AND intval($worksheet->getCell('S'.$i)->getValue())!=null){
                                    $partieetude->percenttotal=round(intval($worksheet->getCell('T'.$i)->getValue())*100/intval($worksheet->getCell('S'.$i)->getValue()));
                                }
                                if($worksheet->getCell('Q'.$i)->getValue()!=null){
                                $partieetude->datededutetude=\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($worksheet->getCell('Q'.$i)->getValue());}
                                //if($worksheet->getCell('AA'.$i)->getValue()!=null){
                                //$partieetude->delaisfinetude=\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($worksheet->getCell('AA'.$i)->getValue());}
                                if($worksheet->getCell('R'.$i)->getValue()!=null){
                                $partieetude->datefinetude=\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($worksheet->getCell('R'.$i)->getCalculatedValue());}
                                
                                // partie FABRICATION

                                //if(!empty($projeteur)){
                                //    $partieetude->glpiplugindemandeoutillageprojeteur_id=$projeteur->id;
                                //}
                                //
                                //if($worksheet->getCell('DE'.$i)->getValue()!=null){
                                //    $partiefab->estimationfab=$worksheet->getCell('DE'.$i)->getValue();
                                //}
                                //if($worksheet->getCell('DF'.$i)->getValue()!=null){
                                //    $partiefab->reelfab=$worksheet->getCell('DF'.$i)->getValue();
                                //}
                                //if(substr($worksheet->getCell('DH'.$i)->getValue(),0,-1)){
                                 //   $partiefab->percenttotal=substr($worksheet->getCell('DH'.$i)->getValue(),0,-1);
                                //}
                                if($worksheet->getCell('X'.$i)->getValue()!=null){
                                    $partiefab->datededutfab=\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($worksheet->getCell('X'.$i)->getValue());}
                                if($worksheet->getCell('W'.$i)->getValue()!=null){
                                    $partiefab->delaisfinfab=\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($worksheet->getCell('W'.$i)->getValue());}
                                if($worksheet->getCell('Y'.$i)->getValue()!=null){
                                    $partiefab->datefinfab=\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($worksheet->getCell('Y'.$i)->getCalculatedValue());}
                                if($worksheet->getCell('DF'.$i)->getCalculatedValue()!=""){
                                    $partiefab->tempestimefab=intval($worksheet->getCell('DF'.$i)->getCalculatedValue());
                                }
                                if($i==11){
                                $partiefab->percenttotal=$worksheet->getCell('DH'.$i)->getCalculatedValue()*100;}

                                $partieetude->save();
                                $partiefab->save();

                                Schema::disableForeignKeyConstraints();
                                $demande->save();
                                Schema::enableForeignKeyConstraints();                                
                            }
                            else {
                                array_push($log,"Ligne ".$i." : La commande avec la référence ".$ref_demande." existe déjà dans la base de données");
                                $nombreDeLigneRejetees++;
                            }
                    
                        }
                        else{
                            array_push($log,"Linge ".$i." : Le format de la référence de la demande ".$worksheet->getCellByColumnAndRow(4, $i)->getValue()." n'est pas bon");
                            $nombreDeLigneRejetees++;
                        }
                        
                    }  
                    else {

                        if($sectionBD==null){
                            array_push($log,"Ligne ".$i." : La section ".$worksheet->getCellByColumnAndRow(7, $i)->getValue()." n'existe pas dans la base de données");
                            $nombreDeLigneRejetees++;
                            
                        }
                        else if($porteurBD==null){
                            array_push($log,"Ligne ".$i." : Le porteur ".$worksheet->getCellByColumnAndRow(8, $i)->getValue()." n'existe pas dans la base de données");
                            $nombreDeLigneRejetees++;
                        }
                    } 
                }       
            }
            // Suppression du fichier

            Storage::delete($file);
            return array(700,$nombreDeLigneInserees,$nombreDeLigneRejetees,$log);
        }
        else{
            return array(800);
        }
    }
}

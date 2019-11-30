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

class ExportController extends Controller
{
    public function exportParametres(){

        $reader = new Xlsx();
        $spreadsheet = $reader->load(storage_path().'\import_outillage_IN.xlsx');
        // Export Sections
        $listSections = Glpiplugindemandeoutillagesectionutilisateur::all();
        $spreadsheet->setActiveSheetIndex(0);
        $i=2;
        foreach ($listSections as $section){
            $spreadsheet->getActiveSheet()->setCellValue('A'.$i, $section->num_section);
            $spreadsheet->getActiveSheet()->setCellValue('B'.$i, $section->refeent_secteur);
            $spreadsheet->getActiveSheet()->setCellValue('C'.$i, $section->nameofsection);
            $i++;
            
        }
        $listPorteurs = Glpiplugindemandeoutillageporteur::all();
        $spreadsheet->setActiveSheetIndex(1);
        $i=2;
        foreach ($listPorteurs as $porteur){
            $spreadsheet->getActiveSheet()->setCellValue('A'.$i, $porteur->nameofporteur);
            $i++;
            
        }

        $listProjeteurs = Glpiplugindemandeoutillageprojeteur::all();
        $spreadsheet->setActiveSheetIndex(2);
        $i=2;
        foreach ($listProjeteurs as $projeteur){
            $spreadsheet->getActiveSheet()->setCellValue('A'.$i, $projeteur->nameofprojeteur);
            $i++;
            
        }

        $listAteliers = Glpiplugindemandeoutillageatelier::all();
        $spreadsheet->setActiveSheetIndex(3);
        $i=2;
        foreach ($listAteliers as $atelier){
            $spreadsheet->getActiveSheet()->setCellValue('A'.$i, $atelier->nameofatelier);
            $i++;
            
        }

        $listCoordinateurs = Glpiplugindemandeoutillagecoordinateur::all();
        $spreadsheet->setActiveSheetIndex(4);
        $i=2;
        foreach ($listCoordinateurs as $coordinateur){
            $spreadsheet->getActiveSheet()->setCellValue('A'.$i, $coordinateur->nameofcoordinateur);
            $i++;   
        }

        $spreadsheet->setActiveSheetIndex(0);

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $ran = rand(1,100000);
        $writer->save(storage_path().'\import_outillage_OUT_'.$ran.'.xlsx');
        $path = storage_path('import_outillage_OUT_'.$ran.'.xlsx');
        return response()->download($path,'import outillage.xlsx')->deleteFileAfterSend(true);
    }

    public function exportCommandes(){

        $reader = new Xlsx();
        $spreadsheet = $reader->load(storage_path().'\commande_IN.xlsx');
        // Export Commandes
        $listdemandes = Glpiplugindemandeoutillagedemande::all();
        $spreadsheet->setActiveSheetIndex(0);
        $i=3;
        foreach ($listdemandes as $demande){
            $section = Glpiplugindemandeoutillagesectionutilisateur::where('id',$demande->glpiplugindemandeoutillagesectionutilisateur_id)->first();
            $porteur = Glpiplugindemandeoutillageporteur::where('id',$demande->glpiplugindemandeoutillageporteur_id)->first();
            $spreadsheet->getActiveSheet()->setCellValue('A'.$i, $demande->ref_commande);
            switch ($demande->type_intervention){
                case ("C"):
                            $typeintervention = "CREATION";
                    break;
                case ("D"):
                            $typeintervention = "DUPLICATION";
                    break;
                case ("M"):
                            $typeintervention = "MODIFICATION";
                    break;
                case ("R"):
                            $typeintervention = "REPARATION (direct Atelier)";
                    break;

                default:
                            $typeintervention = "CREATION";
            }
            $spreadsheet->getActiveSheet()->setCellValue('B'.$i, $typeintervention);
            $spreadsheet->getActiveSheet()->setCellValue('C'.$i, $section->refeent_secteur);
            $spreadsheet->getActiveSheet()->setCellValue('D'.$i, $section->num_section);
            $spreadsheet->getActiveSheet()->setCellValue('E'.$i, $porteur->nameofporteur);
            $spreadsheet->getActiveSheet()->setCellValue('F'.$i, $demande->ref_pn_impacte);
            $spreadsheet->getActiveSheet()->setCellValue('G'.$i, $demande->fonctions_outillage);
            $spreadsheet->getActiveSheet()->setCellValue('H'.$i, $demande->datecreation);
            $spreadsheet->getActiveSheet()->setCellValue('I'.$i, $demande->date_souhaite);
            $spreadsheet->getActiveSheet()->setCellValue('J'.$i, $demande->code_project);
            $spreadsheet->getActiveSheet()->setCellValue('K'.$i, $demande->num_CAPEX);
            $spreadsheet->getActiveSheet()->setCellValue('L'.$i, $demande->pn);
            $spreadsheet->getActiveSheet()->setCellValue('M'.$i, $demande->ref_outillage);
            $spreadsheet->getActiveSheet()->setCellValue('N'.$i, $demande->quantite);
            switch ($demande->degre_priorite) {
                case ("1"):
                    $degrepriorite = "LIVRAISON CLIENT BLOQUEE";
                    break;
                case ("2"):
                    $degrepriorite = "MAJEURE";
                    break;
                case ("3"):
                    $degrepriorite = "MINEURE";
                    break;
                case ("4"):
                    $degrepriorite = "EN DEVELOPPEMENT";
                    break;
                default:
                    $degrepriorite = "";
            }
            $spreadsheet->getActiveSheet()->setCellValue('O'.$i, $degrepriorite);
            $spreadsheet->getActiveSheet()->setCellValue('P'.$i, $demande->date_prev_OF);
            $spreadsheet->getActiveSheet()->setCellValue('Q'.$i, $demande->quantite);
            switch ($demande->gain_attendu) {
                case 1:
                    $gainattendu = "En  € à l'année";
                    break;
                case 2:
                    $gainattendu = "En ergonomie";
                    break;
                case 3:
                    $gainattendu = "En sécurité";
                    break;
                case 4:
                    $gainattendu = "Réparation";
                    break;
                case 5:
                    $gainattendu = "Maîtrise des procédés";
                    break;
            
                default:
                    $gainattendu = "";
            }
            $spreadsheet->getActiveSheet()->setCellValue('R'.$i, $gainattendu);
            $spreadsheet->getActiveSheet()->setCellValue('S'.$i, $demande->gain_attendu_value);
            $spreadsheet->getActiveSheet()->setCellValue('T'.$i, $demande->statusofdemande);
            $spreadsheet->getActiveSheet()->setCellValue('U'.$i, $demande->comments);
            $projeteur = Glpiplugindemandeoutillageprojeteur::where('id',$demande->glpiplugindemandeoutillageprojeteur_id)->first();
            if(!empty($projeteur)){
            $spreadsheet->getActiveSheet()->setCellValue('V'.$i, $projeteur->nameofprojeteur);
            }
            $spreadsheet->getActiveSheet()->setCellValue('W'.$i, $demande->ref_outillage);
            $partieetude = $demande->partieetude;
            $spreadsheet->getActiveSheet()->setCellValue('X'.$i, $partieetude->delaisfinetude);
            $spreadsheet->getActiveSheet()->setCellValue('Y'.$i, $partieetude->datededutetude);
            $spreadsheet->getActiveSheet()->setCellValue('Z'.$i, $partieetude->datefinetude);
            $spreadsheet->getActiveSheet()->setCellValue('AA'.$i, $partieetude->estimationtotal);
            $spreadsheet->getActiveSheet()->setCellValue('AB'.$i, $partieetude->reeltotal);
            $spreadsheet->getActiveSheet()->setCellValue('AC'.$i, ($partieetude->estimationtotal - $partieetude->reeltotal) >= 0 ? ($partieetude->estimationtotal - $partieetude->reeltotal) : 0 );
            $spreadsheet->getActiveSheet()->setCellValue('AD'.$i, $demande->pn);
            $partiefab = $demande->partiefab;
            $spreadsheet->getActiveSheet()->setCellValue('AE'.$i, $partiefab->delaisfinfab);
            $spreadsheet->getActiveSheet()->setCellValue('AF'.$i, $partiefab->datededutfab);
            $spreadsheet->getActiveSheet()->setCellValue('AG'.$i, $partiefab->datefinfab);
            $spreadsheet->getActiveSheet()->setCellValue('AH'.$i, $partiefab->estimationfab);
            $spreadsheet->getActiveSheet()->setCellValue('AI'.$i, $partiefab->reelfab);
            $spreadsheet->getActiveSheet()->setCellValue('AJ'.$i, $partiefab->percenttotal);            
            $i++;            
        }
        
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        // générer un nombre aléatoire puis l'ajouter au nom du fichier à télécharger
        $ran = rand(1,100000);
        $writer->save(storage_path().'\commande_OUT_'.$ran.'.xlsx');
        $path = storage_path('commande_OUT_'.$ran.'.xlsx');
        return response()->download($path,'Commandes.xlsx')->deleteFileAfterSend(true);
    }
}

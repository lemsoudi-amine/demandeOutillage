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

class ExportController extends Controller
{
    public function export(){

        $reader = new Xlsx();
        $spreadsheet = $reader->load(storage_path().'\import_outillage_V1.xlsx');
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
        $writer->save(storage_path().'\import_outillage_V2.xlsx');
        $path = storage_path('import_outillage_V2.xlsx');
        return response()->download($path);
    }
}

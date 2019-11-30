<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Glpiplugindemandeoutillagesectionutilisateur;
use App\Glpi_user;
use App\http\Requests\sectionRequest;

class SectionController extends Controller
{
    
   //lister les sections
   public function index(){
    $listsections=Glpiplugindemandeoutillagesectionutilisateur::all();
    return view('section.index',['listsections'=>$listsections,'sizelist'=>sizeof($listsections)]);
}
//affiche les formulaire de creation de la section
public function create(){
    return view('section/create');
}
//enregistrer la section 
public function store(sectionRequest $request){

    $section=new Glpiplugindemandeoutillagesectionutilisateur();
    $section->nameofsection=$request->input('nameofsection');
    $section->num_section=$request->input('num_section');
    $section->refeent_secteur=$request->input('refeent_secteur');

    $refsecteu=$request->input('refeent_secteur');
    $splitName = explode('.', $refsecteu, 2); // Restricts it to only 2 values, for names like Billy Bob Jones

    $first_name = $splitName[0];
    $last_name = !empty($splitName[1]) ? $splitName[1] : $first_name; // If last name doesn't exist, make it empty
    $glpiuser=Glpi_user::where('realname',"=",$last_name)->first();
    empty($glpiuser) ? $section->Glpi_user_id=0: $section->Glpi_user_id=$glpiuser->id;

    Schema::disableForeignKeyConstraints();
    $section->save();
    Schema::enableForeignKeyConstraints();
    $listsections=Glpiplugindemandeoutillagesectionutilisateur::all();
    return view('section.index',['listsections'=>$listsections,'sizelist'=>sizeof($listsections),'statcode'=>200]);
}
//permet de récupérere une section puis de le mettre dans le formulaire pour modifier
public function edit($id){
    $section=Glpiplugindemandeoutillagesectionutilisateur::find($id);
    $listsections=Glpiplugindemandeoutillagesectionutilisateur::all();

    return view('section.edit',['sectiontoedit'=>$section,'listsections'=>$listsections,'sizelist'=>sizeof($listsections)]);
}
// permet de modifier la section 
public function update(sectionRequest $request,$id){
    $section=Glpiplugindemandeoutillagesectionutilisateur::find($id);
    $section->nameofsection=$request->input('nameofsection');
    $section->num_section=$request->input('num_section');
    $section->refeent_secteur=$request->input('refeent_secteur');
   
    $refsecteu=$request->input('refeent_secteur');
    $first_name = $splitName[0];
    $last_name = !empty($splitName[1]) ? $splitName[1] : $first_name; // If last name doesn't exist, make it empty
    $glpiuser=Glpi_user::where('realname',"=",$last_name)->first();
    empty($glpiuser) ? $section->Glpi_user_id=0: $section->Glpi_user_id=$glpiuser->id;
    
    Schema::disableForeignKeyConstraints();
    $section->save();
    Schema::enableForeignKeyConstraints();


    $listsections=Glpiplugindemandeoutillagesectionutilisateur::all();
    return view('section.index',['listsections'=>$listsections,'sizelist'=>sizeof($listsections),'statcode'=>300]);

}
// permet de supprimer la section
public function destroy(Request $request,$id){
    $section=Glpiplugindemandeoutillagesectionutilisateur::find($id);
    $section->delete();  
    $listsections=Glpiplugindemandeoutillagesectionutilisateur::all();
    return redirect('sections');
}

}

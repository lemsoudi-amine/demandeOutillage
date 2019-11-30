<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Glpiplugindemandeoutillageporteur;
use App\http\Requests\porteurRequest;

class PorteurController extends Controller
{
   //lister les porteurs
    public function index(){
        $listporteurs=Glpiplugindemandeoutillageporteur::all();
        return view('porteur.index',['listporteurs'=>$listporteurs,'sizelist'=>sizeof($listporteurs)]);
    }
    //affiche les formulaire de creation du porteur
    public function create(){
        return view('porteur/create');
    }
    //enregistrer le porteur 
    public function store(porteurRequest $request){

        $porteur=new Glpiplugindemandeoutillageporteur();
        $porteur->nameofporteur=$request->input('nameofporteur');
        $porteur->save();
        $listporteurs=Glpiplugindemandeoutillageporteur::all();
        return view('porteur.index',['listporteurs'=>$listporteurs,'sizelist'=>sizeof($listporteurs),'statcode'=>200]);
    }
    //permet de récupérere un porteur puis de le mettre dans le formulaire pour modifier
    public function edit($id){
        $porteur=Glpiplugindemandeoutillageporteur::find($id);
        $listporteurs=Glpiplugindemandeoutillageporteur::all();

        return view('porteur.edit',['porteurtoedit'=>$porteur,'listporteurs'=>$listporteurs,'sizelist'=>sizeof($listporteurs)]);
    }
    // permet de modifier le porteur 
    public function update(porteurRequest $request,$id){
        $porteur=Glpiplugindemandeoutillageporteur::find($id);
        $porteur->nameofporteur=$request->input('nameofporteur');
        $porteur->save();
        $listporteurs=Glpiplugindemandeoutillageporteur::all();
        return view('porteur.index',['listporteurs'=>$listporteurs,'sizelist'=>sizeof($listporteurs),'statcode'=>300]);

    }
    // permet de supprimer le porteur
    public function destroy(Request $request,$id){
        $porteur=Glpiplugindemandeoutillageporteur::find($id);
        $porteur->delete();  
        $listporteurs=Glpiplugindemandeoutillageporteur::all();
        return redirect('porteurs');
        //return view('porteur.index',['listporteurs'=>$listporteurs,'sizelist'=>sizeof($listporteurs),'statcode'=>350]);        
    }

}

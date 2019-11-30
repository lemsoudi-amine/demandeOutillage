<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','DashboardController@home')->name('dashboard');

//Route porteur
Route::get('porteurs','PorteurController@index')->name('porteurs');
Route::put('porteur/{id}','PorteurController@update')->name('porteurs');
Route::get('porteur/edit/{id}','PorteurController@edit')->name('porteurs');
Route::get('porteur/create','PorteurController@create')->name('porteurs');
Route::post('porteurs','PorteurController@store')->name('porteurs');
Route::delete('porteur/{id}','PorteurController@destroy')->name('porteurs');
//Route section
Route::get('sections','SectionController@index')->name('sections');
Route::put('section/{id}','SectionController@update')->name('sections');
Route::get('section/edit/{id}','SectionController@edit')->name('sections');
Route::get('section/create','SectionController@create')->name('sections');
Route::post('sections','SectionController@store')->name('sections');
Route::delete('section/{id}','SectionController@destroy')->name('sections');

//Route demande
Route::get('demandes','DemandeController@index')->name('demandes');
Route::put('demande/{id}','DemandeController@update')->name('demandes');
Route::get('demande/edit/{id}','DemandeController@edit')->name('demandes');
Route::get('demande/show/{id}','DemandeController@show')->name('demandes');
Route::get('demande/create','DemandeController@create')->name('demandes');
Route::post('demandes','DemandeController@store')->name('demandes');
Route::delete('demande/{id}','DemandeController@destroy')->name('demandes');
Route::put('demande/notedesuivi/{id}','DemandeController@notedesuivi')->name('demandes');

//Route Import Export
Route::POST('uploadfile','UploadFileController@import');
Route::get('exportParametres','ExportController@exportParametres');
Route::get('exportCommandes','ExportController@exportCommandes');

//Route Actions
Route::get('actions','ActionController@index')->name('actions');
Route::get('action/show/{id}','ActionController@show')->name('actions');
Route::get('action/showCoord/{id}','ActionController@showCoord')->name('actions');
Route::get('action/showAtelier/{id}','ActionController@showAtelier')->name('actions');
Route::get('action/showDemandeur/{id}','ActionController@showDemandeur')->name('actions');
Route::put('action/rejeterByRefOutile/{id}','ActionController@rejeterByRefOutile')->name('actions');
Route::put('action/approverByRefOutile/{id}','ActionController@approverByRefOutile')->name('actions');
Route::put('action/rejeterByCoord/{id}','ActionController@rejeterByCoord')->name('actions');
Route::put('action/approverByCoord/{id}','ActionController@approverByCoord')->name('actions');
Route::put('action/rejeterLivraisonBydemandeur/{id}','ActionController@rejeterLivraisonBydemandeur')->name('actions');
Route::put('action/approverLivraisonBydemandeur/{id}','ActionController@approverLivraisonBydemandeur')->name('actions');
Route::put('action/approverBydemandeur/{id}','ActionController@approverBydemandeur')->name('actions');

Route::get('action/showProj/{id}','ActionController@showProj')->name('actions');
Route::put('action/rejeterByProj/{id}','ActionController@rejeterByProj')->name('actions');
Route::put('action/approverByProj/{id}','ActionController@approverByProj')->name('actions');

Route::PUT('action/setstattoBEPASCOMMENCE','ActionController@setstattoBEPASCOMMENCE')->name('actions');
Route::put('action/setstattoENCOURS','ActionController@setstattoENCOURS')->name('actions');
Route::put('action/setstattoSTANDBY','ActionController@setstattoSTANDBY')->name('actions');
Route::put('action/setstattoCLOSEBE','ActionController@setstattoCLOSEBE')->name('actions');
Route::put('action/setstattoWithout','ActionController@setstattoWithout')->name('actions');
Route::put('action/setstattoANNULE','ActionController@setstattoANNULE')->name('actions');

Route::put('action/actionProj/{id}','ActionController@actionProj')->name('actions');
Route::put('action/assigneByProj','ActionController@assigneByProj')->name('actions');
Route::put('action/saveAndassigneByProj','ActionController@saveAndassigneByProj')->name('actions');
Route::put('action/savebeforeapprouvebyref','ActionController@savebeforeapprouvebyref')->name('actions');
Route::put('action/savebeforeapprouvebycoord','ActionController@savebeforeapprouvebycoord')->name('actions');
Route::put('action/actionCoord/{id}','ActionController@actionCoord')->name('actions');
Route::put('action/actionCoordBilan/{id}','ActionController@actionCoordBilan')->name('actions');
Route::put('action/actionAtelier/{id}','ActionController@actionAtelier')->name('actions');
Route::put('action/assigneByCoord','ActionController@assigneByCoord')->name('actions');
Route::put('action/saveAndassigneByCoord','ActionController@saveAndassigneByCoord')->name('actions');
Route::put('action/saveAndsoumettre','ActionController@saveAndsoumettre')->name('actions');
Route::put('action/soumettre','ActionController@soumettre')->name('actions');
Route::delete('action/supprimerDemande','ActionController@supprimerDemande')->name('actions');

Route::put('action/setstattoENCOURSFAB','ActionController@setstattoENCOURSFAB')->name('actions');
Route::put('action/setstattoSTANDBYFAB','ActionController@setstattoSTANDBYFAB')->name('actions');

Route::put('action/soumisbymethodefab/{id}','ActionController@soumisbymethodefab')->name('actions');

Route::put('action/modifydemandebycoord/{id}','ActionController@modifydemandebycoord')->name('actions');
Route::put('action/modifydemandebyreferent/{id}','ActionController@modifydemandebyreferent')->name('actions');

Route::put('action/affecteraureferent/{id}','ActionController@affecteraureferent')->name('actions');
Route::put('action/affecteraucoordbymethodefab/{id}','ActionController@affecteraucoordbymethodefab')->name('actions');
Route::put('action/affecteraureferentbymethodefab/{id}','ActionController@affecteraureferentbymethodefab')->name('actions');

Route::get('files/{path_File}/{name_File}', function($path_File = null,$name_File=null)
{
    $path = storage_path().'/'.'app'.'/public'.'/files/'.$path_File;
    if (file_exists($path)) {
        return Response::download($path,$name_File);
    }
});

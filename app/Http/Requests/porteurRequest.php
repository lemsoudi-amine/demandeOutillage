<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Glpiplugindemandeoutillageporteur;

class porteurRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $glpiplugindemandeoutillageporteur = Glpiplugindemandeoutillageporteur::find($this->glpiplugindemandeoutillageporteurs);

        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'nameofporteur'=>'unique:glpiplugindemandeoutillageporteurs|max:30',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'nameofporteur'=>'max:30|unique:glpiplugindemandeoutillageporteurs,nameofporteur,'.$this->id,

                ];
            }
            default:break;
        }

      
    }
    public function messages()
    {
        return [ 
         'nameofporteur.unique'=> 'La valeur du champ nom du porteur est déjà utilisée.',
         'nameofporteur.max'=>  'Le texte de nom du porteur ne peut contenir plus de :max caractères.',
        ]; 
    } 
}

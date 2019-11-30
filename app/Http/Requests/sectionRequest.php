<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Glpiplugindemandeoutillagesectionutilisateur;

class sectionRequest extends FormRequest
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
                    'num_section'=>'numeric|unique:glpiplugindemandeoutillagesectionutilisateurs',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'num_section'=>'numeric|unique:glpiplugindemandeoutillagesectionutilisateurs,num_section,'.$this->id,
                ];
            }
            default:break;
        }

      

    }

        public function messages()
    {
        return [ 
        'num_section.unique'=> 'La valeur du champ numéro de la section est déjà utilisée.',
        ]; 
    } 
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocaisPaisesRequest extends FormRequest
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
        $id = $this->input('id_pais');
    
        return [
            'nome' => [
                'required',
                'min:3',
                Rule::unique('paises', 'nome')->ignore($id, 'id_pais')
            ],
            'sigla2' => [
                'required',
                'min:2'
            ],
            'sigla3' => [
                'required',
                'min:3'
            ],
            'codigo' => [
                'required',
                'min:2'
            ]
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome do país é obrigatório!',
            'nome.min' => 'O nome do país deve ter no mínimo 3 caracteres!',
            'nome.unique' => 'País já cadastrado!',
            'sigla2.required' => 'A Sigla2 é obrigatório!',
            'sigla2.min' => 'A Sigla2 deve ter no mínimo 2 caracteres!',
            'sigla3.required' => 'A Sigla3 é obrigatório!',
            'sigla3.min' => 'A Sigla3 deve ter no mínimo 3 caracteres!',
            'codigo.required' => 'O Código de área é obrigatório!',
            'codigo.min' => 'O Código de área deve ter no mínimo 2 caracteres!',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocaisCidadesRequest extends FormRequest
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
        $id = $this->input('id_cidade');
    
        return [
            'estado_id' => [
                'required'
            ],
            'nome_cidade' => [
                'required',
                'min:3',
                Rule::unique('cidades', 'nome_cidade')->ignore($id, 'id_cidade')
            ],
            
        ];
    }

    public function messages()
    {
        return [
            'estado_id.required' => 'O Código do estado é obrigatório!',
            'nome_estado.required' => 'O campo nome da cidade é obrigatório!',
            'nome_estado.min' => 'O nome da cidade deve ter no mínimo 3 caracteres!',
            'nome_estado.unique' => 'Cidade já cadastrado!'
        ];
    }
}

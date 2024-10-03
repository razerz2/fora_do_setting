<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocaisEstadosRequest extends FormRequest
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
        $id = $this->input('id_estado');
    
        return [
            'uf' => [
                'required',
                'min:2'
            ],
            'nome_estado' => [
                'required',
                'min:3',
                Rule::unique('estados', 'nome_estado')->ignore($id, 'id_estado')
            ],
            'pais_id' => [
                'required'
            ]
        ];
    }

    public function messages()
    {
        return [
            'uf.required' => 'UF é obrigatório!',
            'uf.min' => 'UF deve ter no mínimo 2 caracteres!',
            'nome_estado.required' => 'O campo nome do estado é obrigatório!',
            'nome_estado.min' => 'O nome do estado deve ter no mínimo 3 caracteres!',
            'nome_estado.unique' => 'Estado já cadastrado!',
            'pais_id.required' => 'O Código do país é obrigatório!'
        ];
    }
}

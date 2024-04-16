<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacienteEnderecoRequest extends FormRequest
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
        return [
            'endereco' => [
                'required',
                'min:3'
            ],
            'n_endereco' => [
                'required',
                'min:1'
            ],
            'cep' => [
                'required',
                'min:8'
            ],
            'pais_id' => [
                'required'
            ],
            'estado_id' => [
                'required'
            ],
            'cidade_id' => [
                'required'
            ],
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'endereco.required' => 'O campo Endereço é obrigatório!',
            'endereco.min' => 'O Endereço deve ter no mínimo 3 caracteres!',
            'n_endereco.required' => 'O campo Nº do Endereço é obrigatório!',
            'n_endereco.min' => 'O Nº do Endereço deve ter no mínimo 1 caracteres!',
            'cep.required' => 'O campo CEP é obrigatório!',
            'cep.min' => 'O CEP deve ter no mínimo 8 caracteres!',
            'pais_id.required' => 'O campo Estado é obrigatório!',
            'estado_id.required' => 'O campo Estado é obrigatório!',
            'cidade_id.required' => 'O campo Cidade é obrigatório!', 
        ];
    }    
}

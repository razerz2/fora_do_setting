<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PacienteGeneroRequest extends FormRequest
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
        $id = $this->input('id_genero');
    
        return [
            'nome_genero' => [
                'required',
                'min:3',
                Rule::unique('pacientes_genero', 'nome_genero')->ignore($id, 'id_genero')
            ],
            'abreviatura' => [
                'required',
                'min:1'
            ]
        ];
    }

    public function messages()
    {
        return [
            'nome_genero.required' => 'O campo gênero é obrigatório!',
            'nome_genero.min' => 'O Gênero deve ter no mínimo 3 caracteres!',
            'nome_genero.unique' => 'Gênero já cadastrado!',
            'abreviatura.required' => 'A Abreviatura é obrigatório!',
            'abreviatura.min' => 'A Abreviatura deve ter no mínimo 1 caracter!'
        ];
    }
}

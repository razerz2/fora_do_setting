<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {        
        $id = $this->route('Paciente');

        return [
            'nome_paciente' => [
                'required',
                'min:3'
            ],
            'rg' => [
                'nullable',
                'min:3',
                Rule::unique('pacientes', 'rg')->ignore($id, 'id_paciente')
            ],
            'cpf' => [
                'required',
                'min:11',
                Rule::unique('pacientes', 'cpf')->ignore($id, 'id_paciente')
            ],
            'data_nascimento' => [
                'required'
            ],
            'sexo' => [
                'required'
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('pacientes', 'email')->ignore($id, 'id_paciente')
            ],
            'telefone_1' => [
                'required',
                'min:11'
            ],
            'resp_tel_1' => [
                'nullable',
                'min:3'
            ],
            'telefone_2' => [
                'nullable',
                'min:11'
            ],
            'resp_tel_2' => [
                'nullable',
                'min:3'
            ],
            'perfil' => [
                'mimes:jpeg',
                'max:1240'
            ]
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
            'nome_paciente.required' => 'O campo nome do usuário é obrigatório!',
            'nome_paciente.min' => 'O nome do usuário deve ter no mínimo 3 caracteres!',
            'rg.email' => 'RG Inválido!',
            'rg.unique' => 'Nº de RG já cadastrado!',
            'cpf.required' => 'O campo CPF é obrigatório!',
            'cpf.email' => 'CPF Inválido!',
            'cpf.unique' => 'Nº de CPF já cadastrado!',
            'data_nascimento.required' => 'O campo Data de Nascimento é obrigatório!',
            'sexo.required' => 'O campo Sexo é obrigatório!',
            'email.required' => 'O campo E-mail é obrigatório!',
            'email.email' => 'E-mail Inválido!',
            'email.unique' => 'E-mail já cadastrado!',
            'telefone_1.required' => 'O campo Telefone é obrigatório!',
            'telefone_1.min' => 'O Telefone deve ter no mínimo 10 caracteres!',
            'resp_tel_1.min' => 'O Responsável do telefone deve ter no mínimo 3 caracteres!',
            'telefone_2.min' => 'O Telefone secundário deve ter no mínimo 10 caracteres!',
            'resp_tel_2.min' => 'O Responsável do telefone secundário deve ter no mínimo 3 caracteres!',
            'perfil.mimes' => 'A foto perfil deve ser um arquivo do tipo: jpg.',
            'perfil.max' => 'A foto perfil deve ter no máximo 1MB.'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MotivoInativacaoRequest extends FormRequest
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
        $id = $this->input('id_mi');
    
        return [
            'nome_mi' => [
                'required',
                'min:3',
                Rule::unique('motivo_inativacao', 'nome_mi')->ignore($id, 'id_mi')
            ],
            'descricao_mi' => [
                'required',
                'min:6'
            ]
        ];
    }

    public function messages()
    {
        return [
            'nome_mi.required' => 'O campo nome da inativação é obrigatório!',
            'nome_mi.min' => 'O Motivo deve ter no mínimo 3 caracteres!',
            'nome_mi.unique' => 'Motivo já cadastrado!',
            'descricao_mi.required' => 'A Descrição é obrigatório!',
            'descricao_mi.min' => 'A Descrição deve ter no mínimo 6 caracteres!'
        ];
    }
}

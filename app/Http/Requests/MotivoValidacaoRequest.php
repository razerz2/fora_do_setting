<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MotivoValidacaoRequest extends FormRequest
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
        $id = $this->input('id_vm');
    
        return [
            'nome_motivo' => [
                'required',
                'min:3',
                Rule::unique('validacao_motivo', 'nome_motivo')->ignore($id, 'id_vm')
            ],
            'descricao_motivo' => [
                'required',
                'min:6'
            ]
        ];
    }

    public function messages()
    {
        return [
            'nome_motivo.required' => 'O campo nome da validação é obrigatório!',
            'nome_motivo.min' => 'O nome da validação deve ter no mínimo 3 caracteres!',
            'nome_motivo.unique' => 'Validação já cadastrado!',
            'descricao_motivo.required' => 'A Descrição é obrigatório!',
            'descricao_motivo.min' => 'A Descrição deve ter no mínimo 6 caracteres!'
        ];
    }
}

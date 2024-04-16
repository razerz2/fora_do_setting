<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $id = $this->route('user');

        return [
            'name' => [
                'required',
                'min:3',
                Rule::unique('users', 'name')->ignore($id, 'id')
            ],
            'name_full' => [
                'required',
                'min:3'
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($id, 'id')
            ],
            'password' => [
                'required',
                'min:6',
                'confirmed'
            ],
            'perfil' => [
                'mimes:jpeg',
                'max:1240'
            ]
        ];
    
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome do usuário é obrigatório!',
            'name.min' => 'O nome do usuário deve ter no mínimo 3 caracteres!',
            'name.unique' => 'O usuário já esta cadastrado!',
            'name_full.required' => 'O campo nome do usuário é obrigatório!',
            'name_full.min' => 'O nome do usuário deve ter no mínimo 3 caracteres!',
            'email.required' => 'O campo e-mail é obrigatório!',
            'email.email' => 'E-mail Inválido!',
            'email.unique' => 'E-mail já cadastrado!',
            'password.required' => 'O Password é obrigatório!',
            'password.min' => 'O Password deve ter no mínimo 6 caracteres!',
            'password.confirmed' => 'Password não confere!',
            'perfil.mimes' => 'A foto perfil deve ser um arquivo do tipo: jpg.',
            'perfil.max' => 'A foto perfil deve ter no máximo 1MB.'
        ];
    }
}

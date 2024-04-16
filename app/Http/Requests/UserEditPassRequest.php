<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditPassRequest extends FormRequest
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
        $id = $this->route('usuarios');

        return [
            'password' => [
                'required',
                'min:6',
                'confirmed'
            ]
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'O Password é obrigatório!',
            'password.min' => 'O Password deve ter no mínimo 6 caracteres!',
            'password.confirmed' => 'Password não confere!'
        ];
    }
}

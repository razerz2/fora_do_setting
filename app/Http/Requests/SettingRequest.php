<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'project_name' => 'required|string|min:3|max:255',
            'timezone' => 'required|string',
            'system_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'login_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'project_name.required' => 'O campo nome do projeto é obrigatório!',
            'project_name.string' => 'O campo deve ser apenas em caractéres!',
            'project_name.min' => 'O nome do projeto deve ter no mínimo 3 caracteres!',
            'project_name.max' => 'O nome do projeto deve ter no máximo 255 caracteres!',
            'timezone.required' => 'O campo fusohorário é obrigatório!',
            'timezone.string' => 'O campo deve ser apenas em caractéres!'
        ];
    }
}

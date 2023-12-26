<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_user' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'id_type_user' => 'required|exists:type_users,id_type_user'
        ];
    }
    public function messages()
    {
        return [
            'name_user.required' => 'El nombre de usuario es obligatorio.',
            'name_user.string' => 'El nombre de usuario debe ser una cadena de texto.',
            'name_user.max' => 'El nombre de usuario no puede exceder los 255 caracteres.',
            'name_user.unique' => 'El nombre de usuario ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'id_type_user.required' => 'El tipo de usuario es obligatorio.',
            'id_type_user.exists' => 'El tipo de usuario seleccionado no es válido.'
        ];
    }
}

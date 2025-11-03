<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'group_id' => 'required|exists:groups,id',
            'quota_limit_mb' => 'required|numeric|min:0|max:1024',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no debe exceder los 255 caracteres',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'group_id.required' => 'El grupo es requerido',
            'role_id.required' => 'Debe seleccionar un rol.',
            'quota_limit_mb.required' => 'La cuota del almacenamiento del usuario es obligatoria',
            'quota_limit_mb.max' => 'Solo puedes asignar 1024 MB de cuota'
        ];
    }
}
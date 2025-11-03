<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user->id),
            ],
            'group_id' => ['required', 'exists:groups,id'],
            'role_id' => ['required', 'exists:roles,id'],
            'quota_limit_mb' => ['required', 'numeric', 'min:0'],
            'password' => ['nullable', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no debe exceder los 255 caracteres',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo ya está registrado.',
            'group_id.required' => 'El grupo es requerido',
            'role_id.required' => 'Debe seleccionar un rol.',
            'quota_limit_mb.required' => 'La cuota del almacenamiento del usuario es obligatoria',
            'quota_limit_mb.max' => 'Solo puedes asignar 1024 MB de cuota'
        ];
    }
}
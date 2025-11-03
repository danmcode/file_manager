<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGroupRequest extends FormRequest
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
            'name' => [
                'required',
                'min:3',
                'max:90',
            ],
            'description' => ['required', 'string', 'min:3', 'max:255'],

        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del grupo es requerido',
            'name.max' => 'El nombre no debe exceder los 255 caracteres',
            'name.min' => 'El nombre debe tener almenos 3 caracteres',
            'name.unique' => 'El nombre del grupo ya está en uso',
            'description.required' => 'La descripción del grupo es requerido',
            'description.max' => 'La descripción no debe exceder los 255 caracteres',
            'description.min' => 'La descripción debe tener almenos 3 caracteres',
        ];
    }
}
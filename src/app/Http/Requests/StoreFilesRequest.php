<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class StoreFilesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $user = Auth::user();

        $allowedExtensions = [
            'pdf',
            'doc',
            'docx',
            'xls',
            'xlsx',
            'ppt',
            'pptx',
            'txt',
            'zip',
            'rar'
        ];

        $availableMb = max(0, $user->quota_limit_mb - $user->used_space_mb);
        $availableKb = $availableMb * 1024;

        return [
            'files' => ['required', 'array', 'min:1'],
            'files.*' => [
                'file',
                'mimes:' . implode(',', $allowedExtensions),
                "max:{$availableKb}",
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'files.required' => 'Debes adjuntar al menos un archivo.',
            'files.array' => 'El campo de archivos debe ser un arreglo.',
            'files.*.file' => 'Cada elemento debe ser un archivo válido.',
            'files.*.mimes' => 'Solo se permiten archivos de tipo: PDF, Office, TXT, ZIP o RAR.',
            'files.*.max' => 'Uno o más archivos superan tu espacio disponible. Libera espacio o elimina otros archivos.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $user = Auth::user();
        $availableMb = max(0, $user->quota_limit_mb - $user->used_space_mb);

        if ($availableMb <= 0) {
            throw ValidationException::withMessages([
                'files' => [
                    "Has alcanzado tu límite de almacenamiento ({$user->quota_limit_mb} MB)."
                ]
            ]);
        }
    }
}
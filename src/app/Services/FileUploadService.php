<?php

namespace App\Services;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class FileUploadService
{
    protected ZipAnalyzerService $zipAnalyzer;

    public function __construct(ZipAnalyzerService $zipAnalyzer)
    {
        $this->zipAnalyzer = $zipAnalyzer;
    }

    private function getUserFolder(User $user): string
    {
        $parts = preg_split('/\s+/', trim($user->name));
        $first = strtolower($parts[0] ?? 'usuario');
        $last = strtolower($parts[1] ?? '');
        return Str::slug("uploads/{$first}_{$last}", '_');
    }

    private function getFileSizeMb(UploadedFile $file): float
    {
        return $file->getSize() / 1024 / 1024;
    }

    public function handleUpload(UploadedFile $file): string
    {
        /** @var User $user */
        $user = Auth::user();

        $folder = $this->getUserFolder($user);
        $fileExtension = strtolower($file->getClientOriginalExtension());
        $fileSizeMb = $this->getFileSizeMb($file);

        $newTotal = $user->used_space_mb + $fileSizeMb;
        if ($newTotal > $user->quota_limit_mb) {
            throw ValidationException::withMessages([
                'files' => [
                    "Has superado tu cuota máxima de almacenamiento. " .
                    "Límite: {$user->quota_limit_mb} MB, usado: {$user->used_space_mb} MB."
                ]
            ]);
        }

        if ($fileExtension === 'zip' && !$this->zipAnalyzer->analyze($file)) {
            throw ValidationException::withMessages([
                'files' => ['El archivo ZIP contiene contenido potencialmente peligroso.']
            ]);
        }

        return DB::transaction(function () use ($file, $user, $folder, $fileSizeMb, $newTotal) {

            // Asegurar carpeta
            Storage::disk('public')->makeDirectory($folder);

            // Guardar físicamente el archivo
            try {
                $path = $file->store($folder, 'public');
            } catch (\Throwable $e) {
                throw ValidationException::withMessages([
                    'files' => ['Error al guardar el archivo en el almacenamiento.']
                ]);
            }

            try {
                // Crear registro del archivo
                File::create([
                    'user_id' => $user->id,
                    'file_name' => $file->getClientOriginalName(),
                    'file_extension' => $file->getClientOriginalExtension(),
                    'file_size_bytes' => $file->getSize(),
                    'storage_path' => $path,
                    'created_by' => $user->id,
                ]);

                // ⚠️ Reconsultar usuario fresco desde DB
                $freshUser = User::find($user->id);
                $freshUser->used_space_mb = round($newTotal, 2);
                $freshUser->updated_by = $user->id;
                $freshUser->save();

                return $path;
            } catch (\Throwable $e) {
                // Limpiar archivo físico si la DB falla
                if (isset($path) && Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }

                throw $e; // rollback automático
            }
        });
    }
}
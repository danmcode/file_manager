<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use ZipArchive;

class ZipAnalyzerService
{
    /**
     * Extensiones peligrosas que no deben permitirse dentro del ZIP.
     */
    protected array $dangerousExtensions = [
        'exe',
        'bat',
        'cmd',
        'sh',
        'php',
        'js',
        'jar',
        'msi',
        'ps1'
    ];

    /**
     * Analiza el contenido del archivo ZIP para detectar archivos peligrosos.
     */
    public function analyze(UploadedFile $file): bool
    {
        $zip = new ZipArchive;
        $tempPath = $file->getRealPath();

        if ($zip->open($tempPath) === true) {
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $name = $zip->getNameIndex($i);
                $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

                if (in_array($ext, $this->dangerousExtensions, true)) {
                    $zip->close();
                    return false; // Detectado archivo peligroso
                }
            }
            $zip->close();
        }

        return true; // Seguro
    }
}
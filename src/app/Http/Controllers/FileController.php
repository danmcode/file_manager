<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFilesRequest;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    protected FileUploadService $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    public function store(StoreFilesRequest $request)
    {
        $paths = [];

        foreach ($request->file('files') as $file) {
            $paths[] = $this->fileUploadService->handleUpload($file);
        }


        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                "Archivos guardados correctamente"
            );

    }
}
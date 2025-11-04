<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFilesRequest;
use App\Services\FileUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{
    protected FileUploadService $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    public function index()
    {
        $files = Auth::user()->files()->latest()->get();

        return view('files.index', compact('files'));
    }

    public function store(StoreFilesRequest $request): RedirectResponse
    {
        try {
            $paths = [];

            foreach ($request->file('files') as $file) {
                $paths[] = $this->fileUploadService->handleUpload($file);
            }

            return redirect()
                ->back()
                ->with('success', 'Archivos subidos correctamente.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->withErrors(['files' => 'Ocurrió un error inesperado al subir los archivos. Intenta nuevamente.']);
        }
    }
}
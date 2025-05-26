<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use ZipArchive;

class BackupController extends Controller
{
    public function index()
    {
        $backups = Storage::files(directory: 'laravel-backup');
        return view('admin.backup.index', compact('backups'));
    }

    public function create()
    {
        // Para crear un nuevo respaldo
        try {
            Artisan::call('backup:run');

            return redirect()->route('admin.backup.index')
                ->with('mensaje', 'Respaldo creado con éxito.')
                ->with('icono', 'success');
        } catch (\Exception $e) {
            return redirect()->route('admin.backup.index')
                ->with('mensaje', 'Error:' . $e)
                ->with('icono', 'success');
        }
    }

    public function descargar($nombreFile)
    {
        // Para descargar un respaldo
        $file = 'laravel-backup/' . $nombreFile;
        if (Storage::exists($file)) {
            return Storage::download($file);
        } else {
            return redirect()->route('admin.backup.index')
                ->with('mensaje', 'El archivo de respaldo no existe.')
                ->with('icono', 'error');
        }
    }

    public function restore(Request $request)
    {
        $filename = $request->backup_file;
        $filePath = storage_path('app/private/laravel-backup/' . $filename);

        if (!file_exists($filePath)) {
            return back()->with('mensaje', 'El respaldo no existe.')->with('icono', 'error');
        }

        // Extraer ZIP temporalmente
        $zip = new ZipArchive;
        $extractPath = storage_path('app/backup-temp');

        if ($zip->open($filePath) === true) {
            $zip->extractTo($extractPath);
            $zip->close();
        } else {
            return back()->with('mensaje', 'No se pudo extraer el archivo de respaldo.')->with('icono', 'error');
        }

        // Buscar el archivo .sql dentro de cualquier subcarpeta
        $sqlFile = $this->findSqlFile($extractPath);

        if ($sqlFile) {
            $sql = file_get_contents($sqlFile);
            DB::unprepared($sql);

            File::deleteDirectory($extractPath);

            return back()->with('mensaje', 'Base de datos restaurada exitosamente.')->with('icono', 'success');
        } else {
            File::deleteDirectory($extractPath);
            return back()->with('mensaje', 'No se encontró un archivo SQL dentro del respaldo.')->with('icono', 'error');
        }
    }

    private function findSqlFile($directory)
    {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory));
        foreach ($iterator as $file) {
            if ($file->isFile() && strtolower($file->getExtension()) === 'sql') {
                return $file->getRealPath();
            }
        }
        return null;
    }

    public function eliminar($nombreFile)
    {
        // Para eliminar un respaldo
        $file = 'laravel-backup/' . $nombreFile;

        if (Storage::disk('local')->exists($file)) {
            Storage::disk('local')->delete($file);

            return redirect()->route('admin.backup.index')
                ->with('mensaje', 'Respaldo eliminado con éxito.')
                ->with('icono', 'success');
        } else {
            return redirect()->route('admin.backup.index')
                ->with('mensaje', 'El archivo no existe.')
                ->with('icono', 'error');
        }
    }

    public function uploadRestore(Request $request)
    {
        $request->validate([
            'uploaded_backup' => 'required|file|mimes:zip|max:204800',
        ], [
            'uploaded_backup.required' => 'Debe seleccionar un archivo.',
            'uploaded_backup.file' => 'Debe ser un archivo válido.',
            'uploaded_backup.mimes' => 'Solo se permiten archivos .zip.',
            'uploaded_backup.max' => 'El archivo no debe superar los 200 MB.',
        ]);

        try {
            $file = $request->file('uploaded_backup');
            $filename = time() . '_' . $file->getClientOriginalName();
            $storagePath = 'private/laravel-backup';

            // Guardar el archivo ZIP
            $file->move(storage_path('app/' . $storagePath), $filename);

            $fullFilePath = storage_path("app/$storagePath/$filename");

            // Extraer y restaurar desde ZIP
            $zip = new ZipArchive;
            $extractPath = storage_path('app/backup-temp-' . time());

            if ($zip->open($fullFilePath) === true) {
                $zip->extractTo($extractPath);
                $zip->close();

                $sqlFile = $this->findSqlFile($extractPath);

                if ($sqlFile) {
                    $this->runSqlFile($sqlFile);
                    File::deleteDirectory($extractPath);
                    File::delete($fullFilePath);

                    return redirect()->back()
                        ->with('mensaje', 'Respaldo ZIP subido y restaurado correctamente.')
                        ->with('icono', 'success');
                }

                File::deleteDirectory($extractPath);
                File::delete($fullFilePath);
                return redirect()->back()
                    ->with('mensaje', 'No se encontró archivo .sql dentro del ZIP.')
                    ->with('icono', 'error');
            }

            return redirect()->back()
                ->with('mensaje', 'No se pudo abrir el archivo ZIP.')
                ->with('icono', 'error');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('mensaje', 'Error al restaurar respaldo: ' . $e->getMessage())
                ->with('icono', 'error');
        }
    }

    // Método para ejecutar SQL
    private function runSqlFile($path)
    {
        $sql = File::get($path);
        DB::unprepared($sql);
    }
}

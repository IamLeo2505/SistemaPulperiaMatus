<?php

namespace App\Livewire\Mantenimiento;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;
use ZipArchive;

class Mantenimiento extends Component
{
    use WithFileUploads;

    public $mostrarModalRestaurar = false;
    public $archivoBackup;

    public function render()
    {
        return view('livewire.mantenimiento.mantenimiento');
    }

    public function crearCopiaSeguridad()
    {
        try {
            // Desactivar el envío de correos temporalmente
            config(['mail.default' => 'log']);

            // Obtener el nombre de la base de datos
            $database = env('DB_DATABASE');

            // Validar que la base de datos no sea null
            if (empty($database)) {
                throw new \Exception('Falta DB_DATABASE en el archivo .env.');
            }

            // Ejecutar el comando de backup solo de la base de datos
            Artisan::call('backup:run', ['--only-db' => true]);
            Log::info('Backup command executed. Checking files...');

            // Obtener el archivo de respaldo más reciente
            $files = Storage::disk('local')->files('Laravel');
            Log::info('Files in backup-temp: ', ['files' => $files]);

            if (empty($files)) {
                throw new \Exception('No se encontraron archivos en Laravel. Verifica permisos o configuración.');
            }

            $latestBackup = collect($files)->sort()->last();

            if (!$latestBackup) {
                throw new \Exception('No se pudo encontrar el archivo de respaldo generado.');
            }

            // Nombre del archivo para la descarga con timestamp
            $fecha = now()->format('Y-m-d_H-i-s');
            $nombreArchivo = "backup_{$database}_{$fecha}.zip";

            // Descargar el archivo
            return response()->download(storage_path("app/{$latestBackup}"), $nombreArchivo)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            Log::error('Error al crear copia de seguridad: ' . $e->getMessage());
            session()->flash('error', 'Error al crear la copia de seguridad: ' . $e->getMessage());
        }
    }

    public function abrirModalRestaurar()
    {
        $this->mostrarModalRestaurar = true;
    }

    public function cerrarModalRestaurar()
    {
        $this->mostrarModalRestaurar = false;
        $this->reset(['archivoBackup']);
    }

    public function restaurarCopiaSeguridad()
    {
        $this->validate([
            'archivoBackup' => 'required|file|mimes:sql,zip|max:10240', // Acepta .sql o .zip, máximo 10MB
        ]);

        try {
            // Desactivar el envío de correos temporalmente
            config(['mail.default' => 'log']);

            // Obtener configuración de la base de datos
            $database = env('DB_DATABASE');
            $username = env('DB_USERNAME');
            $password = env('DB_PASSWORD');
            $host = env('DB_HOST', 'localhost');
            $port = env('DB_PORT', 3306);

            // Validar que las variables no sean null
            if (empty($database) || empty($username) || empty($host)) {
                throw new \Exception('Faltan credenciales de la base de datos en el archivo .env (DB_DATABASE, DB_USERNAME, DB_HOST).');
            }

            // Guardar el archivo subido temporalmente
            $rutaArchivo = $this->archivoBackup->store('backups');
            $rutaCompleta = storage_path("app/{$rutaArchivo}");

            // Determinar si es .zip o .sql
            $sqlFilePath = $rutaCompleta;
            if (pathinfo($rutaCompleta, PATHINFO_EXTENSION) === 'zip') {
                $zip = new ZipArchive;
                if ($zip->open($rutaCompleta) === true) {
                    $tempDir = storage_path('app/temp-restore');
                    if (!file_exists($tempDir)) {
                        mkdir($tempDir, 0777, true);
                    }
                    $zip->extractTo($tempDir);
                    $zip->close();

                    // Buscar el archivo .sql dentro del ZIP
                    $sqlFiles = glob("{$tempDir}/**/*.sql", GLOB_BRACE);
                    if (empty($sqlFiles)) {
                        throw new \Exception('No se encontró un archivo .sql dentro del archivo ZIP.');
                    }
                    $sqlFilePath = $sqlFiles[0]; // Usar el primer .sql encontrado
                } else {
                    throw new \Exception('No se pudo abrir el archivo ZIP.');
                }
            }

            // Ruta completa de mysql (ajusta según tu instalación de Laragon)
            $mysqlPath = 'C:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysql.exe';

            // Comando para restaurar la base de datos con ruta completa
            $comando = sprintf(
                '"%s" --user=%s --password=%s --host=%s --port=%s %s < %s',
                $mysqlPath,
                escapeshellarg($username),
                escapeshellarg($password ?? ''),
                escapeshellarg($host),
                $port,
                escapeshellarg($database),
                escapeshellarg($sqlFilePath)
            );

            // Ejecutar el comando
            $process = Process::fromShellCommandline($comando);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new \Exception('Error al restaurar la copia de seguridad: ' . $process->getErrorOutput());
            }

            // Limpiar archivos temporales
            if (isset($tempDir) && file_exists($tempDir)) {
                array_map('unlink', glob("{$tempDir}/*.*"));
                rmdir($tempDir);
            }
            Storage::delete($rutaArchivo);

            session()->flash('mensaje', 'Base de datos restaurada exitosamente.');
            $this->cerrarModalRestaurar();

        } catch (\Exception $e) {
            Log::error('Error al restaurar copia de seguridad: ' . $e->getMessage());
            session()->flash('error', 'Error al restaurar la copia de seguridad: ' . $e->getMessage());
        }
    }

    public function limpiarArchivoBackup()
    {
        $this->reset('archivoBackup');
    }

}
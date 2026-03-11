<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FilamentExportConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filament:export-config 
                            {--format=json : Formato de exportación (json, php)}
                            {--output=exports : Directorio de salida}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exporta la configuración y recursos de Filament para backup o migración';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $format = $this->option('format');
        $outputDir = $this->option('output');
        
        $this->info('🚀 Exportando configuración de Filament...');
        
        // Crear directorio de exportación
        $exportPath = storage_path("app/{$outputDir}");
        if (!File::exists($exportPath)) {
            File::makeDirectory($exportPath, 0755, true);
        }
        
        // Recopilar información de recursos
        $resources = $this->exportResources();
        
        // Recopilar información de widgets
        $widgets = $this->exportWidgets();
        
        // Recopilar configuración de paneles
        $panels = $this->exportPanels();
        
        // Recopilar configuración general
        $config = [
            'exportado_en' => now()->toDateTimeString(),
            'version_laravel' => app()->version(),
            'version_filament' => \Composer\InstalledVersions::getVersion('filament/filament') ?? 'unknown',
            'resources' => $resources,
            'widgets' => $widgets,
            'panels' => $panels,
        ];
        
        // Generar nombre de archivo con timestamp
        $filename = "filament-config-" . now()->format('Y-m-d-His');
        
        if ($format === 'json') {
            $filepath = "{$exportPath}/{$filename}.json";
            File::put($filepath, json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        } else {
            $filepath = "{$exportPath}/{$filename}.php";
            File::put($filepath, '<?php return ' . var_export($config, true) . ';');
        }
        
        $this->info("✅ Configuración exportada exitosamente:");
        $this->info("📁 Archivo: {$filepath}");
        $this->info("📊 Resumen:");
        $this->table(
            ['Tipo', 'Cantidad'],
            [
                ['Resources', count($resources)],
                ['Widgets', count($widgets)],
                ['Panels', count($panels)],
            ]
        );
        
        // También exportar comandos útiles
        $this->exportUsefulCommands($exportPath);
        
        return Command::SUCCESS;
    }
    
    /**
     * Exportar información de recursos Filament
     */
    private function exportResources(): array
    {
        $resourcesPath = app_path('Filament/Resources');
        $resources = [];
        
        if (!File::exists($resourcesPath)) {
            return $resources;
        }
        
        foreach (File::files($resourcesPath) as $file) {
            if ($file->getExtension() === 'php') {
                $className = $file->getBasename('.php');
                $namespace = "App\\Filament\\Resources\\{$className}";
                
                if (class_exists($namespace)) {
                    $reflection = new \ReflectionClass($namespace);
                    
                    $resources[] = [
                        'nombre' => $className,
                        'modelo' => $this->getModelFromResource($namespace),
                        'label_singular' => $namespace::getModelLabel() ?? null,
                        'label_plural' => $namespace::getPluralModelLabel() ?? null,
                        'ruta' => $file->getPathname(),
                        'campos_formulario' => $this->extractFormFields($namespace),
                        'columnas_tabla' => $this->extractTableColumns($namespace),
                    ];
                }
            }
        }
        
        return $resources;
    }
    
    /**
     * Exportar información de widgets
     */
    private function exportWidgets(): array
    {
        $widgetsPath = app_path('Filament/Widgets');
        $widgets = [];
        
        if (!File::exists($widgetsPath)) {
            return $widgets;
        }
        
        foreach (File::files($widgetsPath) as $file) {
            if ($file->getExtension() === 'php') {
                $widgets[] = [
                    'nombre' => $file->getBasename('.php'),
                    'ruta' => $file->getPathname(),
                ];
            }
        }
        
        return $widgets;
    }
    
    /**
     * Exportar configuración de paneles
     */
    private function exportPanels(): array
    {
        $providersPath = app_path('Providers/Filament');
        $panels = [];
        
        if (!File::exists($providersPath)) {
            return $panels;
        }
        
        foreach (File::files($providersPath) as $file) {
            if (str_ends_with($file->getFilename(), 'PanelProvider.php')) {
                $panels[] = [
                    'nombre' => $file->getBasename('.php'),
                    'ruta' => $file->getPathname(),
                ];
            }
        }
        
        return $panels;
    }
    
    /**
     * Obtener el modelo asociado a un resource
     */
    private function getModelFromResource(string $resourceClass): ?string
    {
        if (method_exists($resourceClass, 'getModel')) {
            return $resourceClass::getModel();
        }
        return null;
    }
    
    /**
     * Extraer campos del formulario
     */
    private function extractFormFields(string $resourceClass): array
    {
        try {
            if (method_exists($resourceClass, 'form')) {
                // Nota: Esto es una simplificación
                // En una implementación real, se analizaría la estructura del formulario
                return ['formulario_disponible' => true];
            }
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
        
        return [];
    }
    
    /**
     * Extraer columnas de la tabla
     */
    private function extractTableColumns(string $resourceClass): array
    {
        try {
            if (method_exists($resourceClass, 'table')) {
                return ['tabla_disponible' => true];
            }
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
        
        return [];
    }
    
    /**
     * Exportar comandos útiles para deploy
     */
    private function exportUsefulCommands(string $exportPath): void
    {
        $commands = <<<'BASH'
#!/bin/bash
# Comandos útiles para deploy de Filament

# 1. Limpiar cachés
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# 2. Optimizar para producción
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Filament específico
php artisan filament:upgrade
php artisan filament:cache-components

# 4. Storage
php artisan storage:link

# 5. Migraciones
php artisan migrate --force

# 6. Permisos (en servidor Linux)
# chmod -R 775 storage bootstrap/cache
# chown -R www-data:www-data storage bootstrap/cache
BASH;
        
        File::put("{$exportPath}/deploy-commands.sh", $commands);
    }
}

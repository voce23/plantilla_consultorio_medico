<?php
/**
 * 📍 Archivo: index.php (raíz del subdominio)
 * 
 * Este archivo redirige todo al framework Laravel.
 * Para subdominios en Banahosting donde no puedes apuntar directamente a /public
 */

// Definir la ruta base de Laravel
$laravelBase = __DIR__ . '/clinica-app';

// Cargar el autoloader de Composer
require $laravelBase . '/vendor/autoload.php';

// Inicializar la aplicación Laravel
$app = require_once $laravelBase . '/bootstrap/app.php';

// Obtener el kernel HTTP
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Capturar la request
$request = Illuminate\Http\Request::capture();

// Procesar la request
$response = $kernel->handle($request);

// Enviar la respuesta
$response->send();

// Terminar
$kernel->terminate($request, $response);

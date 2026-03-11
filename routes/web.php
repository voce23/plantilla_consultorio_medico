<?php

use Illuminate\Support\Facades\Route;

// ─── Página principal ───────────────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
})->name('inicio');

// ─── Páginas públicas ─────────────────────────────────────────────────────
Route::get('/nosotros', function () {
    return view('paginas.nosotros');
})->name('nosotros');

Route::get('/servicios', function () {
    return view('paginas.servicios');
})->name('servicios');

Route::get('/contacto', function () {
    return view('paginas.contacto');
})->name('contacto');

Route::get('/politica-de-privacidad', function () {
    return view('paginas.politica-privacidad');
})->name('politica-privacidad');

Route::get('/terminos-de-uso', function () {
    return view('paginas.terminos-uso');
})->name('terminos-uso');

// ─── Especialidades ─────────────────────────────────────────────────────────
Route::get('/especialidades', function () {
    return view('paginas.especialidades');
})->name('especialidades.index');

Route::get('/especialidades/{slug}', function (string $slug) {
    return view('paginas.especialidad-detalle', ['slug' => $slug]);
})->name('especialidades.show');

// ─── Doctores ───────────────────────────────────────────────────────────────
Route::get('/nuestros-medicos', function () {
    return view('paginas.doctores');
})->name('doctores.index');

Route::get('/nuestros-medicos/{slug}', function (string $slug) {
    return view('paginas.doctor-detalle', ['slug' => $slug]);
})->name('doctores.show');

// ─── Blog ────────────────────────────────────────────────────────────────────
Route::get('/blog', function () {
    return view('paginas.blog');
})->name('blog.index');

Route::get('/blog/buscar', function () {
    $query = request('q');
    return view('paginas.blog', ['busqueda' => $query]);
})->name('blog.buscar');

Route::get('/blog/{slug}', function (string $slug) {
    return view('paginas.blog-detalle', ['slug' => $slug]);
})->name('blog.show');

Route::get('/blog/categoria/{categoria}', function (string $categoria) {
    return view('paginas.blog', ['categoria' => $categoria]);
})->name('blog.categoria');

// ─── Citas ──────────────────────────────────────────────────────────────────
Route::get('/reservar-cita', function () {
    return view('paginas.reservar-cita');
})->name('citas.agendar');

// ─── Newsletter ─────────────────────────────────────────────────────────────
Route::post('/newsletter/suscribir', function () {
    $email = request('email');
    // Aquí puedes agregar la lógica para guardar el email
    return back()->with('success', '¡Gracias por suscribirte a nuestro newsletter!');
})->name('newsletter.suscribir');

// ─── Dashboard (requiere autenticación) ─────────────────────────────────────
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

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

Route::post('/reservar-cita', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'nombre'         => 'required|string|max:100',
        'apellido'       => 'required|string|max:100',
        'telefono'       => 'required|string|max:20',
        'especialidad_id'=> 'required|exists:especialidads,id',
        'fecha'          => 'required|date|after:today',
        'hora'           => 'required',
    ], [
        'nombre.required'          => 'El nombre es obligatorio.',
        'apellido.required'        => 'El apellido es obligatorio.',
        'telefono.required'        => 'El teléfono es obligatorio.',
        'especialidad_id.required' => 'Debes seleccionar una especialidad.',
        'fecha.required'           => 'La fecha es obligatoria.',
        'fecha.after'              => 'La fecha debe ser a partir de mañana.',
        'hora.required'            => 'El horario es obligatorio.',
    ]);

    // Crear o recuperar el paciente por teléfono + nombre
    $paciente = \App\Models\Paciente::firstOrCreate(
        ['telefono' => $request->telefono, 'nombre' => $request->nombre],
        [
            'apellido'  => $request->apellido,
            'email'     => $request->email,
            'dni'       => $request->dni ?: null,
            'sexo'      => $request->sexo ?: null,
            'activo'    => true,
        ]
    );

    // Guardar la cita
    \App\Models\Cita::create([
        'paciente_id'    => $paciente->id,
        'doctor_id'      => $request->doctor_id ?: \App\Models\Doctor::where('activo', true)->value('id'),
        'especialidad_id'=> $request->especialidad_id,
        'servicio_id'    => $request->servicio_id ?: null,
        'fecha'          => $request->fecha,
        'hora'           => $request->hora,
        'estado'         => 'pendiente',
        'motivo'         => $request->motivo ?: null,
    ]);

    return redirect()->route('citas.agendar')
        ->with('cita_exitosa', "Cita registrada para el {$request->fecha} a las {$request->hora}. ¡Pronto te contactaremos!");
})->name('citas.guardar');

// ─── Contacto ───────────────────────────────────────────────────────────────
Route::post('/contacto/enviar', function () {
    // Aquí puedes agregar lógica real: guardar en DB o enviar email
    return back()->with('success', '¡Gracias por contactarnos! Te responderemos pronto.');
})->name('contacto.enviar');

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

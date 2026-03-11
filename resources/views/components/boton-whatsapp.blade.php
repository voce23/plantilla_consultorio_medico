<!-- Botón WhatsApp Dinámico -->
<!-- 📁 Archivo: resources/views/components/boton-whatsapp.blade.php -->

@props([
    'telefono' => null,
    'mensaje' => null,
    'cita' => null,
    'tipo' => 'boton', // 'boton', 'flotante', 'link'
    'texto' => 'Contactar por WhatsApp',
    'class' => '',
])

@php
// Número de teléfono por defecto (debe incluir código de país)
$numero = $telefono ?? '51999999999';

// Limpiar el número (quitar espacios, guiones, etc.)
$numeroLimpio = preg_replace('/[^0-9]/', '', $numero);

// Generar mensaje automático si se pasa una cita
if ($cita && !$mensaje) {
    $mensaje = "¡Hola! 👋\n\n";
    $mensaje .= "Solicito información sobre una cita médica:\n\n";
    
    if (isset($cita['paciente_nombre'])) {
        $mensaje .= "👤 *Paciente:* " . $cita['paciente_nombre'] . "\n";
    }
    
    if (isset($cita['doctor_nombre'])) {
        $mensaje .= "🩺 *Doctor:* " . $cita['doctor_nombre'] . "\n";
    }
    
    if (isset($cita['especialidad'])) {
        $mensaje .= "🏥 *Especialidad:* " . $cita['especialidad'] . "\n";
    }
    
    if (isset($cita['fecha'])) {
        $mensaje .= "📅 *Fecha:* " . $cita['fecha'] . "\n";
    }
    
    if (isset($cita['hora'])) {
        $mensaje .= "⏰ *Hora:* " . $cita['hora'] . "\n";
    }
    
    $mensaje .= "\n¿Podrían confirmarme la disponibilidad? ¡Gracias! 🙏";
} elseif (!$mensaje) {
    $mensaje = "¡Hola! Me gustaría obtener más información sobre sus servicios médicos. 🏥";
}

// Codificar el mensaje para URL
$mensajeCodificado = urlencode($mensaje);

// URL de WhatsApp
$urlWhatsApp = "https://wa.me/{$numeroLimpio}?text={$mensajeCodificado}";

// Clases según el tipo
$clases = match($tipo) {
    'flotante' => 'fixed bottom-6 right-6 z-50 w-14 h-14 bg-green-500 rounded-full shadow-lg hover:shadow-xl hover:scale-110 transition-all duration-300 flex items-center justify-center',
    'link' => 'text-green-600 hover:text-green-700 underline inline-flex items-center gap-2',
    default => 'inline-flex items-center gap-2 px-6 py-3 bg-green-500 text-white font-medium rounded-xl hover:bg-green-600 hover:shadow-lg hover:shadow-green-500/30 transition-all duration-300',
};
@endphp

@if($tipo === 'flotante')
    <!-- Botón flotante (esquina inferior derecha) -->
    <a 
        href="{{ $urlWhatsApp }}"
        target="_blank"
        rel="noopener noreferrer"
        class="{{ $clases }} {{ $class }}"
        title="Contactar por WhatsApp"
    >
        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
        
        <!-- Badge de notificación opcional -->
        <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full flex items-center justify-center text-xs text-white font-bold animate-pulse">
            1
        </span>
    </a>
@elseif($tipo === 'link')
    <!-- Link simple -->
    <a 
        href="{{ $urlWhatsApp }}"
        target="_blank"
        rel="noopener noreferrer"
        class="{{ $clases }} {{ $class }}"
    >
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
        {{ $texto }}
    </a>
@else
    <!-- Botón estándar -->
    <a 
        href="{{ $urlWhatsApp }}"
        target="_blank"
        rel="noopener noreferrer"
        class="{{ $clases }} {{ $class }}"
    >
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
        {{ $texto }}
    </a>
@endif

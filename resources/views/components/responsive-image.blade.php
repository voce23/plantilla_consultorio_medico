<!-- Componente de Imagen Responsive con Lazy Loading -->
<!-- 📁 Archivo: resources/views/components/responsive-image.blade.php -->

@props([
    'src',
    'alt' => '',
    'class' => '',
    'sizes' => [
        'sm' => 640,
        'md' => 768,
        'lg' => 1024,
        'xl' => 1280,
    ],
    'loading' => 'lazy',
    'decoding' => 'async',
    'fetchpriority' => 'auto',
])

@php
// Generar srcset para diferentes tamaños
$srcset = [];
$extension = pathinfo($src, PATHINFO_EXTENSION);
$basename = pathinfo($src, PATHINFO_FILENAME);
$dirname = pathinfo($src, PATHINFO_DIRNAME);

foreach ($sizes as $breakpoint => $width) {
    // En producción, aquí se referenciarían las imágenes generadas
    $srcset[] = "{$src} {$width}w";
}

$srcsetString = implode(', ', $srcset);

// Determinar sizes attribute para responsive
$sizesAttr = '(max-width: 640px) 100vw, (max-width: 768px) 50vw, (max-width: 1024px) 33vw, 25vw';
@endphp

<img 
    src="{{ $src }}"
    srcset="{{ $srcsetString }}"
    sizes="{{ $sizesAttr }}"
    alt="{{ $alt }}"
    loading="{{ $loading }}"
    decoding="{{ $decoding }}"
    fetchpriority="{{ $fetchpriority }}"
    class="{{ $class }}"
    @if($loading === 'lazy')
        onload="this.classList.add('loaded')"
    @endif
/>

{{-- Estilos para fade-in al cargar --}}
@once
    @push('styles')
    <style>
        img[loading="lazy"] {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        img[loading="lazy"].loaded {
            opacity: 1;
        }
        img[loading="eager"] {
            opacity: 1;
        }
    </style>
    @endpush
@endonce

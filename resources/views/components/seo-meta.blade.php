<!-- Componente SEO Meta Tags -->
<!-- 📁 Archivo: resources/views/components/seo-meta.blade.php -->

@props([
    'title' => config('app.name', 'Clínica Salud'),
    'description' => 'Clínica médica especializada en brindar atención de calidad con los mejores especialistas. Agenda tu cita en línea.',
    'keywords' => 'clínica médica, doctores, especialistas, citas médicas, salud, consulta médica',
    'image' => asset('images/og-default.jpg'),
    'canonical' => url()->current(),
    'type' => 'website',
    'twitterCard' => 'summary_large_image',
])

{{-- Título de la página --}}
<title>{{ $title }} | {{ config('app.name') }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<link rel="canonical" href="{{ $canonical }}">

{{-- Open Graph / Facebook --}}
<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:locale" content="es_MX">

{{-- Twitter Card --}}
<meta name="twitter:card" content="{{ $twitterCard }}">
<meta name="twitter:url" content="{{ $canonical }}">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">

{{-- Schema.org MedicalOrganization JSON-LD --}}
@php
$schemaOrg = json_encode([
    '@context'    => 'https://schema.org',
    '@type'       => 'MedicalOrganization',
    'name'        => config('app.name'),
    'description' => $description,
    'url'         => url('/'),
    'logo'        => asset('images/logo.png'),
    'image'       => $image,
    'telephone'   => '+52-123-456-7890',
    'email'       => 'contacto@clinicasalud.com',
    'address'     => [
        '@type'           => 'PostalAddress',
        'streetAddress'   => 'Av. Salud 123, Colonia Médica',
        'addressLocality' => 'Ciudad de México',
        'addressRegion'   => 'CDMX',
        'postalCode'      => '01000',
        'addressCountry'  => 'MX',
    ],
    'geo' => [
        '@type'     => 'GeoCoordinates',
        'latitude'  => '19.4326',
        'longitude' => '-99.1332',
    ],
    'openingHoursSpecification' => [
        [
            '@type'      => 'OpeningHoursSpecification',
            'dayOfWeek'  => ['Monday','Tuesday','Wednesday','Thursday','Friday'],
            'opens'      => '08:00',
            'closes'     => '20:00',
        ],
        [
            '@type'     => 'OpeningHoursSpecification',
            'dayOfWeek' => 'Saturday',
            'opens'     => '09:00',
            'closes'    => '14:00',
        ],
    ],
    'priceRange' => '$$',
    'sameAs' => [
        'https://facebook.com/clinicasalud',
        'https://instagram.com/clinicasalud',
        'https://linkedin.com/company/clinicasalud',
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
@endphp
<script type="application/ld+json">{!! $schemaOrg !!}</script>

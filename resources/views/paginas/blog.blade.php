{{-- 📁 resources/views/paginas/blog.blade.php --}}
@php
use App\Models\Articulo;
use App\Models\Categoria;

$busqueda = $busqueda ?? request('q');
$categoriaFiltro = $categoria ?? null;

$query = Articulo::publicados()->recientes();

if ($busqueda) {
    $query->where(function($q) use ($busqueda) {
        $q->where('titulo', 'like', "%{$busqueda}%")
          ->orWhere('extracto', 'like', "%{$busqueda}%")
          ->orWhere('contenido', 'like', "%{$busqueda}%");
    });
}

if ($categoriaFiltro) {
    $query->whereHas('categoria', fn($q) => $q->where('slug', $categoriaFiltro));
}

$articulos = $query->paginate(9);
$categorias = Categoria::conArticulosPublicados()->ordenadas()->get();
$recientes = Articulo::publicados()->recientes()->limit(5)->get();
@endphp

<x-app-layout>
    <section class="py-16 bg-medico-azul-900">
        <div class="px-4 mx-auto text-center max-w-7xl sm:px-6 lg:px-8">
            <h1 class="font-serif text-3xl font-bold text-white sm:text-4xl">Blog de Salud</h1>
            <p class="mt-4 text-medico-azul-100">Consejos y noticias para cuidar tu bienestar</p>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                {{-- Columna principal: Artículos --}}
                <div class="lg:col-span-2">
                    @if($busqueda)
                        <div class="mb-6 px-4 py-3 bg-medico-azul-50 border border-medico-azul-100 rounded-xl text-sm text-medico-azul-700">
                            Resultados para: <strong>"{{ $busqueda }}"</strong> — {{ $articulos->total() }} artículo(s) encontrado(s)
                            <a href="{{ route('blog.index') }}" class="ml-3 text-medico-azul-500 underline hover:text-medico-azul-700">Limpiar búsqueda</a>
                        </div>
                    @endif
                    @if($articulos->count() > 0)
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            @foreach($articulos as $articulo)
                                <article class="overflow-hidden transition-shadow bg-white shadow-sm rounded-2xl hover:shadow-lg">
                                    @if($articulo->imagen_destacada)
                                        <a href="{{ $articulo->url }}" class="block">
                                            <img src="{{ asset('storage/' . $articulo->imagen_destacada) }}" 
                                                 alt="{{ $articulo->titulo }}" 
                                                 class="object-cover w-full h-48">
                                        </a>
                                    @endif
                                    <div class="p-6">
                                        @if($articulo->categoria)
                                            <a href="{{ route('blog.categoria', $articulo->categoria->slug) }}" 
                                               class="text-xs font-medium tracking-wide uppercase text-medico-azul-600">
                                                {{ $articulo->categoria->nombre }}
                                            </a>
                                        @endif
                                        <h2 class="mt-2 text-xl font-bold text-gray-900 hover:text-medico-azul-600">
                                            <a href="{{ $articulo->url }}">{{ $articulo->titulo }}</a>
                                        </h2>
                                        <p class="mt-3 text-gray-600 line-clamp-3">{{ $articulo->extracto }}</p>
                                        <div class="flex items-center justify-between mt-4 text-sm text-gray-500">
                                            <span>{{ $articulo->fecha_publicacion->format('d M, Y') }}</span>
                                            <span>{{ $articulo->tiempo_lectura }} min de lectura</span>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        {{-- Paginación --}}
                        <div class="mt-8">
                            {{ $articulos->links() }}
                        </div>
                    @else
                        <div class="p-12 text-center bg-white rounded-2xl">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                            <h2 class="mb-3 text-2xl font-bold text-gray-800">No hay artículos aún</h2>
                            <p class="text-gray-500">Pronto publicaremos contenido interesante sobre salud.</p>
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <aside class="lg:col-span-1">
                    <x-blog-sidebar />
                </aside>
            </div>
        </div>
    </section>
</x-app-layout>

<!-- Sidebar del Blog -->
<!-- 📁 Archivo: resources/views/components/blog-sidebar.blade.php -->

@php
use App\Models\Articulo;
use App\Models\Categoria;

$recientes = Articulo::publicados()->recientes()->limit(5)->get();
$categorias = Categoria::conArticulosPublicados()->ordenadas()->get();
@endphp

<aside class="space-y-8">
    
    <!-- Buscador -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-medico-azul-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Buscar
        </h3>
        <form action="{{ route('blog.buscar') }}" method="GET" class="relative">
            <input 
                type="text" 
                name="q"
                placeholder="Buscar artículos..."
                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-medico-azul-500 focus:border-transparent"
            >
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <button type="submit" class="absolute right-2 top-2 px-4 py-1.5 bg-medico-azul-500 text-white text-sm rounded-md hover:bg-medico-azul-600 transition">
                Buscar
            </button>
        </form>
    </div>

    <!-- Categorías -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-medico-azul-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
            </svg>
            Categorías
        </h3>
        <ul class="space-y-2">
            @foreach($categorias as $categoria)
                <li>
                    <a 
                        href="{{ route('blog.categoria', $categoria->slug) }}"
                        class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-gray-50 transition group"
                    >
                        <span class="flex items-center gap-2">
                            <span 
                                class="w-3 h-3 rounded-full"
                                style="background-color: {{ $categoria->color }}"
                            ></span>
                            <span class="text-gray-700 group-hover:text-medico-azul-600">{{ $categoria->nombre }}</span>
                        </span>
                        <span class="text-sm text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">
                            {{ $categoria->articulos()->publicados()->count() }}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Artículos Recientes -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-medico-azul-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Recientes
        </h3>
        <ul class="space-y-4">
            @foreach($recientes as $articulo)
                <li class="flex gap-3">
                    @if($articulo->imagen_destacada)
                        <img 
                            src="{{ asset('storage/' . $articulo->imagen_destacada) }}" 
                            alt="{{ $articulo->titulo }}"
                            class="w-16 h-16 object-cover rounded-lg flex-shrink-0"
                        >
                    @else
                        <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                    <div>
                        <a href="{{ $articulo->url }}" class="text-sm font-medium text-gray-900 hover:text-medico-azul-600 line-clamp-2">
                            {{ $articulo->titulo }}
                        </a>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $articulo->fecha_publicacion->format('d M, Y') }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Newsletter -->
    <div class="bg-gradient-to-br from-medico-azul-500 to-medico-azul-600 rounded-xl shadow-md p-6 text-white">
        <h3 class="text-lg font-bold mb-2 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Newsletter
        </h3>
        <p class="text-medico-azul-100 text-sm mb-4">
            Recibe consejos de salud y novedades directamente en tu correo.
        </p>
        <form action="{{ route('newsletter.suscribir') }}" method="POST" class="space-y-3">
            @csrf
            <input 
                type="email" 
                name="email"
                placeholder="tu@email.com"
                required
                class="w-full px-4 py-3 rounded-lg text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-white focus:outline-none"
            >
            <button type="submit" class="w-full py-3 bg-white text-medico-azul-600 font-medium rounded-lg hover:bg-medico-azul-50 transition">
                Suscribirme
            </button>
        </form>
        <p class="text-xs text-medico-azul-200 mt-3">
            Sin spam. Puedes darte de baja cuando quieras.
        </p>
    </div>

    <!-- Etiquetas Populares -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-medico-azul-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
            </svg>
            Populares
        </h3>
        <div class="flex flex-wrap gap-2">
            @php
                $populares = Articulo::publicados()->populares()->limit(5)->get();
            @endphp
            @foreach($populares as $popular)
                <a 
                    href="{{ $popular->url }}"
                    class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full hover:bg-medico-azul-100 hover:text-medico-azul-700 transition"
                >
                    {{ Str::limit($popular->titulo, 25) }}
                </a>
            @endforeach
        </div>
    </div>

</aside>

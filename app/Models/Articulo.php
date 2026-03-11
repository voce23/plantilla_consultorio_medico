<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

// 📁 Archivo: app/Models/Articulo.php
// Modelo para los artículos del blog

class Articulo extends Model
{
    protected $fillable = [
        'titulo',
        'slug',
        'categoria_id',
        'extracto',
        'contenido',
        'imagen_destacada',
        'meta_descripcion',
        'meta_keywords',
        'publicado',
        'fecha_publicacion',
        'visitas',
    ];

    protected $casts = [
        'publicado' => 'boolean',
        'fecha_publicacion' => 'datetime',
    ];

    /**
     * Boot: Auto-generar slug si no se proporciona
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($articulo) {
            if (empty($articulo->slug)) {
                $articulo->slug = Str::slug($articulo->titulo);
            }
            if (empty($articulo->extracto)) {
                $articulo->extracto = Str::limit(strip_tags($articulo->contenido), 150);
            }
        });
    }

    /**
     * Relación: Un artículo pertenece a una categoría
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Scope para artículos publicados
     */
    public function scopePublicados($query)
    {
        return $query->where('publicado', true)
            ->whereNotNull('fecha_publicacion')
            ->where('fecha_publicacion', '<=', now());
    }

    /**
     * Scope para ordenar por más recientes
     */
    public function scopeRecientes($query)
    {
        return $query->orderBy('fecha_publicacion', 'desc');
    }

    /**
     * Scope para artículos populares (por visitas)
     */
    public function scopePopulares($query)
    {
        return $query->orderBy('visitas', 'desc');
    }

    /**
     * Incrementar contador de visitas
     */
    public function incrementarVisitas(): void
    {
        $this->increment('visitas');
    }

    /**
     * Obtener URL del artículo
     */
    public function getUrlAttribute(): string
    {
        return route('blog.show', $this->slug);
    }

    /**
     * Obtener tiempo de lectura estimado
     */
    public function getTiempoLecturaAttribute(): int
    {
        $palabras = str_word_count(strip_tags($this->contenido));
        return max(1, ceil($palabras / 200)); // 200 palabras por minuto
    }
}

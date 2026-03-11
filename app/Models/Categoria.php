<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

// 📁 Archivo: app/Models/Categoria.php
// Modelo para las categorías del blog

class Categoria extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
        'color',
        'descripcion',
    ];

    /**
     * Relación: Una categoría tiene muchos artículos
     */
    public function articulos(): HasMany
    {
        return $this->hasMany(Articulo::class);
    }

    /**
     * Scope para ordenar por nombre
     */
    public function scopeOrdenadas($query)
    {
        return $query->orderBy('nombre');
    }

    /**
     * Scope para categorías con artículos publicados
     */
    public function scopeConArticulosPublicados($query)
    {
        return $query->whereHas('articulos', function ($q) {
            $q->where('publicado', true);
        });
    }
}

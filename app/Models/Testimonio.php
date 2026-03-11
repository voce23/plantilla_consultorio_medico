<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// 📁 Archivo: app/Models/Testimonio.php
// Modelo para gestionar testimonios de pacientes

class Testimonio extends Model
{
    protected $fillable = [
        'nombre',
        'foto',
        'estrellas',
        'comentario',
        'servicio',
        'aprobado',
        'destacado',
    ];

    protected $casts = [
        'estrellas' => 'integer',
        'aprobado' => 'boolean',
        'destacado' => 'boolean',
    ];

    /**
     * Scope para testimonios aprobados
     */
    public function scopeAprobados($query)
    {
        return $query->where('aprobado', true);
    }

    /**
     * Scope para testimonios destacados
     */
    public function scopeDestacados($query)
    {
        return $query->where('destacado', true);
    }

    /**
     * Scope para ordenar por más recientes
     */
    public function scopeRecientes($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}

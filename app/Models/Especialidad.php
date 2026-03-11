<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Especialidad extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'icono',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }

    public function servicios(): HasMany
    {
        return $this->hasMany(Servicio::class);
    }

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }

    /**
     * Scope: solo especialidades activas
     */
    public function scopeActivas($query)
    {
        return $query->where('activo', true);
    }

    /**
     * Scope: ordenar por nombre
     */
    public function scopeOrdenadas($query)
    {
        return $query->orderBy('nombre', 'asc');
    }
}

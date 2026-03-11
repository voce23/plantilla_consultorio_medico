<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 📁 Archivo: database/migrations/2026_03_10_205301_create_testimonios_table.php
// Migración para la tabla de testimonios de pacientes

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('foto')->nullable();
            $table->tinyInteger('estrellas')->default(5);
            $table->text('comentario');
            $table->string('servicio')->nullable();
            $table->boolean('aprobado')->default(false);
            $table->boolean('destacado')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonios');
    }
};

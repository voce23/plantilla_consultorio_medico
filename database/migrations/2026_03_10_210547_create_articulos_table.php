<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// 📁 Archivo: database/migrations/2026_03_10_210547_create_articulos_table.php
// Migración para la tabla de artículos del blog

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->text('extracto')->nullable();
            $table->longText('contenido');
            $table->string('imagen_destacada')->nullable();
            $table->string('meta_descripcion')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->boolean('publicado')->default(false);
            $table->timestamp('fecha_publicacion')->nullable();
            $table->integer('visitas')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articulos');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('especialidad_id')->nullable()->constrained('especialidads')->onDelete('set null');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('dni')->unique()->nullable();
            $table->string('cmp')->unique()->nullable(); // Colegio Médico del Perú
            $table->string('telefono')->nullable();
            $table->string('email')->unique();
            $table->text('biografia')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};

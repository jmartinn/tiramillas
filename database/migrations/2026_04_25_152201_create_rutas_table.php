<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rutas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('region_id')->constrained('regiones');
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->string('descripcion', 500);
            $table->text('descripcion_larga');
            $table->enum('categoria', ['naturaleza', 'cultura', 'gastronomia', 'patrimonio']);
            $table->enum('dificultad', ['facil', 'moderada', 'exigente']);
            $table->decimal('distancia_km', 6, 2);
            $table->unsignedSmallInteger('duracion_min');
            $table->decimal('lat_inicio', 10, 7);
            $table->decimal('lng_inicio', 10, 7);
            $table->string('punto_inicio');
            $table->string('punto_fin');
            $table->string('mejor_epoca')->nullable();
            $table->boolean('destacada')->default(false);
            $table->string('imagen_path')->nullable();
            $table->timestamps();

            $table->index('categoria');
            $table->index('destacada');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rutas');
    }
};

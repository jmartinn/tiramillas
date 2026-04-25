<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ruta_punto', function (Blueprint $table) {
            $table->foreignId('ruta_id')->constrained('rutas')->cascadeOnDelete();
            $table->foreignId('punto_id')->constrained('puntos')->cascadeOnDelete();
            $table->unsignedSmallInteger('orden');
            $table->string('descripcion_paso')->nullable();

            $table->primary(['ruta_id', 'punto_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ruta_punto');
    }
};

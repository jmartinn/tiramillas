<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('puntos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('region_id')->constrained('regiones');
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->text('descripcion');
            $table->enum('categoria', ['monumento', 'mirador', 'museo', 'gastronomia', 'naturaleza', 'otro']);
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->string('imagen_path')->nullable();
            $table->timestamps();

            $table->index('categoria');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('puntos');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('negocios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('region_id')->constrained('regiones');
            $table->string('nombre');
            $table->string('slug')->unique();
            $table->text('descripcion');
            $table->enum('categoria', ['alojamiento', 'restaurante', 'artesania', 'experiencia', 'transporte', 'otro']);
            $table->string('direccion');
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('sitio_web')->nullable();
            $table->enum('plan', ['basico', 'pro', 'premium'])->default('basico');
            $table->boolean('verificado')->default(false);
            $table->string('imagen_path')->nullable();
            $table->timestamps();

            $table->index('categoria');
            $table->index('verificado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('negocios');
    }
};

<?php

namespace Database\Factories;

use App\Models\Region;
use App\Models\Ruta;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Ruta>
 */
class RutaFactory extends Factory
{
    public function definition(): array
    {
        $tipo = fake()->randomElement(['Senda', 'Ruta', 'Camino', 'Vía Verde', 'Travesía', 'Sendero']);
        $lugar = fake()->randomElement([
            'la Ribera', 'los Picos', 'las Cumbres', 'la Sierra',
            'los Valles', 'las Hoces', 'el Acantilado', 'la Costa',
            'el Bosque', 'el Mirador', 'el Cañón', 'la Garganta',
        ]);
        $titulo = "$tipo de $lugar";

        return [
            'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory(),
            'region_id' => Region::query()->inRandomOrder()->value('id'),
            'titulo' => $titulo,
            'slug' => Str::slug($titulo).'-'.fake()->unique()->numerify('####'),
            'descripcion' => fake()->sentence(15),
            'descripcion_larga' => collect(range(1, 3))
                ->map(fn () => fake()->paragraph(6))
                ->join("\n\n"),
            'categoria' => fake()->randomElement(['naturaleza', 'cultura', 'gastronomia', 'patrimonio']),
            'dificultad' => fake()->randomElement(['facil', 'moderada', 'exigente']),
            'distancia_km' => fake()->randomFloat(2, 1.5, 45),
            'duracion_min' => fake()->numberBetween(45, 480),
            'lat_inicio' => fake()->randomFloat(7, 36.0, 43.5),
            'lng_inicio' => fake()->randomFloat(7, -8.5, 3.0),
            'punto_inicio' => fake()->city(),
            'punto_fin' => fake()->city(),
            'mejor_epoca' => fake()->randomElement(['primavera', 'verano', 'otoño', 'invierno', 'todo el año']),
            'destacada' => fake()->boolean(15),
            'imagen_path' => null,
        ];
    }
}

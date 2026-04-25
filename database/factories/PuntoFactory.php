<?php

namespace Database\Factories;

use App\Models\Punto;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Punto>
 */
class PuntoFactory extends Factory
{
    public function definition(): array
    {
        $tipo = fake()->randomElement(['Mirador', 'Catedral', 'Plaza', 'Castillo', 'Ermita', 'Museo', 'Puente', 'Faro']);
        $lugar = fake()->randomElement([
            'San Juan', 'Santa María', 'la Concordia', 'los Reyes', 'la Vega',
            'el Carmen', 'San Pedro', 'la Magdalena', 'los Mártires', 'la Encarnación',
        ]);
        $titulo = "$tipo de $lugar";

        return [
            'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory(),
            'region_id' => Region::query()->inRandomOrder()->value('id'),
            'titulo' => $titulo,
            'slug' => Str::slug($titulo).'-'.fake()->unique()->numerify('####'),
            'descripcion' => fake()->paragraph(4),
            'categoria' => fake()->randomElement(['monumento', 'mirador', 'museo', 'gastronomia', 'naturaleza', 'otro']),
            'lat' => fake()->randomFloat(7, 36.0, 43.5),
            'lng' => fake()->randomFloat(7, -8.5, 3.0),
            'imagen_path' => null,
        ];
    }
}

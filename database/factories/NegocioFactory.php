<?php

namespace Database\Factories;

use App\Models\Negocio;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Negocio>
 */
class NegocioFactory extends Factory
{
    public function definition(): array
    {
        $tipo = fake()->randomElement(['Hotel Rural', 'Casa Rural', 'Restaurante', 'Bodega', 'Taller', 'Posada', 'Mesón']);
        $apellido = fake()->lastName();
        $nombre = "$tipo $apellido";

        $region = Region::query()->inRandomOrder()->first();
        [$lat, $lng] = CoordenadasEspana::aleatorioEnRegion($region->slug);
        $categoria = fake()->randomElement(['alojamiento', 'restaurante', 'artesania', 'experiencia', 'transporte', 'otro']);

        return [
            'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory(),
            'region_id' => $region->id,
            'nombre' => $nombre,
            'slug' => Str::slug($nombre).'-'.fake()->unique()->numerify('####'),
            'descripcion' => fake()->paragraph(5),
            'categoria' => $categoria,
            'direccion' => fake()->streetAddress(),
            'lat' => $lat,
            'lng' => $lng,
            'telefono' => fake()->phoneNumber(),
            'email' => fake()->companyEmail(),
            'sitio_web' => fake()->boolean(40) ? fake()->url() : null,
            'plan' => fake()->randomElement(['basico', 'basico', 'basico', 'pro', 'premium']),
            'verificado' => fake()->boolean(20),
            'imagen_path' => null,
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\Negocio;
use App\Models\Punto;
use App\Models\Review;
use App\Models\Ruta;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContenidoSocialSeeder extends Seeder
{
    public function run(): void
    {
        $this->asociarPuntosARutas();
        $this->crearReseñas();
        $this->crearFavoritos();
    }

    private function asociarPuntosARutas(): void
    {
        $puntos = Punto::pluck('id')->all();

        Ruta::all()->each(function (Ruta $ruta) use ($puntos) {
            $cuantos = fake()->numberBetween(2, 5);
            $seleccion = collect($puntos)->shuffle()->take($cuantos);

            $datosPivot = $seleccion
                ->mapWithKeys(fn (int $puntoId, int $idx) => [
                    $puntoId => [
                        'orden' => $idx + 1,
                        'descripcion_paso' => fake()->boolean(40) ? fake()->sentence(8) : null,
                    ],
                ])
                ->all();

            $ruta->puntos()->syncWithoutDetaching($datosPivot);
        });
    }

    private function crearReseñas(): void
    {
        $usuarios = User::pluck('id')->all();
        $textos = [
            'Una experiencia increíble, repetiremos seguro.',
            'El paisaje es espectacular, sobre todo al atardecer. Recomendado.',
            'Más exigente de lo que esperaba pero merece la pena el esfuerzo.',
            'Perfecto para hacer en familia. Bien señalizado todo el recorrido.',
            'Hicimos la ruta en otoño y los colores eran impresionantes.',
            'La gente local fue muy amable. Volveremos en primavera.',
            'Bonita ruta aunque algo masificada en temporada alta.',
            'Muy buena opción para quien busca naturaleza sin grandes desniveles.',
            'Vistas inolvidables. Hay que llevar agua de sobra.',
            'Recorrido ideal para una mañana tranquila de fin de semana.',
        ];

        Ruta::all()->each(function (Ruta $ruta) use ($usuarios, $textos) {
            $cuantas = fake()->numberBetween(0, 4);
            $usuariosElegidos = collect($usuarios)
                ->reject(fn (int $id) => $id === $ruta->user_id)
                ->shuffle()
                ->take($cuantas);

            foreach ($usuariosElegidos as $userId) {
                Review::updateOrCreate(
                    ['user_id' => $userId, 'ruta_id' => $ruta->id],
                    [
                        'puntuacion' => fake()->numberBetween(3, 5),
                        'cuerpo' => fake()->randomElement($textos),
                    ],
                );
            }
        });
    }

    private function crearFavoritos(): void
    {
        $usuarios = User::pluck('id')->all();
        $rutas = Ruta::pluck('id')->all();
        $puntos = Punto::pluck('id')->all();
        $negocios = Negocio::pluck('id')->all();

        foreach ($usuarios as $userId) {
            $this->favoritos($userId, Ruta::class, $rutas, fake()->numberBetween(2, 6));
            $this->favoritos($userId, Punto::class, $puntos, fake()->numberBetween(3, 8));
            $this->favoritos($userId, Negocio::class, $negocios, fake()->numberBetween(0, 4));
        }
    }

    /**
     * @param  array<int>  $ids
     */
    private function favoritos(int $userId, string $modelClass, array $ids, int $cuantos): void
    {
        collect($ids)
            ->shuffle()
            ->take($cuantos)
            ->each(function (int $id) use ($userId, $modelClass) {
                DB::table('favoritos')->updateOrInsert(
                    [
                        'user_id' => $userId,
                        'favoritable_type' => $modelClass,
                        'favoritable_id' => $id,
                    ],
                    ['created_at' => now()],
                );
            });
    }
}

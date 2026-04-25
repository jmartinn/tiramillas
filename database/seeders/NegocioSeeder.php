<?php

namespace Database\Seeders;

use App\Models\Negocio;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NegocioSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = User::pluck('id')->all();
        $regionPorSlug = Region::pluck('id', 'slug');

        foreach ($this->negociosReales() as $datos) {
            $datos['user_id'] = fake()->randomElement($usuarios);
            $datos['region_id'] = $regionPorSlug[$datos['region_slug']];
            unset($datos['region_slug']);
            $datos['slug'] = Str::slug($datos['nombre']);

            Negocio::updateOrCreate(['slug' => $datos['slug']], $datos);
        }

        Negocio::factory()
            ->count(12)
            ->create();
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function negociosReales(): array
    {
        return [
            ['nombre' => 'Casa Rural La Tahona', 'region_slug' => 'castilla-y-leon', 'categoria' => 'alojamiento', 'direccion' => 'Calle del Horno 4, Covarrubias', 'lat' => 42.0606, 'lng' => -3.5198, 'telefono' => '947 406 252', 'plan' => 'pro', 'verificado' => true, 'descripcion' => 'Antigua tahona rehabilitada en pleno casco medieval de Covarrubias. Cuatro habitaciones con encanto y desayunos con productos de la zona.'],
            ['nombre' => 'Restaurante Echaurren', 'region_slug' => 'la-rioja', 'categoria' => 'restaurante', 'direccion' => 'Padre José García 19, Ezcaray', 'lat' => 42.3253, 'lng' => -3.0034, 'telefono' => '941 354 047', 'plan' => 'premium', 'verificado' => true, 'descripcion' => 'Cocina tradicional riojana con dos generaciones al frente, una estrella Michelin y vistas al valle del Oja desde el comedor.'],
            ['nombre' => 'Bodega Marqués de Riscal', 'region_slug' => 'pais-vasco', 'categoria' => 'experiencia', 'direccion' => 'Calle Torrea 1, Elciego', 'lat' => 42.5168, 'lng' => -2.6195, 'telefono' => '945 180 888', 'plan' => 'premium', 'verificado' => true, 'descripcion' => 'Bodega histórica con visitas guiadas, catas y un edificio firmado por Frank Gehry que se ha convertido en icono enoturístico.'],
            ['nombre' => 'Posada del Camino', 'region_slug' => 'galicia', 'categoria' => 'alojamiento', 'direccion' => 'Rúa Real 12, Sarria', 'lat' => 42.7795, 'lng' => -7.4129, 'telefono' => '982 535 200', 'plan' => 'basico', 'verificado' => false, 'descripcion' => 'Albergue tradicional para peregrinos en el corazón de Sarria, punto de partida habitual de las últimas etapas del Camino Francés.'],
            ['nombre' => 'Hotel Boutique Villa de Pitres', 'region_slug' => 'andalucia', 'categoria' => 'alojamiento', 'direccion' => 'Plaza Iglesia s/n, Pitres', 'lat' => 36.9325, 'lng' => -3.3358, 'telefono' => '958 766 218', 'plan' => 'pro', 'verificado' => true, 'descripcion' => 'Hotel rural en la Alpujarra granadina con habitaciones renovadas, terraza panorámica sobre Sierra Nevada y desayuno casero.'],
            ['nombre' => 'Mesón La Carcavilla', 'region_slug' => 'castilla-y-leon', 'categoria' => 'restaurante', 'direccion' => 'Calle Mayor 28, Pedraza', 'lat' => 41.1208, 'lng' => -3.8094, 'telefono' => '921 509 753', 'plan' => 'basico', 'verificado' => false, 'descripcion' => 'Asador clásico segoviano en la Plaza Mayor de Pedraza, especializado en cordero lechal y judiones de La Granja.'],
            ['nombre' => 'Casa Rural Era de los Tilos', 'region_slug' => 'cantabria', 'categoria' => 'alojamiento', 'direccion' => 'Barrio La Era 7, Carmona', 'lat' => 43.2406, 'lng' => -4.4186, 'telefono' => '942 728 134', 'plan' => 'pro', 'verificado' => true, 'descripcion' => 'Casona montañesa del siglo XVIII con seis habitaciones, jardín con tilos centenarios y desayuno con productos del valle de Carmona.'],
            ['nombre' => 'Taller de Cerámica Tito', 'region_slug' => 'andalucia', 'categoria' => 'artesania', 'direccion' => 'Calle Júpiter 15, Úbeda', 'lat' => 38.0136, 'lng' => -3.3702, 'telefono' => '953 751 302', 'plan' => 'basico', 'verificado' => true, 'descripcion' => 'Alfarería familiar con tradición desde 1929, especializada en la cerámica vidriada característica de Úbeda. Visitas, talleres y compra directa.'],
        ];
    }
}

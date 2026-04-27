<?php

namespace Database\Seeders;

use App\Models\Punto;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PuntoSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = User::pluck('id')->all();
        $regionPorSlug = Region::pluck('id', 'slug');

        foreach ($this->puntosReales() as $datos) {
            $datos['user_id'] = fake()->randomElement($usuarios);
            $datos['region_id'] = $regionPorSlug[$datos['region_slug']];
            unset($datos['region_slug']);
            $datos['slug'] = Str::slug($datos['titulo']);
            $datos['imagen_path'] = $this->copiarImagen($datos['slug']);

            Punto::updateOrCreate(['slug' => $datos['slug']], $datos);
        }
    }

    private function copiarImagen(string $slug): ?string
    {
        $origen = database_path("seeders/images/puntos/{$slug}.jpg");

        if (! file_exists($origen)) {
            return null;
        }

        $destino = "puntos/{$slug}.jpg";
        Storage::disk('public')->put($destino, file_get_contents($origen));

        return $destino;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function puntosReales(): array
    {
        return [
            ['titulo' => 'Catedral de Burgos', 'region_slug' => 'castilla-y-leon', 'categoria' => 'monumento', 'lat' => 42.34059, 'lng' => -3.70444, 'descripcion' => 'Joya del gótico español, Patrimonio de la Humanidad por la UNESCO desde 1984. Su construcción se inició en 1221 y combina influencias francesas, alemanas y mudéjares.'],
            ['titulo' => 'Alhambra de Granada', 'region_slug' => 'andalucia', 'categoria' => 'monumento', 'lat' => 37.1773, 'lng' => -3.5986, 'descripcion' => 'Conjunto palaciego nazarí, ejemplo cumbre del arte islámico en Occidente. Sus jardines del Generalife y los palacios nazaríes son una visita imprescindible.'],
            ['titulo' => 'Sagrada Familia', 'region_slug' => 'cataluna', 'categoria' => 'monumento', 'lat' => 41.4036, 'lng' => 2.1744, 'descripcion' => 'Basílica diseñada por Antoni Gaudí, en construcción desde 1882. Su silueta inconfundible y la luz que se cuela por sus vidrieras la convierten en una obra arquitectónica única.'],
            ['titulo' => 'Catedral de Sevilla y Giralda', 'region_slug' => 'andalucia', 'categoria' => 'monumento', 'lat' => 37.3858, 'lng' => -5.9931, 'descripcion' => 'La catedral gótica más grande del mundo, levantada sobre la antigua mezquita almohade. La Giralda, su antiguo alminar, sigue siendo el símbolo de Sevilla.'],
            ['titulo' => 'Acueducto de Segovia', 'region_slug' => 'castilla-y-leon', 'categoria' => 'monumento', 'lat' => 40.9485, 'lng' => -4.1184, 'descripcion' => 'Obra de ingeniería romana del siglo I-II, todavía en pie y sin argamasa. Sus 167 arcos cruzan la ciudad como si fueran de ayer mismo.'],
            ['titulo' => 'Mezquita-Catedral de Córdoba', 'region_slug' => 'andalucia', 'categoria' => 'monumento', 'lat' => 37.879, 'lng' => -4.7794, 'descripcion' => 'Edificio único en el mundo donde conviven la mezquita califal omeya y la catedral renacentista, símbolo del intercambio cultural en la Córdoba andalusí.'],
            ['titulo' => 'Plaza Mayor de Madrid', 'region_slug' => 'madrid', 'categoria' => 'monumento', 'lat' => 40.4154, 'lng' => -3.7074, 'descripcion' => 'Centro histórico de la ciudad desde el siglo XVII, escenario de coronaciones, autos de fe y mercados. Su uniformidad arquitectónica esconde siglos de historia.'],
            ['titulo' => 'Monasterio de El Escorial', 'region_slug' => 'madrid', 'categoria' => 'monumento', 'lat' => 40.5895, 'lng' => -4.1454, 'descripcion' => 'Conjunto monástico-real construido por Felipe II en el siglo XVI. Su sobriedad y la planta de parrilla simbolizan el martirio de San Lorenzo.'],
            ['titulo' => 'Museo del Prado', 'region_slug' => 'madrid', 'categoria' => 'museo', 'lat' => 40.4138, 'lng' => -3.6921, 'descripcion' => 'Una de las pinacotecas más importantes del mundo, con la mejor colección de Velázquez, Goya, El Greco y la pintura flamenca de los Países Bajos españoles.'],
            ['titulo' => 'Museo Guggenheim de Bilbao', 'region_slug' => 'pais-vasco', 'categoria' => 'museo', 'lat' => 43.2686, 'lng' => -2.934, 'descripcion' => 'Edificio de Frank Gehry inaugurado en 1997, símbolo de la regeneración urbana de Bilbao y referente del arte contemporáneo en Europa.'],
            ['titulo' => 'Cabo Fisterra', 'region_slug' => 'galicia', 'categoria' => 'mirador', 'lat' => 42.8826, 'lng' => -9.2697, 'descripcion' => 'El final de la tierra para los romanos, hoy meta espiritual del Camino de Santiago. Sus acantilados, el faro y los atardeceres atlánticos no se olvidan.'],
            ['titulo' => 'Mirador de Es Vedrà', 'region_slug' => 'baleares', 'categoria' => 'mirador', 'lat' => 38.8632, 'lng' => 1.2204, 'descripcion' => 'Vista de la pirámide rocosa de Es Vedrà desde Cala d\'Hort, una de las imágenes más mágicas del Mediterráneo, especialmente al atardecer.'],
            ['titulo' => 'Catedral de Toledo', 'region_slug' => 'castilla-la-mancha', 'categoria' => 'monumento', 'lat' => 39.8567, 'lng' => -4.0244, 'descripcion' => 'Catedral primada de España, gótica del siglo XIII con tesoros como el Transparente, una de las obras maestras del barroco europeo.'],
            ['titulo' => 'Castillo de Loarre', 'region_slug' => 'aragon', 'categoria' => 'monumento', 'lat' => 42.3274, 'lng' => -0.6105, 'descripcion' => 'Una de las fortalezas románicas mejor conservadas de Europa, encaramada sobre las primeras estribaciones del Pirineo aragonés.'],
            ['titulo' => 'Albarracín', 'region_slug' => 'aragon', 'categoria' => 'monumento', 'lat' => 40.4097, 'lng' => -1.4434, 'descripcion' => 'Conjunto urbano medieval de los más bellos de España, con casas de tonos rojizos y un trazado serpenteante sobre un meandro del río Guadalaviar.'],
        ];
    }
}

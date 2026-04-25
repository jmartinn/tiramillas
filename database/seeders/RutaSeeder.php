<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\Ruta;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RutaSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = User::pluck('id')->all();
        $regionPorSlug = Region::pluck('id', 'slug');

        foreach ($this->rutasReales() as $datos) {
            $datos['user_id'] = fake()->randomElement($usuarios);
            $datos['region_id'] = $regionPorSlug[$datos['region_slug']];
            unset($datos['region_slug']);
            $datos['slug'] = Str::slug($datos['titulo']);

            Ruta::updateOrCreate(['slug' => $datos['slug']], $datos);
        }

        Ruta::factory()
            ->count(20)
            ->create();
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function rutasReales(): array
    {
        return [
            [
                'titulo' => 'Senda del Cares',
                'region_slug' => 'asturias',
                'descripcion' => 'Espectacular ruta por la garganta del río Cares en los Picos de Europa, considerada la garganta divina.',
                'descripcion_larga' => "La Senda del Cares discurre por una garganta tallada por el río Cares entre Caín (León) y Poncebos (Asturias), con un paisaje impresionante de paredes verticales, túneles excavados en la roca y pasarelas colgantes.\n\nEs una de las rutas más conocidas y transitadas de los Picos de Europa, accesible para cualquier persona en buena forma física aunque sin grandes desniveles. La mejor época para hacerla es primavera y otoño, evitando los meses centrales del verano por la afluencia.",
                'categoria' => 'naturaleza',
                'dificultad' => 'moderada',
                'distancia_km' => 12.0,
                'duracion_min' => 240,
                'lat_inicio' => 43.221,
                'lng_inicio' => -4.892,
                'punto_inicio' => 'Caín de Valdeón',
                'punto_fin' => 'Poncebos',
                'mejor_epoca' => 'primavera y otoño',
                'destacada' => true,
            ],
            [
                'titulo' => 'Caminito del Rey',
                'region_slug' => 'andalucia',
                'descripcion' => 'Pasarela colgante reabierta al público en el desfiladero de los Gaitanes, en Málaga.',
                'descripcion_larga' => "El Caminito del Rey serpentea por las paredes verticales del desfiladero de los Gaitanes, a más de 100 metros sobre el río Guadalhorce. Tras décadas de abandono, fue rehabilitado en 2015 y hoy es uno de los recorridos más espectaculares de España.\n\nEl recorrido lineal de poco más de 7 kilómetros se completa en unas tres horas, e incluye pasarelas de madera ancladas a la pared, un puente colgante y vistas inolvidables del paisaje malagueño. Las entradas se compran con antelación y se acceden con horario fijo.",
                'categoria' => 'naturaleza',
                'dificultad' => 'facil',
                'distancia_km' => 7.7,
                'duracion_min' => 210,
                'lat_inicio' => 36.9293,
                'lng_inicio' => -4.7796,
                'punto_inicio' => 'Ardales',
                'punto_fin' => 'El Chorro',
                'mejor_epoca' => 'primavera y otoño',
                'destacada' => true,
            ],
            [
                'titulo' => 'Camino de Santiago Francés (etapa final)',
                'region_slug' => 'galicia',
                'descripcion' => 'Los últimos 100 km del Camino Francés, desde Sarria hasta Santiago de Compostela.',
                'descripcion_larga' => "Los últimos 100 kilómetros del Camino Francés, desde Sarria hasta Santiago, son la opción más popular para obtener la Compostela. La ruta atraviesa pueblos rurales gallegos, bosques de robles y castaños, y cruza ríos por puentes medievales.\n\nEs un recorrido accesible para personas con poca experiencia en senderismo, dividido en cinco etapas de unos 20 kilómetros cada una. La llegada a la Plaza del Obradoiro, frente a la catedral, es el momento culminante del viaje para miles de peregrinos cada año.",
                'categoria' => 'cultura',
                'dificultad' => 'moderada',
                'distancia_km' => 115.0,
                'duracion_min' => 1800,
                'lat_inicio' => 42.7795,
                'lng_inicio' => -7.4129,
                'punto_inicio' => 'Sarria',
                'punto_fin' => 'Santiago de Compostela',
                'mejor_epoca' => 'primavera y verano',
                'destacada' => true,
            ],
            [
                'titulo' => 'Ruta del Vino de la Rioja',
                'region_slug' => 'la-rioja',
                'descripcion' => 'Recorrido entre viñedos y bodegas centenarias por los pueblos riojanos más emblemáticos.',
                'descripcion_larga' => "La Ruta del Vino de la Rioja atraviesa los principales municipios productores de la Rioja Alta y Alavesa, con paradas en bodegas históricas, catas y enoturismo de primer nivel.\n\nIncluye visitas a Haro, Briones, San Vicente de la Sonsierra y Laguardia, además de paseos entre viñedos antiguos y catas guiadas. Es una ruta enogastronómica más que un sendero, ideal para hacerla en coche o en bici durante varios días.",
                'categoria' => 'gastronomia',
                'dificultad' => 'facil',
                'distancia_km' => 60.0,
                'duracion_min' => 720,
                'lat_inicio' => 42.5774,
                'lng_inicio' => -2.8467,
                'punto_inicio' => 'Haro',
                'punto_fin' => 'Logroño',
                'mejor_epoca' => 'septiembre y octubre',
                'destacada' => true,
            ],
            [
                'titulo' => 'Sendero de los Lagos de Covadonga',
                'region_slug' => 'asturias',
                'descripcion' => 'Ruta circular por los lagos Enol y Ercina en el corazón de los Picos de Europa.',
                'descripcion_larga' => "El sendero circular alrededor de los lagos Enol y Ercina, en el Parque Nacional de los Picos de Europa, ofrece algunas de las vistas más fotografiadas de Asturias.\n\nLa ruta combina pradería de alta montaña, ganado autóctono pastando libre y panorámicas de los Picos. Es accesible para cualquier nivel de senderismo y muy popular en verano. En temporada alta el acceso en coche está restringido y hay que llegar en autobús lanzadera desde Cangas de Onís.",
                'categoria' => 'naturaleza',
                'dificultad' => 'facil',
                'distancia_km' => 5.5,
                'duracion_min' => 120,
                'lat_inicio' => 43.2746,
                'lng_inicio' => -4.9831,
                'punto_inicio' => 'Lago Enol',
                'punto_fin' => 'Lago Enol',
                'mejor_epoca' => 'verano y principios de otoño',
                'destacada' => true,
            ],
            [
                'titulo' => 'Cabo de Gata: Ruta de Las Negras a San José',
                'region_slug' => 'andalucia',
                'descripcion' => 'Sendero costero por calas vírgenes y acantilados volcánicos del parque natural más árido de Europa.',
                'descripcion_larga' => "El sendero costero del Cabo de Gata recorre el tramo entre Las Negras y San José, atravesando algunas de las calas más espectaculares del Mediterráneo: Cala San Pedro, Cala del Plomo y la imponente playa de Mónsul.\n\nEs un parque natural protegido con una geología volcánica única en Europa. La ruta requiere llevar agua suficiente porque no hay fuentes en el camino y el sol pega fuerte casi todo el año. Recomendable hacerla en primavera u otoño.",
                'categoria' => 'naturaleza',
                'dificultad' => 'moderada',
                'distancia_km' => 18.5,
                'duracion_min' => 360,
                'lat_inicio' => 36.8761,
                'lng_inicio' => -2.0117,
                'punto_inicio' => 'Las Negras',
                'punto_fin' => 'San José',
                'mejor_epoca' => 'primavera y otoño',
                'destacada' => false,
            ],
            [
                'titulo' => 'Sierra de Tramuntana: Es Cornadors',
                'region_slug' => 'baleares',
                'descripcion' => 'Ascensión a un mirador natural sobre el valle de Sóller en plena Tramuntana mallorquina.',
                'descripcion_larga' => "La ruta a Es Cornadors parte de Sóller y asciende por un sendero histórico de carboneros hasta uno de los miradores más espectaculares de la sierra de Tramuntana, con vistas sobre el valle, el mar y los acantilados de la costa norte.\n\nLa subida tiene un desnivel considerable pero ningún tramo técnico. La sierra es Patrimonio de la Humanidad por la UNESCO y combina naturaleza, agricultura tradicional y arquitectura rural mallorquina.",
                'categoria' => 'naturaleza',
                'dificultad' => 'exigente',
                'distancia_km' => 14.0,
                'duracion_min' => 360,
                'lat_inicio' => 39.7659,
                'lng_inicio' => 2.7148,
                'punto_inicio' => 'Sóller',
                'punto_fin' => 'Sóller',
                'mejor_epoca' => 'invierno y primavera',
                'destacada' => false,
            ],
            [
                'titulo' => 'Vía Verde de la Sierra',
                'region_slug' => 'andalucia',
                'descripcion' => 'Antiguo trazado ferroviario reconvertido en sendero de 36 km entre Olvera y Puerto Serrano.',
                'descripcion_larga' => "Una de las vías verdes más bellas de España, sobre el antiguo trazado del ferrocarril Jerez-Almargen, nunca terminado de construir. Atraviesa 30 túneles y 4 viaductos por la sierra gaditana, con observatorios de aves y áreas recreativas.\n\nEs una ruta plana ideal para hacer en bicicleta, accesible para familias y completamente señalizada. La estación de Olvera reconvertida en alojamiento es un buen punto de partida o final.",
                'categoria' => 'naturaleza',
                'dificultad' => 'facil',
                'distancia_km' => 36.0,
                'duracion_min' => 360,
                'lat_inicio' => 36.937,
                'lng_inicio' => -5.262,
                'punto_inicio' => 'Olvera',
                'punto_fin' => 'Puerto Serrano',
                'mejor_epoca' => 'todo el año',
                'destacada' => false,
            ],
            [
                'titulo' => 'Hoces del Río Lobos',
                'region_slug' => 'castilla-y-leon',
                'descripcion' => 'Cañón fluvial entre Soria y Burgos con la ermita templaria de San Bartolomé.',
                'descripcion_larga' => "El cañón del Río Lobos es un parque natural de paredes calizas, buitreras y cuevas que ha inspirado a poetas como Antonio Machado. La ruta lineal hasta la ermita templaria de San Bartolomé, en pleno cañón, es la opción más popular.\n\nLa ermita del siglo XIII destaca por sus simbología templaria y su localización casi mágica entre los acantilados. La ruta es prácticamente plana y discurre por una pista forestal cómoda.",
                'categoria' => 'patrimonio',
                'dificultad' => 'facil',
                'distancia_km' => 6.5,
                'duracion_min' => 150,
                'lat_inicio' => 41.7544,
                'lng_inicio' => -3.0581,
                'punto_inicio' => 'Ucero',
                'punto_fin' => 'Ermita de San Bartolomé',
                'mejor_epoca' => 'primavera y otoño',
                'destacada' => false,
            ],
            [
                'titulo' => 'Camí de Cavalls (etapa Es Grau - Favàritx)',
                'region_slug' => 'baleares',
                'descripcion' => 'Etapa costera del antiguo camino circular de Menorca, con tramos vírgenes y faro emblemático.',
                'descripcion_larga' => "Una de las etapas más bellas del Camí de Cavalls, el antiguo sendero defensivo que rodea Menorca. Discurre entre el Parque Natural de s'Albufera des Grau y el faro de Favàritx, con cambios bruscos de paisaje y calas escondidas.\n\nEl tramo combina caminos de tierra rojiza, dunas, lagunas costeras y la geología negra del Cap de Favàritx, uno de los puntos más fotografiados de la isla. Es accesible aunque expuesto al viento y al sol.",
                'categoria' => 'naturaleza',
                'dificultad' => 'moderada',
                'distancia_km' => 10.0,
                'duracion_min' => 180,
                'lat_inicio' => 39.9508,
                'lng_inicio' => 4.2628,
                'punto_inicio' => 'Es Grau',
                'punto_fin' => 'Faro de Favàritx',
                'mejor_epoca' => 'primavera y otoño',
                'destacada' => false,
            ],
        ];
    }
}

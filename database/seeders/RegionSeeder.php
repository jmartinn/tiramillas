<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $regiones = [
            ['nombre' => 'Andalucía', 'slug' => 'andalucia', 'codigo_iso' => 'ES-AN'],
            ['nombre' => 'Aragón', 'slug' => 'aragon', 'codigo_iso' => 'ES-AR'],
            ['nombre' => 'Principado de Asturias', 'slug' => 'asturias', 'codigo_iso' => 'ES-AS'],
            ['nombre' => 'Islas Baleares', 'slug' => 'baleares', 'codigo_iso' => 'ES-IB'],
            ['nombre' => 'Canarias', 'slug' => 'canarias', 'codigo_iso' => 'ES-CN'],
            ['nombre' => 'Cantabria', 'slug' => 'cantabria', 'codigo_iso' => 'ES-CB'],
            ['nombre' => 'Castilla y León', 'slug' => 'castilla-y-leon', 'codigo_iso' => 'ES-CL'],
            ['nombre' => 'Castilla-La Mancha', 'slug' => 'castilla-la-mancha', 'codigo_iso' => 'ES-CM'],
            ['nombre' => 'Cataluña', 'slug' => 'cataluna', 'codigo_iso' => 'ES-CT'],
            ['nombre' => 'Comunidad Valenciana', 'slug' => 'valenciana', 'codigo_iso' => 'ES-VC'],
            ['nombre' => 'Extremadura', 'slug' => 'extremadura', 'codigo_iso' => 'ES-EX'],
            ['nombre' => 'Galicia', 'slug' => 'galicia', 'codigo_iso' => 'ES-GA'],
            ['nombre' => 'Comunidad de Madrid', 'slug' => 'madrid', 'codigo_iso' => 'ES-MD'],
            ['nombre' => 'Región de Murcia', 'slug' => 'murcia', 'codigo_iso' => 'ES-MC'],
            ['nombre' => 'Comunidad Foral de Navarra', 'slug' => 'navarra', 'codigo_iso' => 'ES-NC'],
            ['nombre' => 'País Vasco', 'slug' => 'pais-vasco', 'codigo_iso' => 'ES-PV'],
            ['nombre' => 'La Rioja', 'slug' => 'la-rioja', 'codigo_iso' => 'ES-RI'],
            ['nombre' => 'Ceuta', 'slug' => 'ceuta', 'codigo_iso' => 'ES-CE'],
            ['nombre' => 'Melilla', 'slug' => 'melilla', 'codigo_iso' => 'ES-ML'],
        ];

        foreach ($regiones as $region) {
            Region::updateOrCreate(['codigo_iso' => $region['codigo_iso']], $region);
        }
    }
}

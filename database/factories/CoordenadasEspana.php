<?php

namespace Database\Factories;

/**
 * Devuelve coordenadas plausibles dentro de cada comunidad autónoma,
 * tomadas de las principales ciudades con un pequeño desplazamiento aleatorio.
 * Evita el problema de generar puntos en mitad del mar.
 */
class CoordenadasEspana
{
    private const CIUDADES = [
        'andalucia' => [
            [37.3886, -5.9823],
            [36.7213, -4.4214],
            [37.1773, -3.5986],
            [37.879, -4.7794],
            [36.5298, -6.2924],
            [36.8381, -2.4597],
            [37.7749, -3.7849],
            [37.2614, -6.9447],
        ],
        'aragon' => [
            [41.6488, -0.8891],
            [42.1401, -0.4087],
            [40.3456, -1.1064],
        ],
        'asturias' => [
            [43.3614, -5.8493],
            [43.5453, -5.6619],
        ],
        'baleares' => [
            [39.5696, 2.6502],
            [39.8885, 4.2658],
            [38.9067, 1.4206],
        ],
        'canarias' => [
            [28.1235, -15.4363],
            [28.4636, -16.2518],
            [27.9202, -15.5474],
        ],
        'cantabria' => [
            [43.4623, -3.8099],
            [43.3505, -4.0517],
        ],
        'castilla-y-leon' => [
            [41.6523, -4.7245],
            [40.9701, -5.6635],
            [42.3439, -3.6969],
            [42.5987, -5.5671],
            [40.9485, -4.1184],
            [40.6566, -4.6814],
            [41.7665, -2.4796],
            [42.0095, -4.5288],
        ],
        'castilla-la-mancha' => [
            [39.8567, -4.0244],
            [40.6286, -3.167],
            [40.0704, -2.1374],
            [38.9943, -1.8585],
            [38.9848, -3.9272],
        ],
        'cataluna' => [
            [41.3851, 2.1734],
            [41.9831, 2.8249],
            [41.1189, 1.2445],
            [41.6176, 0.62],
        ],
        'valenciana' => [
            [39.4699, -0.3763],
            [38.3452, -0.481],
            [39.9864, -0.0513],
        ],
        'extremadura' => [
            [38.8794, -6.9706],
            [39.4753, -6.3724],
        ],
        'galicia' => [
            [42.8806, -8.5448],
            [43.3713, -8.396],
            [42.2406, -8.7207],
            [42.431, -8.6446],
            [43.0097, -7.5567],
            [42.3408, -7.8642],
        ],
        'madrid' => [
            [40.4168, -3.7038],
            [40.4893, -3.6826],
            [40.3169, -3.7585],
        ],
        'murcia' => [
            [37.9922, -1.1307],
            [37.6257, -0.9966],
        ],
        'navarra' => [
            [42.8125, -1.6458],
            [42.0635, -1.6086],
        ],
        'pais-vasco' => [
            [43.2627, -2.9253],
            [43.3183, -1.9812],
            [42.8467, -2.6716],
        ],
        'la-rioja' => [
            [42.4627, -2.4449],
            [42.4408, -2.6905],
        ],
        'ceuta' => [
            [35.8894, -5.3203],
        ],
        'melilla' => [
            [35.2924, -2.9381],
        ],
    ];

    /**
     * @return array{0: float, 1: float}
     */
    public static function aleatorioEnRegion(string $slugRegion): array
    {
        $ciudades = self::CIUDADES[$slugRegion] ?? self::CIUDADES['madrid'];
        [$lat, $lng] = fake()->randomElement($ciudades);

        return [
            round($lat + fake()->randomFloat(4, -0.025, 0.025), 7),
            round($lng + fake()->randomFloat(4, -0.025, 0.025), 7),
        ];
    }
}

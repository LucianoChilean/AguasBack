<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        $regions = [
            [1, 'Arica y Parinacota', 'XV'],
            [2, 'Tarapacá', 'I'],
            [3, 'Antofagasta', 'II'],
            [4, 'Atacama', 'III'],
            [5, 'Coquimbo', 'IV'],
            [6, 'Valparaiso', 'V'],
            [7, 'Metropolitana de Santiago', 'RM'],
            [8, 'Libertador General Bernardo O\'Higgins', 'VI'],
            [9, 'Maule', 'VII'],
            [10, 'Ñuble', 'XVI'],
            [11, 'Biobío', 'VIII'],
            [12, 'La Araucanía', 'IX'],
            [13, 'Los Ríos', 'XIV'],
            [14, 'Los Lagos', 'X'],
            [15, 'Aisén del General Carlos Ibáñez del Campo', 'XI'],
            [16, 'Magallanes y de la Antártica Chilena', 'XII']
        ];
        $regions = array_map(function ($region) use ($now) {
            return [
                'id' => $region[0],
                'order' => $region[0],
                'nombre' => $region[1],
                'ordinal_symbol' => $region[2],
                'updated_at' => $now,
                'created_at' => $now,
            ];
        }, $regions);

        \DB::table('regions')->insert($regions);
    }
}

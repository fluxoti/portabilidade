<?php

use Faker\Factory as Faker;


class OperadoraTableSeeder extends Seeder
{

    public function run()
    {
        $data = [
            [
                'rn1' => 1,
                'carrier' => 'TIM'
            ],
            [
                'rn1' => 2,
                'carrier' => 'CLARO'
            ],
            [
                'rn1' => 3,
                'carrier' => 'NEXTEL'
            ],
            [
                'rn1' => 4,
                'carrier' => 'OI'
            ],
            [
                'rn1' => 5,
                'carrier' => 'VIVO'
            ],
        ];

        DB::table('operadora')->insert([$data[0]]);
        DB::table('operadora')->insert([$data[1]]);
        DB::table('operadora')->insert([$data[2]]);
        DB::table('operadora')->insert([$data[3]]);
        DB::table('operadora')->insert([$data[4]]);

    }

}
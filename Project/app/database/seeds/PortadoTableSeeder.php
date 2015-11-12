<?php

class PortadoTableSeeder extends Seeder
{

    public function run()
    {
        $data = [
            [
                'version_id' => 1,
                'number' => 4288147032,
                'rn1' => 1,
                'date' => '2015-01-01 00:00:00',
                'operation' => 1,
                'eot' => 997
            ],
            [
                'version_id' => 1,
                'number' => 4212345678,
                'rn1' => 2,
                'date' => '2015-01-01 00:00:00',
                'operation' => 'd',
                'eot' => null
            ],
            [
                'version_id' => 1,
                'number' => 4288556622,
                'rn1' => 1,
                'date' => "2015-01-01 00:00:00",
                'operation' => 'd',
                'eot' => null
            ],
            [
                'version_id' => 1,
                'number' => 1234567890,
                'rn1' => 4,
                'date' => date('Y-m-d H:i:s'),
                'operation' => 'd',
                'eot' => null
            ]
        ];

        DB::table('portado')->insert([$data[0]]);
        DB::table('portado')->insert([$data[1]]);
        DB::table('portado')->insert([$data[2]]);
        DB::table('portado')->insert([$data[3]]);
    }

}
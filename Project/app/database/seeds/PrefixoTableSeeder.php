<?php

use Faker\Factory as Faker;


class PrefixoTableSeeder extends Seeder
{

    public function run()
    {
        $data = [
            [
                'carrier' => 'TIM',
                'type' => 'M',
                'rn1' => 1,
                'ddd' => 42,
                'prefix' => '9901',
                'mdu_initial' => '2',
                'mdu_final' => '2769',
                'eot' => '997',
                'uf' => 'pr',
                'cnl' => 1
            ],
            [
                'carrier' => 'TIM',
                'type' => 'M',
                'rn1' => 1,
                'ddd' => 42,
                'prefix' => '9951',
                'mdu_initial' => '2',
                'mdu_final' => '2387',
                'eot' => '997',
                'uf' => 'pr',
                'cnl' => 1
            ],
            [
                'carrier' => 'Claro',
                'type' => 'M',
                'rn1' => 2,
                'ddd' => 42,
                'prefix' => '8814',
                'mdu_initial' => '8',
                'mdu_final' => '7032',
                'eot' => '997',
                'uf' => 'pr',
                'cnl' => 1
            ],
            [
                'carrier' => 'TIM',
                'type' => 'M',
                'rn1' => 1,
                'ddd' => 41,
                'prefix' => '9951',
                'mdu_initial' => '9',
                'mdu_final' => '4442',
                'eot' => '997',
                'uf' => 'pr',
                'cnl' => 1
            ],
            [
                'carrier' => 'VIVO',
                'type' => 'M',
                'rn1' => 5,
                'ddd' => 11,
                'prefix' => '99658',
                'mdu_initial' => '9',
                'mdu_final' => '4561',
                'eot' => '997',
                'uf' => 'pr',
                'cnl' => 1
            ],
            [
                'carrier' => 'Claro',
                'type' => 'M',
                'rn1' => 2,
                'ddd' => 11,
                'prefix' => '98851',
                'mdu_initial' => '9',
                'mdu_final' => '7441',
                'eot' => '997',
                'uf' => 'pr',
                'cnl' => 1
            ],
            [
                'carrier' => 'Claro',
                'type' => 'M',
                'rn1' => 2,
                'ddd' => 11,
                'prefix' => '98853',
                'mdu_initial' => '9',
                'mdu_final' => '9897',
                'eot' => '997',
                'uf' => 'pr',
                'cnl' => 1
            ],
            [
                'carrier' => 'TIM',
                'type' => 'M',
                'rn1' => 1,
                'ddd' => 11,
                'prefix' => '98751',
                'mdu_initial' => '9',
                'mdu_final' => '9941',
                'eot' => '997',
                'uf' => 'pr',
                'cnl' => 1
            ],
            [
                'carrier' => 'TIM',
                'type' => 'M',
                'rn1' => 1,
                'ddd' => 47,
                'prefix' => '9984',
                'mdu_initial' => '9',
                'mdu_final' => '8520',
                'eot' => '997',
                'uf' => 'pr',
                'cnl' => 1
            ],
            [
                'carrier' => 'VIVO',
                'type' => 'M',
                'rn1' => 5,
                'ddd' => 41,
                'prefix' => '9921',
                'mdu_initial' => '9',
                'mdu_final' => '7281',
                'eot' => '997',
                'uf' => 'pr',
                'cnl' => 1
            ],
            [
                'carrier' => 'TIM',
                'type' => 'M',
                'rn1' => 1,
                'ddd' => 41,
                'prefix' => '9951',
                'mdu_initial' => '9',
                'mdu_final' => '2387',
                'eot' => '997',
                'uf' => 'pr',
                'cnl' => 1
            ],
            [
                'carrier' => 'Claro',
                'type' => 'M',
                'rn1' => 2,
                'ddd' => 11,
                'prefix' => '98851',
                'mdu_initial' => '9',
                'mdu_final' => '7379',
                'eot' => '997',
                'uf' => 'pr',
                'cnl' => 1
            ],
            [
                'carrier' => 'VIVO',
                'type' => 'M',
                'rn1' => 5,
                'ddd' => 11,
                'prefix' => '98921',
                'mdu_initial' => '9',
                'mdu_final' => '7419',
                'eot' => '997',
                'uf' => 'pr',
                'cnl' => 1
            ],
            [
                'carrier' => 'VIVO',
                'type' => 'M',
                'rn1' => 1,
                'ddd' => 12,
                'prefix' => '3456',
                'mdu_initial' => '9',
                'mdu_final' => '7890',
                'eot' => '997',
                'uf' => 'pr',
                'cnl' => 1
            ],
        ];
        foreach ($data as $prefixo) {
            DB::table('prefixo')->insert([$prefixo]);
        }
    }

}
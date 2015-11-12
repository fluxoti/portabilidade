<?php

use Faker\Factory as Faker;
use Portabilidade\Lists\ConsultList;


class ListTableSeeder extends Seeder {

    public function run()
    {
        ConsultList::create([
            'name' => 'List001',
            'file_name' => 'list001.csv',
            'active' => 1,
            'finished' => 1,
            'company_id' => 2
        ]);
        ConsultList::create([
            'name' => 'List002',
            'file_name' => 'list002.csv',
            'active' => 1,
            'finished' => 1,
            'company_id' => 2
        ]);
        ConsultList::create([
            'name' => 'List003',
            'file_name' => 'list003.csv',
            'active' => 1,
            'finished' => 0,
            'company_id' => 2
        ]);
        ConsultList::create([
            'name' => 'List004',
            'file_name' => 'list004.csv',
            'active' => 1,
            'finished' => 0,
            'company_id' => 2
        ]);
        ConsultList::create([
            'name' => 'List005',
            'file_name' => 'list005.csv',
            'active' => 1,
            'finished' => 0,
            'company_id' => 3
        ]);
    }

}
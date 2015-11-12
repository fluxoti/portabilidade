<?php

use Faker\Factory as Faker;
use Portabilidade\Users\User;


class MongoListsSeeder extends Seeder
{

    public function run()
    {
        $db = App::make('Illuminate\Database\DatabaseManager');
        $model = $db->connection('mongodb')->collection('lists');

        $model->insert(
            [
                'id' => 2,
                'carriers' => ['Tim' => ['m' => 50], 'Claro' => ['m' => 35], 'Vivo' => ['m' => 15]],
                'header' => ['nome', 'fone']
            ]
        );

        $model = $db->connection('mongodb')->collection('lists_data');

        $model->insert(
            [
                'list_id' => 2,
                'data' => ['joao', 1234567890]
            ]
        );
    }

}
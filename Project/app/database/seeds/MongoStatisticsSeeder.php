<?php

use Faker\Factory as Faker;
use Portabilidade\Users\User;


class MongoStatisticsSeeder extends Seeder
{

    public function run()
    {
        $db = App::make('Illuminate\Database\DatabaseManager');
        $model = $db->connection('mongodb')->collection('consultations_days');
        $i = 10;
        for ($i = 10; $i < 12; $i++) {
            $date = "2015-03-" . $i;
            $model->where('company_id', 1)
                ->update(
                    [
                        '$setOnInsert' => [
                            'company_id' => 1,
                            'day' => $date,
                        ],
                        '$inc' => [
                            "carriers.Claro" => 1
                        ]
                    ],
                    ['upsert' => true]
                );

        }

        $model = $db->connection('mongodb')->collection('consultations_days');
        $i = 10;
        for ($i = 10; $i < 12; $i++) {
            $date = "2015-03-" . $i;
            $model->where('company_id', 2)
                ->update(
                    [
                        '$setOnInsert' => [
                            'company_id' => 2,
                            'day' => $date,
                        ],
                        '$inc' => [
                            "carriers.Claro" => 1
                        ]
                    ],
                    ['upsert' => true]
                );

        }
    }

}
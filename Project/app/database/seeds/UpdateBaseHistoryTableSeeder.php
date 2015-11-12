<?php

use Portabilidade\UpdateBaseHistory\UpdateBaseHistory;

class UpdateBaseHistoryTableSeeder extends Seeder
{

    public function run()
    {
        UpdateBaseHistory::create(
            [
                'file_name' => 'portado',
                'size' => '123',
                'lines' => 27,
                'success' => '1',
                'imported_at' => '2015-05-05 10:00:00',
                'finished_at' => '2015-05-05 10:00:00',
                'provider' => 'procob'
            ]
        );
    }
}
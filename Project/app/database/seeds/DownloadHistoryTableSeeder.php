<?php

use Portabilidade\DownloadHistory\DownloadHistory;

class DownloadHistoryTableSeeder extends Seeder
{

    public function run()
    {
        DownloadHistory::create(
            [
                'file_name' => 'Free Inc.',
                'file_size' => '123456',
                'file_size' => 27,
                'ip' => '222.222.222',
                'user_id' => '2',
                'company_id' => '2',
                'user_token' => 'client2token'
            ]
        );
    }
}
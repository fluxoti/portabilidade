<?php

class PasswordRemindersTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'email' => 'client@fluxoti.dev',
                'token' => 'client1token',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'email' => 'client2@fluxoti.dev',
                'token' => 'client2token',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'email' => 'client3@fluxoti.dev',
                'token' => 'client3token',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        DB::table('password_reminders')->insert([$data[0]]);
        DB::table('password_reminders')->insert([$data[1]]);
        DB::table('password_reminders')->insert([$data[2]]);

    }
}
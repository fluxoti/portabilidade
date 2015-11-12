<?php

use Faker\Factory as Faker;
use Portabilidade\Users\User;


class UserTableSeeder extends Seeder {

    public function run()
    {

        User::create([
            'name' => 'Admin',
            'email' => 'admin@fluxoti.dev',
            'password' => 'admin',
            'situation' => 1,
            'api_token' => 'admintoken',
            'admin' => true
        ]);

        User::create([
            'name' => 'Free Client',
            'email' => 'client@fluxoti.dev',
            'password' => 'client',
            'situation' => 1,
            'api_token' => 'client1token',
            'admin' => false,
            'company_id' => 1
        ]);

        User::create([
            'name' => 'Basic Client',
            'email' => 'client2@fluxoti.dev',
            'password' => 'client',
            'situation' => 1,
            'api_token' => 'client2token',
            'admin' => false,
            'company_id' => 2
        ]);

        User::create([
            'name' => 'Professional Client',
            'email' => 'client3@fluxoti.dev',
            'password' => 'client',
            'situation' => 1,
            'api_token' => 'client3token',
            'admin' => false,
            'company_id' => 3
        ]);

        User::create([
            'name' => 'Client not Activated',
            'email' => 'client4@fluxoti.dev',
            'password' => 'client',
            'situation' => 1,
            'api_token' => 'client4token',
            'admin' => false,
            'company_id' => 1
        ]);

        User::create([
            'name' => 'Blocked Client',
            'email' => 'client5@fluxoti.dev',
            'password' => 'client',
            'situation' => 2,
            'api_token' => 'client5token',
            'admin' => false,
            'company_id' => 1
        ]);

        User::create([
            'name' => 'Client without requests',
            'email' => 'client6@fluxoti.dev',
            'password' => 'client',
            'situation' => 1,
            'api_token' => 'client6token',
            'admin' => false,
            'company_id' => 4
        ]);

        User::create([
            'name' => 'Client without requests 2',
            'email' => 'client7@fluxoti.dev',
            'password' => 'client',
            'situation' => 1,
            'api_token' => 'client7token',
            'admin' => false,
            'company_id' => 7
        ]);

        User::create([
            'name' => 'Client changing billing day',
            'email' => 'clientbilling@fluxoti.dev',
            'password' => 'client',
            'situation' => 1,
            'api_token' => 'clienttoken',
            'admin' => false,
            'company_id' => 8
        ]);

    }

}
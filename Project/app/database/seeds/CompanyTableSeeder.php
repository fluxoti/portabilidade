<?php

use Portabilidade\Companies\Company;

class CompanyTableSeeder extends Seeder {

    public function run()
    {

        Company::create([
            'name' => 'Free Inc.',
            'cnpj' => '12.123.123/0001-12',
            'address' => 'Rua Teste, 123, Guarapuava - PR',
            'phone' => '4612345678',
            'email' => 'free@test.com'
        ]);

        Company::create([
            'name' => 'Basic Inc.',
            'cnpj' => '12.123.123/0001-12',
            'address' => 'Rua Teste, 123, Guarapuava - PR',
            'phone' => '4612345678',
            'email' => 'basic@test.com'
        ]);

        Company::create([
            'name' => 'Professional Inc.',
            'cnpj' => '12.123.123/0001-12',
            'address' => 'Rua Teste, 123, Guarapuava - PR',
            'phone' => '4612345678',
            'email' => 'professional@test.com'
        ]);

        Company::create([
            'name' => 'Basic Inc. without allowed requests',
            'cnpj' => '12.123.123/0001-12',
            'address' => 'Rua Teste, 123, Guarapuava - PR',
            'phone' => '4612345678',
            'email' => 'basic2@test.com'
        ]);

        Company::create([
            'name' => 'Professional Inc. with positive balance',
            'cnpj' => '12.123.123/0001-12',
            'address' => 'Rua Teste, 123, Guarapuava - PR',
            'phone' => '4612345678',
            'email' => 'professional2@test.com'
        ]);

        Company::create([
            'name' => 'Professional Inc. with positive balance AND discount',
            'cnpj' => '12.123.123/0001-12',
            'address' => 'Rua Teste, 123, Guarapuava - PR',
            'phone' => '4612345678',
            'email' => 'professional3@test.com'
        ]);

        Company::create([
            'name' => 'Basic Inc. with negative balance AND with allowed requests',
            'cnpj' => '12.123.123/0001-12',
            'address' => 'Rua Teste, 123, Guarapuava - PR',
            'phone' => '4612345678',
            'email' => 'basic33@test.com'
        ]);

        Company::create([
            'name' => 'Basic Inc. with variable billing date',
            'cnpj' => '12.123.123/0001-12',
            'address' => 'Rua Teste, 123, Guarapuava - PR',
            'phone' => '4612345678',
            'email' => 'basic8@test.com'
        ]);

        Company::create([
            'name' => 'Basic Inc. Inactive',
            'cnpj' => '42.123.143/0001-12',
            'address' => 'Rua Teste, 123, Guarapuava - PR',
            'phone' => '4612123678',
            'email' => 'basic9@test.com',
            'status' => 0
        ]);
    }
}
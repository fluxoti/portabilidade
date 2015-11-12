<?php

use Faker\Factory as Faker;
use Portabilidade\Extracts\Extract as Extract;

class ExtractTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'description' => 'Assinatura Plano',
                'quantity' => 1,
                'value' => 300,
                'company_id' => 3,
                'operation' => 'debit',
                'date' => '2014-12-15',
            ],
            [
                'description' => 'Pagamento de Boleto',
                'quantity' => 1,
                'value' => 300.00,
                'company_id' => 3,
                'operation' => 'credit',
                'date' => '2014-12-10',
            ],
            [
                'description' => 'Pagamento de Boleto',
                'quantity' => 1,
                'value' => 150.00,
                'company_id' => 3,
                'operation' => 'credit',
                'date' => '2014-12-12',
            ],
        ];

        foreach( $data as $extract)
            Extract::create($extract);

        for ($i = 0; $i < 5; $i++) {
            Extract::create( [
                'description' => 'Consultas excedentes',
                'quantity' => 5,
                'value' => '1.2',
                'company_id' => 2,
                'operation' => 'debit',
                'date' => Carbon\Carbon::now()->subDays(7)
            ]);
        }

        for ($i = 0; $i < 5; $i++) {
            Extract::create( [
                'description' => 'Consultas excedentes',
                'quantity' => 5,
                'value' => '0.9603',
                'company_id' => 2,
                'operation' => 'debit',
                'date' => Carbon\Carbon::now()->subDays(7)
            ]);
        }

        for ($i = 0; $i < 20; $i++) {
            Extract::create( [
                'description' => 'Consultas excedentes',
                'quantity' => 5,
                'value' => '1.2',
                'company_id' => 2,
                'operation' => 'debit',
                'date' => Carbon\Carbon::now()
            ]);
        }
    }
}

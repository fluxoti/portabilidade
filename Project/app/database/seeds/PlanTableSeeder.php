<?php

use Portabilidade\Plans\Plan;

class PlanTableSeeder extends Seeder
{

    public function run()
    {

        Plan::create(
            [
                'name' => 'MasterPro1000',
                'plan_type' => 'Professional',
                'public' => 0,
                'price' => 1000.00,
                'allowed_requests' => 0,
                'excess_value' => 0
            ]
        );

        Plan::create(
            [
                'name' => 'SuperPro15000',
                'plan_type' => 'Professional',
                'public' => 0,
                'price' => 15000.00,
                'allowed_requests' => 0,
                'excess_value' => 0
            ]
        );
    }
}
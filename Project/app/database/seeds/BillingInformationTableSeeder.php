<?php

use Portabilidade\Billing\BillingInformation;

class BillingInformationTableSeeder extends Seeder {

    public function run()
    {
        $billing_info = [
            'company_id' => 1,
            'allowed_requests' => 2500,
            'balance' => '150.00',
            'billing_date' => 10,
            'plan_id' => '1',
            'next_billing_date' => '2015-01-01'
        ];

        BillingInformation::create($billing_info);

        $billing_info = [
            'company_id' => 2,
            'allowed_requests' => 50000,
            'balance' => '300.00',
            'billing_date' => 20,
            'plan_id' => '2',
            'next_billing_date' => '2015-01-01'
        ];

        BillingInformation::create($billing_info);

        $billing_info = [
            'company_id' => 3,
            'allowed_requests' => 0,
            'balance' => '300.00',
            'billing_date' => 28,
            'plan_id' => '3',
            'next_billing_date' => '2015-01-01'
        ];

        BillingInformation::create($billing_info);

        $billing_info = [
            'company_id' => 4,
            'allowed_requests' => 0,
            'balance' => '10.00',
            'billing_date' => 20,
            'plan_id' => '2',
            'next_billing_date' => '2015-01-01'
        ];

        BillingInformation::create($billing_info);

        $billing_info = [
            'company_id' => 5,
            'allowed_requests' => 0,
            'balance' => '1000.00',
            'billing_date' => 20,
            'plan_id' => '3',
            'next_billing_date' => '2015-01-01'
        ];

        BillingInformation::create($billing_info);

        $billing_info = [
            'company_id' => 6,
            'allowed_requests' => 0,
            'balance' => '10000.00',
            'billing_date' => 20,
            'plan_id' => '3',
            'next_billing_date' => Carbon\Carbon::now()->addDays(2)
        ];

        BillingInformation::create($billing_info);

        $billing_info = [
            'company_id' => 7,
            'allowed_requests' => 0,
            'balance' => '0.00',
            'billing_date' => 20,
            'plan_id' => '2',
            'next_billing_date' => '2015-01-01'
        ];

        BillingInformation::create($billing_info);

        $billing_info = [
            'company_id' => 8,
            'allowed_requests' => 100,
            'balance' => '149.90',
            'billing_date' => 01,
            'plan_id' => '2',
            'next_billing_date' => '2015-05-01'
        ];

        BillingInformation::create($billing_info);

        $billing_info = [
            'company_id' => 9,
            'allowed_requests' => 100,
            'balance' => '149.90',
            'billing_date' => 01,
            'plan_id' => '2',
            'next_billing_date' => '2015-05-01'
        ];

        BillingInformation::create($billing_info);

    }

}
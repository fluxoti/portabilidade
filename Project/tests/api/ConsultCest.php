<?php

use Portabilidade\Users\User;
use Portabilidade\Clients\Client;
use Portabilidade\Billing\BillingInformation;
use Portabilidade\Plans\Plan;
use Carbon\Carbon;

use Faker\Factory as Faker;

class ConsultCestCest
{
    private $faker;

    public function __construct()
    {
    }

    /** @test */
    public function it_should_consult_a_number(ApiTester $I)
    {
        $I->am('a client');
        $I->wantTo("consult a number");

        $number = '4299012769';

        $I->sendGet("consult/{$number}");

        $I->seeResponseContainsJson(
            [
                "data" => [
                    "carrier" => "TIM"
                ],
                "status_code" => 200
            ]
        );

    }


    /** @test */
    public function it_should_consult_a_ported_number(ApiTester $I)
    {
        $I->am('a client');
        $I->wantTo("consult a ported number");
        $number = '4288147032';

        $I->sendGet("consult/{$number}");

        $I->seeResponseContainsJson(
            [
                "data" => [
                    "carrier" => "TIM"
                ],
                "status_code" => 200
            ]
        );

    }

    /** @test */
    public function it_should_make_a_full_consultation_with_a_number_never_ported(ApiTester $I)
    {
        $I->am('a client');
        $I->wantTo("make a full consultation with a number that was never ported");
        $now = Carbon::now()->toDateTimeString();
        $number = '4299012769';

        $I->sendGet("fullConsult/{$number}");

        $I->seeResponseContainsJson(
            [
                "data" => [
                    "number" => "4299012769",
                    "portado" => false,
                    "original_carrier" => "TIM",
                    'original_rn1' => 1,
                    "current_carrier" => "TIM",
                    'current_rn1' => 1,
                    "type" => "M",
                    "last_updated" => $now,
                ],
                "status_code" => 200
            ]
        );
    }

    public function it_should_make_a_full_consultation_with_a_number_already_ported(ApiTester $I)
    {
        $I->am('a client');
        $I->wantTo("make a full consultation with an already ported number");
        $number = '4288147032';

        $I->sendGet("fullConsult/{$number}");

        $I->seeResponseContainsJson(
            [
                "data" => [
                    "number" => "4288147032",
                    "portado" => true,
                    "original_carrier" => "CLARO",
                    "original_rn1" => 2,
                    "current_carrier" => "TIM",
                    "current_rn1" => 1,
                    "type" => "M",
                    "last_updated" => "2015-01-01 00:00:00",
                ],
                "status_code" => 200
            ]
        );
    }

    public function it_should_make_a_full_consultation_with_an_invalid_number(ApiTester $I)
    {
        $I->am('a client');
        $I->wantTo("make a full consultation with an invalid number");
        $number = '42881';

        $I->sendGet("fullConsult/{$number}");

        $I->seeResponseContainsJson(
            [
                "errors" => [
                    "number" => [
                        "O campo número deverá conter entre 10 - 12 caracteres."
                    ],
                ],
                "status_code" => 422
            ]
        );
    }

    public function it_should_make_a_full_consultation_with_a_non_existing_number(ApiTester $I)
    {
        $I->am('a client');
        $I->wantTo("make a full consultation with a non existing number");
        $number = '4201234567';

        $I->sendGet("fullConsult/{$number}");

        $I->seeResponseContainsJson(
            [
               "data" => ['number' => '4201234567',
                   'portado' => false,
                   'original_carrier' => 'nao_identificado',
                   'original_rn1' => 0,
                   'current_carrier' => 'nao_identificado',
                   'current_rn1' => 0,
                   'type' => NULL,
                   'last_updated' => date("Y-m-d H:i:s"),
               ],
                "status_code" => 200
            ]
        );
    }
   /** @test */
    public function it_should_consult_a_number_with_simple_consult(ApiTester $I)
    {
        $I->am('a client');
        $I->wantTo("consult a number");
        $number = '4299012769';

        $I->sendGet("simpleConsult?tel={$number}");

        $I->seeResponseContains(
            'tim'
        );

    }
}
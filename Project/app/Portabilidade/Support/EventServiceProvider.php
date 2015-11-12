<?php namespace Portabilidade\Support;

use Illuminate\Support\ServiceProvider;
use Event;

class EventServiceProvider extends ServiceProvider {


    public function boot()
    {
        Event::listen('consult.done', 'Portabilidade\Statistics\StatisticEventHandler@whenConsultDone');
        Event::listen('consult.done', 'Portabilidade\Billing\BillingEventHandler@whenConsultDone');
        Event::listen('send-mail', 'Portabilidade\Email\EmailEventHandler@whenSendEmail');

        Event::listen('credits.added', 'Portabilidade\Billing\BillingEventHandler@whenCreditsAdded');

        Event::listen('accountStatement.register', 'Portabilidade\Extracts\AccountStatementEventHandler@register');
        Event::listen('accountStatement.registerOrIncrease',
            'Portabilidade\Extracts\AccountStatementEventHandler@registerOrIncrease');

        Event::listen('upload_list.done', 'Portabilidade\Lists\ListEventHandler@whenUploadDone');

        Event::listen('save-response-time', 'Portabilidade\ResponseTime\ResponseTimeEventHandler@saveResponseTime');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }
}
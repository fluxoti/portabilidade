<?php namespace Portabilidade\Support;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Portabilidade\Users\UserRepositoryInterface',
            'Portabilidade\Users\EloquentUserRepository');

        $this->app->bind('Portabilidade\Session\LoginRepositoryInterface',
            'Portabilidade\Session\EloquentLoginRepository');

        $this->app->bind('Portabilidade\Settings\SettingsRepositoryInterface',
            'Portabilidade\Settings\EloquentSettingsRepository');

        $this->app->bind('Portabilidade\Clients\ClientRepositoryInterface',
            'Portabilidade\Clients\EloquentClientRepository');

        $this->app->bind('Portabilidade\Register\RegisterRepositoryInterface',
            'Portabilidade\Register\EloquentRegisterRepository');

        $this->app->bind('Portabilidade\Companies\CompanyRepositoryInterface',
            'Portabilidade\Companies\EloquentCompanyRepository');

        $this->app->bind('Portabilidade\Billing\BillingInformationRepositoryInterface',
            'Portabilidade\Billing\EloquentBillingInformationRepository');

        $this->app->bind('Portabilidade\Extracts\ExtractRepositoryInterface',
            'Portabilidade\Extracts\EloquentExtractRepository');

    }
}
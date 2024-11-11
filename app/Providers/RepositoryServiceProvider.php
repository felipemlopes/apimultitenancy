<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

        $this->app->bind(
            'App\Repositories\Affiliate\AffiliateInterface',
            'App\Repositories\Affiliate\AffiliateRepository'
        );
        $this->app->bind(
            'App\Repositories\AffiliateTransacion\AffiliateTransacionInterface',
            'App\Repositories\AffiliateTransacion\AffiliateTransacionRepository'
        );
        $this->app->bind(
            'App\Repositories\BlackList\BlackListInterface',
            'App\Repositories\BlackList\BlackListRepository'

        );

        $this->app->bind(
            'App\Repositories\CartList\CartListInterface',
            'App\Repositories\CartList\CartListRepository'

        );
        $this->app->bind(
            'App\Repositories\CotasPremiadas\CotasPremiadasInterface',
            'App\Repositories\CotasPremiadas\CotasPremiadasRepository'

        );
        $this->app->bind(
            'App\Repositories\Customer\CustomerListInterface',
            'App\Repositories\Customer\CustomerListRepository'

        );

        $this->app->bind(
            'App\Repositories\Fila\FilaInterface',
            'App\Repositories\Fila\FilaRepository'

        );
        $this->app->bind(
            'App\Repositories\FrasePremiada\FrasePremiadaInterface',
            'App\Repositories\FrasePremiada\FrasePremiadaRepository'

        );
        $this->app->bind(
            'App\Repositories\LinkCampanha\LinkCampanhaInterface',
            'App\Repositories\LinkCampanha\LinkCampanhaRepository'

        );
        $this->app->bind(
            'App\Repositories\OrderItems\OrderItemsInterface',
            'App\Repositories\OrderItems\OrderItemsRepository'

        );
        $this->app->bind(
            'App\Repositories\OrderList\OrderListInterface',
            'App\Repositories\OrderList\OrderListRepository'

        );
        $this->app->bind(
            'App\Repositories\RecuperacaoVendas\RecuperacaoVendasInterface',
            'App\Repositories\RecuperacaoVendas\RecuperacaoVendasRepository'

        );
        $this->app->bind(
            'App\Repositories\SystemInfo\SystemInfoInterface',
            'App\Repositories\SystemInfo\SystemInfoRepository'

        );
        $this->app->bind(
            'App\Repositories\Tetant\TetantInterface',
            'App\Repositories\Tetant\TetantRepository'

        );

        $this->app->bind(
            'App\Repositories\TimePremium\TimePremiumInterface',
            'App\Repositories\TimePremium\TimePremiumRepository'

        );
        $this->app->bind(
            'App\Repositories\User\UserInterface',
            'App\Repositories\User\UserRepository'
        );
        $this->app->bind(
            'App\Repositories\Withdrawal\WithdrawalInterface',
            'App\Repositories\Withdrawal\WithdrawalRepository'
        );
        $this->app->bind(
            'App\Repositories\YoyoLock\YoyoLockInterface',
            'App\Repositories\YoyoLock\YoyoLockRepository'
        );
        $this->app->bind(
            'App\Repositories\ProductList\ProductListInterface',
            'App\Repositories\ProductList\ProductListRepository'

        );
        $this->app->bind(
            'App\Repositories\YoyoLog\YoyoLogInterface',
            'App\Repositories\YoyoLog\YoyoLogRepository'
        );
        $this->app->bind(
            'App\Repositories\YoyoMigration\YoyoMigrationInterface',
            'App\Repositories\YoyoMigration\YoyoMigrationRepository'
        );
        $this->app->bind(
            'App\Repositories\YoyoVersion\YoyoVersionInterface',
            'App\Repositories\YoyoVersion\YoyoVersionRepository'
        );

        $this->app->bind(
            'App\Repositories\Login\LoginInterface',
            'App\Repositories\Login\LoginRepository'
        );

        $this->app->bind(
            'App\Repositories\Perfil\PerfilInterface',
            'App\Repositories\Perfil\PerfilRepository'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

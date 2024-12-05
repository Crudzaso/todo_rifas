<?php

namespace App\Providers;

use App\Events\AccountDeletion;
use App\Listeners\SendAccountDeletion;
use App\Listeners\SendLoginNotification;
use App\Listeners\sendMessegeRegisterNotification;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }


    protected $listen = [

        Login::class => [
            SendLoginNotification::class,
        ],
        Registered::class=> [
            sendMessegeRegisterNotification::class
        ],
        AccountDeletion::class =>[
            SendAccountDeletion::class
        ]
    ];
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}

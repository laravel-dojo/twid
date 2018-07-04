<?php

namespace Meditate\IdentityCard;

use Meditate\IdentityCard\Services\TaiwanIdentityCard;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class IdentityCardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('tw_id', 'Meditate\IdentityCard\IdentityCardValidator@twIdCheck', 'The :attribute is not correct.');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TaiwanIdentityCard::class, function () {
            return new TaiwanIdentityCard;
        });
    }
}

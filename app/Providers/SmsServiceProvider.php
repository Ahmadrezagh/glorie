<?php

namespace App\Providers;

use App\Interfaces\SmsInterface;
use App\Services\Sms\KaveNegarSms;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(SmsInterface::class, KaveNegarSms::class);
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
	{

        // $this->registerPolicies();
		\App\Models\User::observe(\App\Observers\UserObserver::class);


        \Carbon\Carbon::setLocale('zh');

    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

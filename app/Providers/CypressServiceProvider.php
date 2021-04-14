<?php

namespace App\Providers;

use App\Models\User;
use Hash;
use Illuminate\Support\ServiceProvider;
use NoelDeMartin\LaravelCypress\Facades\Cypress;

class CypressServiceProvider extends ServiceProvider
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
    }
}

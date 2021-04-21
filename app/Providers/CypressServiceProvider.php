<?php

namespace App\Providers;

use App\Models\User;
use Hash;
use Illuminate\Support\ServiceProvider;

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
        if ($this->app->environment('local') && class_exists('\NoelDeMartin\LaravelCypress\Facades\Cypress')) {
            \NoelDeMartin\LaravelCypress\Facades\Cypress::command('getAdmin', function () {
                $user = User::updateOrCreate([
                    'email' => 'admin@cypress.test',
                ], [
                    'name' => 'Cypress Admin',
                    'password' => Hash::make('password'),
                ]);

                $user->assignRole('admin');

                return $user;
            });
        }
    }
}

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
        if ($this->app->environment('local')) {
            Cypress::command('getAdmin', function () {
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

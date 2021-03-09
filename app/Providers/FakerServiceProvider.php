<?php

namespace App\Providers;

use Faker\Factory;
use Faker\Generator;
use faker\provider\FontAwesomeGeneratorProvider;
use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Generator::class, function($app) {
            $faker = Factory::create();
            $faker->addProvider(new FontAwesomeGeneratorProvider($faker));
            return $faker;
        });
    }
}

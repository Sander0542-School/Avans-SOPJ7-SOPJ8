<?php

namespace App\Providers;

use App\Models\Domain;
use App\Models\Layer;
use App\Models\Subject;
use App\Observers\DomainObserver;
use App\Observers\LayerObserver;
use App\Observers\SubjectObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Subject::observe(SubjectObserver::class);
        Layer::observe(LayerObserver::class);
        Domain::observe(DomainObserver::class);
    }
}

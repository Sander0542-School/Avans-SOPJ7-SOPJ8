<?php

namespace App\Observers;

use App\Models\Domain;
use Spatie\Permission\Models\Permission;

class DomainObserver
{
    /**
     * Handle the Domain "created" event.
     *
     * @param  \App\Models\Domain  $domain
     * @return void
     */
    public function created(Domain $domain)
    {
        Permission::create(['name' => 'domains.*.'.$domain->id]);
        Permission::create(['name' => 'domains.update.'.$domain->id]);
        Permission::create(['name' => 'domains.delete.'.$domain->id]);
    }

    /**
     * Handle the Domain "updated" event.
     *
     * @param  \App\Models\Domain  $domain
     * @return void
     */
    public function updated(Domain $domain)
    {
        //
    }

    /**
     * Handle the Domain "deleted" event.
     *
     * @param  \App\Models\Domain  $domain
     * @return void
     */
    public function deleted(Domain $domain)
    {
        //
    }

    /**
     * Handle the Domain "restored" event.
     *
     * @param  \App\Models\Domain  $domain
     * @return void
     */
    public function restored(Domain $domain)
    {
        //
    }

    /**
     * Handle the Domain "force deleted" event.
     *
     * @param  \App\Models\Domain  $domain
     * @return void
     */
    public function forceDeleted(Domain $domain)
    {
        //
    }
}

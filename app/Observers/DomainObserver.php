<?php

namespace App\Observers;

use App\Common\Traits\PermissionsTrait;
use App\Models\Domain;

class DomainObserver
{
    use PermissionsTrait;

    /**
     * Handle the Domain "created" event.
     *
     * @param \App\Models\Domain $domain
     * @return void
     */
    public function created(Domain $domain)
    {
        $this->createPermissions('domains', $domain->id);
    }

    /**
     * Handle the Domain "updated" event.
     *
     * @param \App\Models\Domain $domain
     * @return void
     */
    public function updated(Domain $domain)
    {
        //
    }

    /**
     * Handle the Domain "deleted" event.
     *
     * @param \App\Models\Domain $domain
     * @return void
     */
    public function deleted(Domain $domain)
    {
        //
    }

    /**
     * Handle the Domain "restored" event.
     *
     * @param \App\Models\Domain $domain
     * @return void
     */
    public function restored(Domain $domain)
    {
        //
    }

    /**
     * Handle the Domain "force deleted" event.
     *
     * @param \App\Models\Domain $domain
     * @return void
     */
    public function forceDeleted(Domain $domain)
    {
        //
    }
}

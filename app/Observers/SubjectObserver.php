<?php

namespace App\Observers;

use App\Models\Subject;
use Spatie\Permission\Models\Permission;

class SubjectObserver
{
    /**
     * Handle the Subject "created" event.
     *
     * @param  \App\Models\Subject  $subject
     * @return void
     */
    public function created(Subject $subject)
    {
        Permission::create(['name' => 'subjects.*.'.$subject->id]);
        Permission::create(['name' => 'subjects.update.'.$subject->id]);
        Permission::create(['name' => 'subjects.delete.'.$subject->id]);
    }

    /**
     * Handle the Subject "updated" event.
     *
     * @param  \App\Models\Subject  $subject
     * @return void
     */
    public function updated(Subject $subject)
    {
        //
    }

    /**
     * Handle the Subject "deleted" event.
     *
     * @param  \App\Models\Subject  $subject
     * @return void
     */
    public function deleted(Subject $subject)
    {
        //
    }

    /**
     * Handle the Subject "restored" event.
     *
     * @param  \App\Models\Subject  $subject
     * @return void
     */
    public function restored(Subject $subject)
    {
        //
    }

    /**
     * Handle the Subject "force deleted" event.
     *
     * @param  \App\Models\Subject  $subject
     * @return void
     */
    public function forceDeleted(Subject $subject)
    {
        //
    }
}

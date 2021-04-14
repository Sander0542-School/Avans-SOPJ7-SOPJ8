<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class FillPermissionsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Permission::create(['name' => 'domains.*']);
        Permission::create(['name' => 'layers.*']);
        Permission::create(['name' => 'subjects.*']);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('domains.*');
        $admin->givePermissionTo('layers.*');
        $admin->givePermissionTo('subjects.*');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

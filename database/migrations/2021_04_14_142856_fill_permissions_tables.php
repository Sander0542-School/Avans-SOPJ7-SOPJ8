<?php

use Illuminate\Database\Migrations\Migration;
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

        Role::create([
            'id' => 1,
            'name' => 'Super Admin',
        ]);
        Role::create([
            'id' => 2,
            'name' => 'Admin',
        ]);
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

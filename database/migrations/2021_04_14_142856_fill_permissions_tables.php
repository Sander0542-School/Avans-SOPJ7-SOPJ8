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
        Permission::create(['name' => 'domains.create']);
        Permission::create(['name' => 'domains.update.*']);
        Permission::create(['name' => 'domains.delete.*']);

        Permission::create(['name' => 'subjects.*']);
        Permission::create(['name' => 'subjects.create']);
        Permission::create(['name' => 'subjects.update.*']);
        Permission::create(['name' => 'subjects.delete.*']);

        Permission::create(['name' => 'layers.*']);
        Permission::create(['name' => 'layers.create']);
        Permission::create(['name' => 'layers.update.*']);
        Permission::create(['name' => 'layers.delete.*']);

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

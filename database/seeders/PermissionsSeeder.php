<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'layers.*']);
        Permission::create(['name' => 'subjects.*']);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('layers.*');
        $admin->givePermissionTo('subjects.*');

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@expeditiekaart.nl',
            'password' => \Hash::make('password')
        ]);

        $user->assignRole($admin);
    }
}

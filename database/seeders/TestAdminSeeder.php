<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TestAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name' => '1',
            'email' => '1@test.nl',
            'password' => \Hash::make('password')
        ]);
        $user2 = User::create([
            'name' => '2',
            'email' => '2@test.nl',
            'password' => \Hash::make('password')
        ]);

        $user1->assignRole('Admin');
        $user2->assignRole('Super Admin');
    }
}

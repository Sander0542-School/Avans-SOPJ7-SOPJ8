<?php

namespace Http\Controllers;

use App\Http\Controllers\Admin\ManagerController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
Use Spatie\Permission\Models\Role;

class ManagerControllerUpdateTest extends TestCase
{

    use RefreshDatabase;

    public $user;
    public $testUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->user = User::create([
            'name' => 'fakeadmin',
            'email' => 'fakeadmin@expeditiekaart.nl',
            'password' => \Hash::make('password'),
        ]);

        $this->user->assignRole('Super Admin');

        $this->actingAs($this->user);

        $this->testUser = User::create([
            'name' => '1',
            'email' => '1@test.nl',
            'password' => \Hash::make('password'),
        ]);
    }

    protected function tearDown(): void
    {
        User::destroy($this->user->id);
        parent::tearDown();
    }

    public function test_update_manager_to_superadmin() {
        $superAdmin = 'Super Admin';

        $this->testUser->assignRole('Admin');

        $superAdminRole = Role::all()->where('name', $superAdmin)->first();

        $response = $this->put(route('admin.managers.update', $this->testUser), [
            'name' => '1',
            'email' => '1@test.nl',
            'role' => $superAdminRole->id,
            'custom_permissions' => false
        ]);

        $updatedManager = User::where('email', '1@test.nl')->first();

        $this->assertTrue($updatedManager->hasRole($superAdmin));
    }

    public function test_update_manager_to_admin() {
        $admin = 'Admin';

        $this->testUser->assignRole('Super Admin');

        $adminRole = Role::all()->where('name', $admin)->first();

        $response = $this->put(route('admin.managers.update', $this->testUser), [
            'name' => '1',
            'email' => '1@test.nl',
            'role' => $adminRole->id,
            'custom_permissions' => false
        ]);

        $updatedManager = User::where('email', '1@test.nl')->first();
        $this->assertTrue($updatedManager->hasRole($admin));
    }

    public function test_update_manager_name() {
        $admin = 'Admin';
        $newName = '123';
        $this->testUser->assignRole($admin);

        $response = $this->put(route('admin.managers.update', $this->testUser), [
            'name' => $newName,
            'email' => '1@test.nl',
            'role' => 2,
            'custom_permissions' => false
        ]);

        $updatedManager = User::where('email', '1@test.nl')->first();
        $this->assertTrue($updatedManager->name == $newName);
    }

    public function test_update_manager_email() {
        $admin = 'Admin';
        $newEmail = '123@test.nl';
        $this->testUser->assignRole($admin);

        $response = $this->put(route('admin.managers.update', $this->testUser), [
            'name' => '1',
            'email' => $newEmail,
            'role' => 2,
            'custom_permissions' => false
        ]);

        $updatedManager = User::where('name', '1')->first();
        $this->assertTrue($updatedManager->email == $newEmail);
    }

    public function test_update_manager_permissions_add_subjects() {
        $this->testUser->assignRole('Admin');

        $response = $this->put(route('admin.managers.update', $this->testUser), [
            'name' => $this->testUser->name,
            'email' => $this->testUser->email,
            'custom_permissions' => true,
            'subjects' => [1, 2, 3]
        ]);
        dd($this->testUser->hasPermissionTo('subjects.*.3'));
        $this->assertTrue($this->testUser->getAllPermissions() == ['layers.*.1', 'layers.*.2', 'layers.*.3']);
    }
}

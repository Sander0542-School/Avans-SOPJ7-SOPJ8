<?php

namespace Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManagerControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();

        $this->actingAs(User::first());
    }

    public function test_account_creation_page_can_be_loaded()
    {
        $response = $this->get(route('admin.managers.create'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.admin.manager.create');
    }

    public function test_account_can_be_created()
    {
        $response = $this->post(route('admin.managers.store'), [
            'name' => 'Test Manager',
            'email' => 'Manager@test.nl',
            'role' => 2,
            'custom_permissions' => false
        ]);

        $response->assertRedirect(route('admin.managers.index'));
    }

    public function test_account_deletion_in_index_can_be_loaded()
    {
        $response = $this->get(route('admin.managers.index'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.admin.manager.index');
    }

    public function test_account_can_be_deleted()
    {
        $manager = User::factory()->create();

        $response = $this->delete(route('admin.managers.destroy', ['manager' => $manager]), [
            'name' => 'Test Manager',
            'email' => 'Manager@test.nl',
            'role' => 'Admin',
            'custom_permissions' => false
        ]);

        $response->assertRedirect(route('admin.managers.index'));
    }
}

<?php

namespace Http\Controllers;

use App\Models\Domain;
use App\Models\Subject;
use App\Models\User;
use Database\Factories\SubjectFactory;
use Hash;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MapControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@expeditiekaart.nl',
            'password' =>  Hash::make('password')
        ]);

        $this->actingAs($user);
    }

    public function test_map_can_be_loaded()
    {
        $response = $this->get(route('admin.map.index'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.admin.map.index');
    }

    public function test_map_can_be_updated()
    {
        Domain::factory()->create();
        $subject = Subject::factory()->create();

        $response = $this->post(route('admin.map.update'), [
            'subjects' => [
                [
                    'id' => $subject->id,
                    'lat' => 52.113052,
                    'lon' => 6.611401
                ]
            ]
        ]);

        $response->assertRedirect(route('admin.map.index'));
    }
}

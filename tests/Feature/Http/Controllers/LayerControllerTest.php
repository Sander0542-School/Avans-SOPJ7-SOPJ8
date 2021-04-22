<?php

namespace Http\Controllers;

use App\Http\Controllers\LayerController;
use App\Models\Layer;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use function React\Promise\all;

class LayerControllerTest extends TestCase
{
    use RefreshDatabase;

    public $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->user = User::create([
            'name' => 'fakeadmin',
            'email' => 'fakeadmin@expeditiekaart.nl',
            'password' => \Hash::make('password'),
        ]);

        $this->user->assignRole('superadmin');

        $this->actingAs($this->user);
    }

    protected function tearDown(): void
    {
        User::destroy($this->user->id);
        parent::tearDown();
    }

    public function test_storing_layer_parent_subject()
    {
        $response = $this->post(route('admin.layers.store'), [
            'name' => 'Testing with subject',
            'parent' => 'subject-1',
            'content' => "<h1>This is content</h1>",
        ]);

        $this->assertDatabaseHas('layers', ['slug' => 'testing-with-subject']);
    }

    public function test_storing_layer_parent_layer()
    {
        $response = $this->post(route('admin.layers.store'), [
            'name' => 'Testing-with-layer',
            'parent' => 'layer-1',
            'content' => "<h1>This is content</h1>",
        ]);

        $this->assertDatabaseHas('layers', ['slug' => 'testing-with-layer']);
    }

    public function test_storing_layer_duplicate()
    {
        $this->post(route('admin.layers.store'), [
            'name' => 'Testing-with-layer',
            'parent' => 'layer-1',
            'content' => "<h1>This is content</h1>",
        ]);

        $count = Layer::all()->count();

        $this->post(route('admin.layers.store'), [
            'title' => 'Testing-with-layer',
            'parent' => 'layer-1',
            'editor1' => "<h1>This is content</h1>",
        ]);

        $this->assertDatabaseCount('layers', $count);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountCreation extends TestCase
{
    use RefreshDatabase;

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

    public function account_can_be_created()
    {
        $response = $this->post(route('admin.managers.create'), [
            'managers' => [
                [
                    'name' => 'Test Manager',
                    'email' => 'Manager@test.nl',
                    'role' => 'Admin'
                ]
            ]
        ]);

        $response->assertRedirect(route('admin.managers.index'));
    }
}

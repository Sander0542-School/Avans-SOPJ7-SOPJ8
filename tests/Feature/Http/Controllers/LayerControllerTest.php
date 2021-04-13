<?php

namespace Http\Controllers;

use App\Http\Controllers\LayerController;
use PHPUnit\Framework\TestCase;
use App\Models\User;

class LayerControllerTest extends TestCase
{
    public function test_storing_layer()
    {
        $this->setUp();


    }

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@expeditiekaart.nl',
            'password' =>  \Hash::make('password')
        ]);

        $this->actingAs($user);
    }
}

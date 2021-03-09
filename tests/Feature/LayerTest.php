<?php

namespace Tests\Feature;

use Tests\TestCase;

class LayerTest extends TestCase {

    /**
     * Sends a request to the Layer endpoint checking if it received a 200.
     */
    public function testLayerSuccess()
    {
        $response = $this->get('/layer/a-accusamus-temporibus');

        $response->assertStatus(200);
    }

    /**
     * Sends a wrong request to the Layer endpoint checking if it received a 404.
     */
    public function testLayerFailed()
    {

        $response = $this->get('/layer/a-accusamus-us');

        $response->assertStatus(404);

    }
}

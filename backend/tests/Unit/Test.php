<?php

namespace Tests\Unit;

use Tests\TestCase;

class Test extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('a');
        $response->assertStatus(200);
    }
}

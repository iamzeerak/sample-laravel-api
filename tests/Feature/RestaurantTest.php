<?php

namespace Tests\Unit;

use Tests\TestCase;

class RestaurantTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_restaurants()
    {
        $response = $this->get('/api/restaurants');
        $response->assertStatus(200);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_post_restaurants()
    {
        $response = $this->post('/api/restaurants', [
            'name' => 'test case 1'
        ]);
        $response->assertStatus(200);
    }
}

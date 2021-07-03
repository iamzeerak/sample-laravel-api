<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MenusTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_menus()
    {
        $response = $this->get('/api/restaurants/4/menu');
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_failed_menus()
    {
        $response = $this->get('/api/restaurants/100/menu');
        $response->assertStatus(400);
    }
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_success_post_menus()
    {
        $response = $this->post('/api/restaurants/4/menu', [
            'name' => 'Test Case',
            'category' => 'Test Case',
        ]);
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_validation_error_post_menus()
    {
        $response = $this->post('/api/restaurants/4/menu', [
        ]);
        $response->assertStatus(422);
    }
}

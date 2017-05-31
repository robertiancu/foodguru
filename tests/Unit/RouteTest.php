<?php

namespace Tests\Feature;

use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /** @test */
    public function http_status_found_recipes()
    {
        $response = $this->get('/view/recipes');

        $response->assertStatus(302);
    }

    /** @test */
    public function http_status_found_home()
    {
        $response = $this->get('/view/home');

        $response->assertStatus(302);
    }

    /** @test */
    public function http_status_found_circles()
    {
        $response = $this->get('/view/circles');

        $response->assertStatus(302);
    }

    /** @test */
    public function http_status_found_calendar()
    {
        $response = $this->get('/view/calendar');

        $response->assertStatus(302);
    }

    /** @test */
    public function http_status_found_shop_list()
    {
        $response = $this->get('/view/shopLists');

        $response->assertStatus(302);
    }

    /** @test */
    public function http_status_found_fridge()
    {
        $response = $this->get('/view/fridge');

        $response->assertStatus(302);
    }

    /** @test */
    public function http_status_found_add_ingredient()
    {
        $response = $this->get('/view/ingredient/create');

        $response->assertStatus(302);
    }
}

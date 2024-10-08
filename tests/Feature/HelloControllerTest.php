<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    public function testController()
    {
        $this->get("/controller/hello/Yuta")
            ->assertStatus(200)
            ->assertSeeText("Halo, Yuta");
    }
}

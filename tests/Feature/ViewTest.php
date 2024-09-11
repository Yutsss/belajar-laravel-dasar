<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertViewIs('welcome');
        $this->get("/hello")
            ->assertStatus(200)
            ->assertViewIs('hello')
            ->assertViewHas('name', 'Yuta')
            ->assertSeeText("Hello, Yuta");
        $this->get("/hello-again")
            ->assertStatus(200)
            ->assertViewIs('hello')
            ->assertViewHas('name', 'Yuta')
            ->assertSeeText("Hello, Yuta");
    }

    public function testViewWithParameter()
    {
        $this->get("/hello-world")
            ->assertStatus(200)
            ->assertViewIs('hello.world')
            ->assertViewHas('name', 'Yuta')
            ->assertSeeText("World, Yuta");
    }

    public function testTemplate()
    {
        $this->view('hello', ['name' => 'Yuta'])
            ->assertSeeText("Hello, Yuta");
    }
}

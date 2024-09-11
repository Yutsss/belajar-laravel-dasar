<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testBasicRouting()
    {
        $this->get("Yuta")
            ->assertStatus(200)
            ->assertSeeText("Hello Yuta");
    }

    public function testRedirect()
    {
        $this->get("Youtube")
            ->assertStatus(302)
            ->assertRedirect("Yuta");
    }

    public function testFallback()
    {
        $this->get("/Unknown")
            ->assertSeeText("404");
    }

    public function testRouteParameter()
    {
        $this->get("/products/1")
            ->assertSeeText("Product ID: 1");

        $this->get("/products/1/items/2")
            ->assertSeeText("Product ID: 1, Item ID: 2");
    }

    public function testRouteParametersRegex()
    {
        $this->get("/categories/1")
            ->assertSeeText("Category ID: 1");

        $this->get("/categories/abc")
            ->assertSeeText("404");
    }

    public function testOptionalRouteParameters()
    {
        $this->get("/users")
            ->assertSeeText("User ID: 404");

        $this->get("/users/1")
            ->assertSeeText("User ID: 1");
    }

    public function testRouteConflict()
    {
        $this->get("/conflict/Yuta")
            ->assertSeeText("Conflict: Yuta");

        $this->get("/conflict/Atuy")
            ->assertSeeText("Conflict: Atuy");
    }

    public function testNamed()
    {
        $this->get("/produk/1")
            ->assertSeeText("products/1");

        $this->get("/produk-redirect/1")
            ->assertStatus(302)
            ->assertRedirect("products/1");
    }
}

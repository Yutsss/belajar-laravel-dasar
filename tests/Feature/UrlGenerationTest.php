<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlGenerationTest extends TestCase
{
    public function testCurrent()
    {
        $this->get('/url/current')
            ->assertStatus(200)
            ->assertSeeText('/url/current');
    }

    public function testNamed()
    {
        $this->get('/url/named')
            ->assertStatus(200)
            ->assertSeeText('/redirect/name/Yuta');
    }

    public function testAction()
    {
        $this->get('/url/action')
            ->assertStatus(200)
            ->assertSeeText('/form');
    }
}

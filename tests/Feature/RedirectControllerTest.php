<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectControllerTest extends TestCase
{
    function testRedirectTo()
    {
        $this->get('/redirect/to')
            ->assertSee('redirect to');
    }

    function testRedirectFrom()
    {
        $this->get('/redirect/from')
            ->assertRedirect('/redirect/to');
    }

    function testRedirectName()
    {
        $this->get('/redirect/name')
            ->assertRedirect('/redirect/name/Yuta');
    }

    function testRedirectAction()
    {
        $this->get('/redirect/action')
            ->assertRedirect('/redirect/name/Yuta');
    }

    function testRedirectAway()
    {
        $this->get('/redirect/away')
            ->assertRedirect('https://www.google.com');
    }
}

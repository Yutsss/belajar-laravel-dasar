<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    public function testCreateCookie()
    {
        $this->get('/cookie/set')
            ->assertCookie('User-id', 'Yuta')
            ->assertCookie('Is-Member', 'true');
    }

    public function testGetCookie()
    {
        $this->withCookies(['User-id' => 'Yuta', 'Is-Member' => 'true'])
            ->get('/cookie/get')
            ->assertJson([
                'userId' => 'Yuta',
                'isMember' => 'true'
            ]);
    }

    public function testClearCookie()
    {
        $this->withCookies(['User-id' => 'Yuta', 'Is-Member' => 'true'])
            ->get('/cookie/clear')
            ->assertCookieExpired('User-id')
            ->assertCookieExpired('Is-Member');
    }
}

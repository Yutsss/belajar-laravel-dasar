<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testCreateSession(): void
    {
        $this->get('/session/create')
            ->assertStatus(200)
            ->assertSee('Session created')
            ->assertSessionHas('userId', 'Yuta')
            ->assertSessionHas('isMember', 'true');
    }

    public function testGetSession(): void
    {
        $this->withSession(['userId' => 'Yuta', 'isMember' => 'true'])
            ->get('/session/get')
            ->assertStatus(200)
            ->assertSee('User ID: Yuta, Member: true');
    }
}

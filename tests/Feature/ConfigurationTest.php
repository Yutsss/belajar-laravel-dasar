<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    public function testConfig(): void
    {
        $firstName = config('contoh.author.first_name');
        $lastName = config('contoh.author.last_name');
        $email = config('contoh.email');
        $web = config('contoh.web');

        $this->assertEquals('Yuta', $firstName);
        $this->assertEquals('Atuy', $lastName);
        $this->assertEquals('yutamail@mail.com', $email);
        $this->assertEquals('yuta.com', $web);

    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testEnv(): void
    {
        $appName = env('YOUTUBE');

        $this->assertEquals('Programmer Zaman Now', $appName);
    }
    public function testEnvDefaultValue(): void
    {
        $appName = env('YOUTUBE2', "Programmer Zaman Now");

        $this->assertEquals('Programmer Zaman Now', $appName);
    }
}

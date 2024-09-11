<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacadesTest extends TestCase
{
    public function testConfig()
    {
        $firstName1 = config("contoh.author.first");
        $firstName2 = Config::get("contoh.author.first");

        $this->assertEquals($firstName1, $firstName2);

        var_dump(Config::all());
    }
    public function testConfigDependency()
    {
        $firstName1 = config("contoh.author.first");
        $firstName2 = Config::get("contoh.author.first");

        $config = $this->app->make("config");
        $firstName3 = $config->get("contoh.author.first");

        $this->assertEquals($firstName1, $firstName2);
        $this->assertEquals($firstName1, $firstName3);
        $this->assertEquals($firstName2, $firstName3);

        var_dump(Config::all());
    }

    public function testConfigMock()
    {
        Config::shouldReceive("get")
            ->with("contoh.author.first")
            ->andReturn("Yuta");

        $firstName = Config::get("contoh.author.first");

        $this->assertEquals("Yuta", $firstName);
    }
}

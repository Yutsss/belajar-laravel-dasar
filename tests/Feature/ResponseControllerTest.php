<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/hello')
            ->assertStatus(200)
            ->assertSeeText("Hello Response");
    }

    public function testHeader()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Author', 'Yuta Atuy')
            ->assertHeader('App', 'Belajar Laravel')
            ->assertJson([
                'firsName' => 'Yuta',
                'lastName' => 'Atuy'
            ]);
    }

    public function testResponseView()
    {
        $this->get('/response/view')
            ->assertStatus(200)
            ->assertViewIs('hello')
            ->assertViewHas('name', 'Yuta');
    }

    public function testResponseJson()
    {
        $this->get('/response/json')
            ->assertStatus(200)
            ->assertJson([
                'firsName' => 'Yuta',
                'lastName' => 'Atuy'
            ]);
    }

    public function testResponseFile()
    {
        $this->get('/response/file')
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'image/png');
    }

    public function testResponseDownload()
    {
        $this->get('/response/download')
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'image/png')
            ->assertHeader('Content-Disposition', 'attachment; filename=yuta.png');
    }

}

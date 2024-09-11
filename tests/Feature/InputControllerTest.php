<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Yuta')
            ->assertStatus(200)
            ->assertSeeText('Hello Yuta');

        $this->post('/input/hello', [
            'name' => 'Yuta'
        ])
            ->assertStatus(200)
            ->assertSeeText('Hello Yuta');
    }

    public function testNestedInput()
    {
        $this->post('/input/hello/first', [
            'name' => [
                'first' => 'Yuta'
            ]
        ])
            ->assertStatus(200)
            ->assertSeeText('Hello Yuta');
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            'name' => [
                'first' => 'Yuta',
                'last' => 'Atuy'
            ],
            'age' => 20
        ])->assertSeeText("name")
            ->assertSeeText("first")
            ->assertSeeText("Yuta")
            ->assertSeeText("last")
            ->assertSeeText("Atuy")
            ->assertSeeText("age")
            ->assertSeeText("20");
    }

    public function testArrayInput()
    {
        $this->post('/input/hello/array', [
            'products' => [
                [
                    'id' => 0,
                    'name' => 'Yuta'
                ],
                [
                    'id' => 1,
                    'name' => 'Atuy'
                ]
            ]
        ])->assertSeeText("Yuta")
            ->assertSeeText("Atuy");
    }

    public function testInputType()
    {
        $this->post('input/type', [
            'name' => 'Yuta',
            'married' => 'false',
            'birth_date' => '2000-01-01'
        ])->assertSeeText('Yuta')
            ->assertSeeText('false')
            ->assertSeeText('2000-01-01');
    }

    public function testFilterOnly()
    {
        $this->post('input/filter/only', [
            'name' => [
                'first' => 'Yuta',
                'last' => 'Atuy'
            ],
            'age' => 20
        ])->assertSeeText('first')
            ->assertSeeText('Yuta')
            ->assertSeeText('last')
            ->assertSeeText('Atuy')
            ->assertDontSeeText('age');
    }

    public function testFilterExcept()
    {
        $this->post('input/filter/except', [
            'name' => [
                'first' => 'Yuta',
                'last' => 'Atuy'
            ],
            'age' => 20,
            'admin' => true
        ])->assertDontSeeText('admin')
            ->assertSeeText('first')
            ->assertSeeText('Yuta')
            ->assertSeeText('last')
            ->assertSeeText('Atuy')
            ->assertSeeText('age')
            ->assertSeeText('20');
    }

    public function testFilterMerge()
    {
        $this->post('input/filter/merge', [
            'name' => 'Yuta',
            'age' => 20,
            'admin' => true
        ])->assertSeeText('name')
            ->assertSeeText('Yuta')
            ->assertSeeText('age')
            ->assertSeeText('20')
            ->assertSeeText('admin')
            ->assertSeeText('false');
    }
}

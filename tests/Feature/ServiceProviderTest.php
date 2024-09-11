<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Bar;
use App\Services\HelloService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    public function testServiceProvider(): void
    {
        $foo = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        $this->assertSame($foo, $foo2);

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        $this->assertSame($bar1, $bar2);
        $this->assertSame($foo, $bar1->foo);
        $this->assertSame($foo, $bar2->foo);
        $this->assertSame($bar1->foo, $bar2->foo);
    }

    public function testProperty()
    {
        $helloService = $this->app->make(HelloService::class);
        $helloService2 = $this->app->make(HelloService::class);
        $this->assertSame("Halo, Yuta", $helloService->hello("Yuta"));

        $this->assertSame($helloService, $helloService2);
    }
}

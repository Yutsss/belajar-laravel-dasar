<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Data\Foo;

class ServiceContainerTest extends TestCase
{
    public function testDependencyInjection(): void
    {
        $foo = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        $this->assertSame("foo", $foo->foo());
        $this->assertSame("foo", $foo2->foo());
        $this->assertNotSame($foo, $foo2);
    }

    public function testBind()
    {
        $this->app->bind(Person::class, function ($app) {
            return new Person("Yuta", "Atuy");
        });

        $person = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        $this->assertSame("Yuta", $person->firstName);
        $this->assertSame("Atuy", $person->latName);
        $this->assertSame("Yuta", $person2->firstName);
        $this->assertSame("Atuy", $person2->latName);
        $this->assertNotSame($person, $person2);

    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person("Yuta", "Atuy");
        });

        $person = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        $this->assertSame("Yuta", $person->firstName);
        $this->assertSame("Atuy", $person->latName);
        $this->assertSame("Yuta", $person2->firstName);
        $this->assertSame("Atuy", $person2->latName);
        $this->assertSame($person, $person2);
    }

    public function testInstance()
    {
        $person = new Person("Yuta", "Atuy");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        $this->assertSame($person, $person1);
        $this->assertSame($person, $person2);
        $this->assertSame($person1, $person2);
    }

    public function testDependencyInjection2()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        $this->assertSame("foobar", $bar->bar());
        $this->assertSame($foo, $bar->foo);
    }

    public function testDependencyInjectionInClosure()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });

        $bar = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        $this->assertSame($bar, $bar2);
        $this->assertSame($bar->foo, $bar2->foo);
    }

    public function testHelloService()
    {
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $helloService = $this->app->make(HelloService::class);
        $this->assertSame("Halo, Yuta", $helloService->hello("Yuta"));
    }
}

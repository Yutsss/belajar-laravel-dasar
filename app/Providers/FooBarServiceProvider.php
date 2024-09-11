<?php

namespace App\Providers;

use App\Data\Bar;
use App\Data\Foo;
use Illuminate\Support\ServiceProvider;

class FooBarServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Foo::class, function () {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });
    }
    public function boot(): void
    {
        //
    }
}

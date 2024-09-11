<?php

namespace App\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;

class HelloServiceProvider extends ServiceProvider implements DeferrableProvider
{


    public array $singletons = [
        HelloService::class => HelloServiceIndonesia::class,
    ];
    public function register(): void
    {
        echo "HelloServiceProvider registered\n";
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function provides(): array
    {
        return [
            HelloService::class
        ];
    }
}

<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Exceptions\ValidationException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'contoh' => \App\Http\Middleware\ContohMiddleware::class,
        ]);

        $middleware->group('yuta', [
            'contoh:Yuta,401',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->reportable(function (Throwable $e) {
            echo $e->getMessage();
        });
        $exceptions->dontReport([
            ValidationException::class,
        ]);
        $exceptions->renderable(function (ValidationException $exception, Request $request) {
            return response("Bad Request", 400);
        });
    })->create();

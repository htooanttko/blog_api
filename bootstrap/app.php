<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: glob(__DIR__ . '/../routes/api/*.php'),
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'sanctum' => EnsureFrontendRequestsAreStateful::class,
            'auth' => Authenticate::class,
        ]);

        // $middleware->validateCsrfTokens(
        //     except: ['/api/form']
        // );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

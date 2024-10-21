<?php

use App\Http\Middleware\ClienteMiddleware;
use App\Http\Middleware\IsNotMiddleware;
use App\Http\Middleware\TrasnportadoraMiddleware;
use App\Http\Middleware\VendedorMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'is_cliente' => ClienteMiddleware::class,
            'is_transportadora' => TrasnportadoraMiddleware::class,
            'is_vendedor' => VendedorMiddleware::class,
            'is_not' => IsNotMiddleware::class,
        ]);

        $middleware->appendToGroup('cliente' ,[
            'auth',
            'is_cliente'
        ]);

        $middleware->appendToGroup('vendedor' ,[
            'auth',
            'is_vendedor'
        ]);

        $middleware->appendToGroup('transportadora' ,[
            'auth',
            'is_transportadora'
        ]);

        $middleware->appendToGroup('is_not', [
            'auth',
            'is_not'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

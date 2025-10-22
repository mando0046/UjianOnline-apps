<?php


use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;
use App\Http\Middleware\RoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // alias middleware
        $middleware->alias([
          // bawaan Laravel
        'auth'     => \App\Http\Middleware\Authenticate::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        // custom role tunggal (fleksibel: role:admin / role:peserta / role:guest)
        'role'     => \App\Http\Middleware\RoleMiddleware::class,

        // kalau mau spesifik per-role juga boleh tetap ada:
        'admin'    => \App\Http\Middleware\AdminMiddleware::class,
        'peserta'  => \App\Http\Middleware\PesertaMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

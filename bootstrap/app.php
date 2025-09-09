<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        api:__DIR__.'/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware){
         $middleware->redirectGuestsTo(fn () => route('login'));

          $middleware->alias([
        'role' => \App\Http\Middleware\EnsureUserType::class,
    ]);
    // ⚙️ إعدادات CORS يدوياً
    $middleware->append(\Illuminate\Http\Middleware\HandleCors::class, [
        'paths' => ['api/*', 'sanctum/csrf-cookie'],
        'allowed_methods' => ['*'],
        'allowed_origins' => ['http://localhost:5173'], // ← رابط React (Vite)
        'allowed_headers' => ['*'],
        'exposed_headers' => [],
        'max_age' => 0,
        'supports_credentials' => false, 
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

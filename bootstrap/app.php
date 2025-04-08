<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule; // Use the actual Schedule class, not the facade

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,
            'auth' => \App\Http\Middleware\Authenticate::class,
        ]);
    })
    ->withCommands([
        \App\Console\Commands\UpdateTracking::class, // Register your command
    ])
    ->withSchedule(function (Schedule $schedule) { // Type hint the actual Schedule class
        $schedule->command('tracking:update')->everyMinute();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

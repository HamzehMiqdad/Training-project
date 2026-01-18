<?php

use App\Http\Middleware\CheckActivated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->redirectGuestsTo(function ($request) {
            if ($request->is('admin/*')) {
                return route('admin.login');
            }

            return route('login');
        });

        $middleware->redirectUsersTo(function ($request) {
        
            
            // For regular routes, check web guard first
            if (Auth::guard('web')->check()) {
                return route('products.index');
            }
            
            
            // Fallback: check admin guard (in case of mixed authentication)
            if (Auth::guard('admin')->check()) {
                return route('admin.dashboard');
            }

            return route('home');
        });
        $middleware->alias([
            'activated' => CheckActivated::class
        ]);
    })  
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

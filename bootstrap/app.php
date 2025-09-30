<?php

use App\Http\Middleware\Customer;
use App\Http\Middleware\language;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',

        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append:[language::class]);
        $middleware->api(prepend: [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Session\Middleware\StartSession::class,

        ]);
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'teacher' => \App\Http\Middleware\TeacherMiddleware::class,
            'employee' => \App\Http\Middleware\EmployeeMiddleware::class,
        ]);

    })

//     ->withMiddleware(function (Middleware $middleware) {
//         $middleware->append(Customer::class);
//    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

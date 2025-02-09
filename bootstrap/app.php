<?php

declare(strict_types=1);

use App\Core\Exceptions\JsonExceptionHandler;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(static function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: ['api/*', 'sanctum/csrf-cookie']);
        $middleware->statefulApi();
    })
    ->withExceptions(static function (Exceptions $exceptions) {
        if (request()?->wantsJson()) {
            $exceptions->render(static fn (\Throwable $e) => (new JsonExceptionHandler($e))->handle());
        }
    })->create();

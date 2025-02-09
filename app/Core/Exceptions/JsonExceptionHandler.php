<?php

declare(strict_types=1);

namespace App\Core\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class JsonExceptionHandler
{
    public function __construct(
        protected \Throwable $exception
    ) {}

    public function handle(): JsonResponse
    {
        $e = $this->exception;

        return match ($e::class) {
            AuthenticationException::class => response()->json(['message' => 'Ошибка авторизации.'], Response::HTTP_UNAUTHORIZED),
            AccessDeniedHttpException::class => response()->json(['message' => 'Доступ запрещен.'], Response::HTTP_FORBIDDEN),
            ThrottleRequestsException::class => response()->json(['message' => 'Превышено допустимое количество запросов.'], Response::HTTP_FORBIDDEN),
            NotFoundHttpException::class => response()->json(['message' => 'Данные не найдены.', 'previous' => str_replace('No query results for model ', '', $e->getPrevious()?->getMessage() ?? 'Отсутствует маршрут. Проверьте URL.')], Response::HTTP_NOT_FOUND),
            ValidationException::class => response()->json(['message' => 'Ошибка валидации данных.', 'errors' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY),
            default => response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST),
        };
    }
}

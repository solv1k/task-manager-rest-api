<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

abstract class Controller
{
    /**
     * Метод для авторзации действий пользователя.
     *
     * @param  string|array<mixed, mixed>|Model  $arguments
     */
    public function authorize(string $ability, string|array|Model $arguments = []): void
    {
        Gate::authorize($ability, $arguments);
    }

    /**
     * Метод отправки успешного ответа.
     *
     * @param  null|array<string, mixed>|Arrayable<string, mixed>|AnonymousResourceCollection|JsonResource  $data
     */
    public function success(null|array|Arrayable|AnonymousResourceCollection|JsonResource $data = null, int $status = 200): JsonResponse
    {
        if ($data instanceof AnonymousResourceCollection) {
            /**
             * @var array{links:?array<string, mixed>, meta:?array<string, mixed>}
             */
            $data = $data->response()->getData(true);

            unset($data['links']);
            unset($data['meta']['links']);
        }

        if (is_null($data)) {
            return response()->json(data: ['success' => true], status: $status);
        }

        return response()->json(data: $data, status: $status);
    }
}

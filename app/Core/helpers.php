<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Auth\AuthenticationException;

if (! function_exists('currentSanctumUser')) {
    /**
     * Возвращает текущего авторизованного пользователя.
     *
     * @return \App\Models\User|null
     */
    function currentSanctumUser(): User
    {
        return auth('sanctum')->user() ?? throw new AuthenticationException('Требуется авторизация.');
    }
}

if (! function_exists('currentSanctumUserId')) {
    /**
     * Возвращает ID текущего авторизованного пользователя.
     *
     * @return \App\Models\User|null
     */
    function currentSanctumUserId(): int
    {
        return auth('sanctum')->id() ?? throw new AuthenticationException('Требуется авторизация.');
    }
}

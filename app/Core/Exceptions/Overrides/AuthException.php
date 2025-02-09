<?php

declare(strict_types=1);

namespace App\Core\Exceptions\Overrides;

use Illuminate\Auth\AuthenticationException;

final class AuthException extends AuthenticationException
{
    public function __construct()
    {
        parent::__construct('Ошибка авторизации.');
    }
}

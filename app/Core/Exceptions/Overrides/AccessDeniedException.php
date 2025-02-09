<?php

declare(strict_types=1);

namespace App\Core\Exceptions\Overrides;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

final class AccessDeniedException extends AccessDeniedHttpException
{
    public function __construct()
    {
        parent::__construct('Доступ запрещен.');
    }
}

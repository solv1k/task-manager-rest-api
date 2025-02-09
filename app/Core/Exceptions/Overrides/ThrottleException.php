<?php

declare(strict_types=1);

namespace App\Core\Exceptions\Overrides;

use Illuminate\Http\Exceptions\ThrottleRequestsException;

final class ThrottleException extends ThrottleRequestsException
{
    public function __construct()
    {
        parent::__construct('Превышено допустимое количество запросов.');
    }
}

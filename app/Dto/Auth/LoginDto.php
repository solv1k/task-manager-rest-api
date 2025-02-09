<?php

declare(strict_types=1);

namespace App\Dto\Auth;

use App\Core\Abstracts\AbstractDto;

final class LoginDto extends AbstractDto
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}
}

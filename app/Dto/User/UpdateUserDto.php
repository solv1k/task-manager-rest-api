<?php

declare(strict_types=1);

namespace App\Dto\User;

use App\Core\Abstracts\AbstractDto;

final class UpdateUserDto extends AbstractDto
{
    public function __construct(
        public ?string $email,
        public ?string $password,
    ) {}
}

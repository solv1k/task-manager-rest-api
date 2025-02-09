<?php

declare(strict_types=1);

namespace App\Dto\Auth;

use App\Core\Abstracts\AbstractDto;
use App\Models\User;

final class AuthorizedUserDto extends AbstractDto
{
    public function __construct(
        public string $authToken,
        public User $user,
    ) {}
}

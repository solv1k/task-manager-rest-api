<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Dto\Auth\LoginDto;
use App\Dto\Auth\AuthorizedUserDto;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

final class LoginAction
{
    public function run(LoginDto $dto): AuthorizedUserDto
    {
        $user = User::where('email', $dto->email)->first();

        if (! $user || ! Hash::check($dto->password, $user->password)) {
            throw new AuthenticationException('Ошибка авторизации.');
        }

        return new AuthorizedUserDto(
            authToken: $user->createToken('auth_token')->plainTextToken,
            user: $user,
        );
    }
}

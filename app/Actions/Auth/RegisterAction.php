<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Dto\Auth\RegisterDto;
use App\Dto\Auth\AuthorizedUserDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class RegisterAction
{
    public function run(RegisterDto $dto): AuthorizedUserDto
    {
        $user = User::query()->create([
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
        ]);

        return new AuthorizedUserDto(
            authToken: $user->createToken('auth_token')->plainTextToken,
            user: $user->refresh(),
        );
    }
}

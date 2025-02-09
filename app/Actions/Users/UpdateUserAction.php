<?php

declare(strict_types=1);

namespace App\Actions\Users;

use App\Dto\User\UpdateUserDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class UpdateUserAction
{
    public function run(User $user, UpdateUserDto $dto): User
    {
        if ($dto->email) {
            $user->email = $dto->email;
        }

        if ($dto->password) {
            $user->password = Hash::make($dto->password);
        }

        $user->save();

        return $user;
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\Tasks;

use App\Dto\Task\CreateTaskDto;
use App\Models\Task;
use App\Models\User;

final class CreateTaskAction
{
    public function run(User $user, CreateTaskDto $dto): Task
    {
        return $user->tasks()->create($dto->toArray());
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\Tasks;

use App\Dto\Task\UpdateTaskDto;
use App\Models\Task;

final class UpdateTaskAction
{
    public function run(Task $task, UpdateTaskDto $dto): Task
    {
        if ($dto->title) {
            $task->title = $dto->title;
        }

        if (request()->has('description')) {
            $task->description = $dto->description;
        }

        if (request()->has('completed')) {
            $task->completed = $dto->completed;
        }

        $task->save();

        return $task;
    }
}

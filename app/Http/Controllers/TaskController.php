<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Tasks\CreateTaskAction;
use App\Actions\Tasks\UpdateTaskAction;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\ListTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use App\Queries\Tasks\ListTaskQuery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class TaskController extends Controller
{
    public function index(ListTaskRequest $request, ListTaskQuery $listTaskQuery): JsonResponse
    {
        return $this->success(TaskResource::collection($listTaskQuery->run(currentSanctumUser(), (bool) $request->completed)));
    }

    public function store(CreateTaskRequest $request, CreateTaskAction $createTaskAction)
    {
        $task = $createTaskAction->run(currentSanctumUser(), $request->toDto());

        return $this->success(
            data: TaskResource::make($task),
            status: Response::HTTP_CREATED
        );
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return $this->success(TaskResource::make($task));
    }

    public function update(Task $task, UpdateTaskRequest $request, UpdateTaskAction $updateTaskAction)
    {
        $this->authorize('update', $task);

        $task = $updateTaskAction->run($task, $request->toDto());

        return $this->success(TaskResource::make($task));
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return $this->success(['message' => 'Задача успешно удалена.']);
    }
}

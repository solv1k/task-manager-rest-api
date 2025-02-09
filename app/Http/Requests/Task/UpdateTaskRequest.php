<?php

declare(strict_types=1);

namespace App\Http\Requests\Task;

use App\Dto\Task\UpdateTaskDto;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'sometimes|boolean',
        ];
    }

    public function toDto(): UpdateTaskDto
    {
        return new UpdateTaskDto(
            title: $this->title,
            description: $this->description,
            completed: $this->completed,
        );
    }
}

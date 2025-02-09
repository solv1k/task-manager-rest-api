<?php

declare(strict_types=1);

namespace App\Http\Requests\Task;

use App\Dto\Task\CreateTaskDto;
use Illuminate\Foundation\Http\FormRequest;

final class CreateTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }

    public function toDto(): CreateTaskDto
    {
        return new CreateTaskDto(
            title: $this->title,
            description: $this->description,
        );
    }
}

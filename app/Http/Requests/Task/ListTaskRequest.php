<?php

declare(strict_types=1);

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

final class ListTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'completed' => 'sometimes|boolean',
        ];
    }
}

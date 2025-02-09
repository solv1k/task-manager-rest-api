<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Dto\User\UpdateUserDto;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateUserRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $this->route('user'),
            'password' => 'sometimes|string|min:8',
        ];
    }

    public function toDto(): UpdateUserDto
    {
        return new UpdateUserDto(
            email: $this->email,
            password: $this->password,
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Dto\Auth\RegisterDto;
use Illuminate\Foundation\Http\FormRequest;

final class RegisterRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];
    }

    public function toDto(): RegisterDto
    {
        return new RegisterDto(
            email: $this->email,
            password: $this->password,
        );
    }
}

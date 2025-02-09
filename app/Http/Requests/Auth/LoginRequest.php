<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Dto\Auth\LoginDto;
use Illuminate\Foundation\Http\FormRequest;

final class LoginRequest extends FormRequest
{
    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    public function toDto(): LoginDto
    {
        return new LoginDto(
            email: $this->email,
            password: $this->password,
        );
    }
}

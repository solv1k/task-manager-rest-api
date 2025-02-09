<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\RegisterAction;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\AuthorizedUserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class AuthController extends Controller
{
    public function register(RegisterRequest $request, RegisterAction $registerAction): JsonResponse
    {
        return $this->success(AuthorizedUserResource::make($registerAction->run($request->toDto())));
    }

    public function login(LoginRequest $request, LoginAction $loginAction): JsonResponse
    {
        return $this->success(AuthorizedUserResource::make($loginAction->run($request->toDto())));
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success(['message' => 'Успешный выход из аккаунта.']);
    }
}

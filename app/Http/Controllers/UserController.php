<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Users\UpdateUserAction;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

final class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', User::class);

        return $this->success(UserResource::collection(User::paginate()));
    }

    public function me(): JsonResponse
    {
        return $this->success(UserResource::make(currentSanctumUser()));
    }

    public function update(UpdateUserRequest $request, UpdateUserAction $updateUserAction): JsonResponse
    {
        $user = $updateUserAction->run(currentSanctumUser(), $request->toDto());

        return $this->success(UserResource::make($user));
    }

    public function destroy(User $user): JsonResponse
    {
        $this->authorize('delete', $user);

        $user->delete();

        return $this->success(['message' => 'Пользователь успешно удален.']);
    }
}

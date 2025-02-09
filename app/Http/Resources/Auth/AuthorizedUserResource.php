<?php

declare(strict_types=1);

namespace App\Http\Resources\Auth;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class AuthorizedUserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var \App\Dto\Auth\AuthorizedUserDto */
        $dto = $this->resource;

        return [
            'auth_token' => $dto->authToken,
            'user' => UserResource::make($dto->user),
        ];
    }
}

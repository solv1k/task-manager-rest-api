<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var \App\Models\User */
        $user = $this->resource;

        return [
            'id' => $user->id,
            'email' => $user->email,
            'is_admin' => $user->is_admin,
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Queries\Tasks;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class ListTaskQuery
{
    public function run(User $user, ?bool $completed = null): LengthAwarePaginator
    {
        return $user->tasks()
            ->when(is_bool($completed), static fn ($query) => $query->where('completed', $completed))
            ->paginate();
    }
}

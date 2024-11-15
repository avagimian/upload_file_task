<?php

namespace App\Repositories\Read\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class UserReadRepository implements UserReadRepositoryInterface
{
    public function getUnsentUserIds(int $offset): Collection
    {
        return $this->query()
            ->where('sent', false)
            ->offset($offset)
            ->limit(User::CHUNK_LIMIT)
            ->pluck('id');
    }

    private function query(): Builder
    {
        return User::query();
    }
}

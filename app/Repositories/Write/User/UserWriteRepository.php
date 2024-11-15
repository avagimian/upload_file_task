<?php

namespace App\Repositories\Write\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class UserWriteRepository implements UserWriteRepositoryInterface
{
    public function updateUsersSentValue(Collection $userIds): void
    {
        $this->query()
            ->whereIn('id', $userIds)
            ->update(['sent' => true]);
    }

    public function insert(array $data): bool
    {
        if (!$this->query()->insert($data)) {
            return false;
        }

        return true;
    }

    private function query(): Builder
    {
        return User::query();
    }
}

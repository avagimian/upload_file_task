<?php

namespace App\Repositories\Write\User;

use Illuminate\Support\Collection;

interface UserWriteRepositoryInterface
{
    public function updateUsersSentValue(Collection $userIds);

    public function insert(array $data);
}

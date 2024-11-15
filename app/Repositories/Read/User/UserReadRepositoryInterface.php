<?php

namespace App\Repositories\Read\User;

interface UserReadRepositoryInterface
{
    public function getUnsentUserIds(int $offset);
}

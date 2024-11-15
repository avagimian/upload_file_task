<?php

namespace App\Jobs\User;

use App\Jobs\BaseJob;
use App\Repositories\Write\User\UserWriteRepositoryInterface;

class SaveUsersJob extends BaseJob
{
    public function __construct(protected array $users)
    {
    }

    public function handle(UserWriteRepositoryInterface $userWriteRepository): void
    {
        $userWriteRepository->insert($this->users);
    }
}

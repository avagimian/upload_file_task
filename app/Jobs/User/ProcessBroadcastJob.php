<?php

namespace App\Jobs\User;

use App\Jobs\BaseJob;
use App\Repositories\Write\User\UserWriteRepositoryInterface;
use Illuminate\Support\Collection;

class ProcessBroadcastJob extends BaseJob
{
    public function __construct(protected Collection $userIds)
    {
    }

    public function handle(UserWriteRepositoryInterface $userWriteRepository): void
    {
        $userWriteRepository->updateUsersSentValue($this->userIds);
    }
}
